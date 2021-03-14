<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use Session;
use App\Models\SysUsers;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
	protected $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function index() {
		return view('login');
	}

    public function login() {
		$ret = (object) [];
		$ret->result = true;
		$ret->msg = "";

		$credential = [
            'email' => $this->request->input('txtUserName'),
            'password' => $this->request->input('txtPassword'),
            'deleted_at' => null,
			'deleted_by' => 0,
			'verification' => true,
        ];

        if (Auth::attempt($credential, $this->request->input('remember_me') == 'on' ? true : false)) {
        	$lastLogin = SysUsers::where('email', $this->request->input('txtUserName'))
		       	->update([
		           'last_login' => date('Y-m-d H:i:s')
		        ]);

            $redirect = url('/dashboard');
            if (session()->has('from')) {
				$redirect = session()->pull('from');
				if ($redirect == url('/login')) {
					$redirect = url('/dashboard');
				}
			}
			$ret->result = true;
            $ret->redirect = $redirect;
            $ret->msg = 'Login berhasil';
        }
        else { 
        	$user = SysUsers::where('email', $this->request->input('txtUserName'))->first();
        	$ret->msg = 'Email atau password salah.';
            $ret->result = false;
        }

		return response()->json($ret,200);
    }
	
	public function logout() {
		$url = 'login';
		Auth::logout();
		session()->flush();
		return redirect($url);
	}

	public function showLinkRequestForm() {
		return view('password.email');
	}

	public function sendResetLinkEmail() {
		$validator = Validator::make($this->request->all(), [ 
			'email' => 'required|email',
        ]);

		if ($validator->fails()) { 
			$errors = '';
			foreach ($validator->messages()->all() as $value) {
				$errors.= $value.'<br>';
			}
			Session::flash('errors', $errors);
			return redirect(url('forgot-password'));
        }

        $token = $this->generateRandomString(64);

        $user = SysUsers::where(['email' => $this->request->input('email'), 'deleted_at' => null])->first();

        if (!$user) {
        	Session::flash('errors', 'Email tidak ditemukan!.');
			return redirect(url('forgot-password'));
        }

        if ($user->active != 1) {
        	Session::flash('errors', 'Email tidak aktif. Silakan hubungi Admin SID NTB!');
			return redirect(url('forgot-password'));
        }

       	$update = $user->update(['reset_password' => $token]);
        
       	if ($update) {
       		$data['url'] = url('/reset-password/'.$token);
       		$data['user_full_name'] = $user->user_full_name;
       		// Sending email link
	        Mail::send('emails.reset-password', $data, function ($message) use ($user) {
	            $message->subject('RESET PASSWORD | SID NTB');
	            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
	            $message->to($user->email);
	        });

	        Session::flash('status', 'Success. Silakan cek email anda.');
			return redirect(url('forgot-password'));	
       	}

       	Session::flash('errors', 'Gagal. Silakan coba kembali.');
		return redirect(url('forgot-password'));	
	}

	private function generateRandomString($length = 32) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	public function showResetForm($token) {
		$user = SysUsers::where(['reset_password' => $token, 'active' => 1, 'deleted_at' => null])->first();
		if (!$user) {
			abort(404);
		}
		return view('password.reset-password')->with(['user' => $user]);
	}

	public function updatePassword($token) {
		$validator = Validator::make($this->request->all(), [ 
			'password' => 'required|confirmed|min:6',
        ]);

		if ($validator->fails()) { 
			$errors = '';
			foreach ($validator->messages()->all() as $value) {
				$errors.= $value.'<br>';
			}
			Session::flash('errors', $errors);
			return redirect(url('/reset-password/'.$token));
        }

        $user = SysUsers::where(['reset_password' => $token, 'active' => 1, 'deleted_at' => null])->first();
		if (!$user) {
			Session::flash('errors', 'Token Expired');
			return redirect(url('/reset-password/'.$token));
		}

		$update = SysUsers::where('user_id', $user->user_id)
			->update([
				'password' => bcrypt($this->request->input('password'))
			]);

		if ($update) {
			SysUsers::where('user_id', $user->user_id)
				->update([
					'remember_token' 	=> null,
					'reset_password'	=> null,
					'last_login' 		=> date('Y-m-d H:i:s')
				]);

	        if (Auth::attempt([
	            'user_name' => $user->user_name,
	            'password' => $this->request->input('password'),
	            'active' => 1,
				'deleted_at' => null
	        ], false)) {
	        	redirect(url('dashboard'));
	        } else {
	        	redirect(url('login'));
	        }
       	}

       	Session::flash('errors', 'Gagal. Silakan coba lagi.');
		return redirect(url('/reset-password/'.$token));
	}

	public function showResetSuccess() {
		return view('password.reset-success');
	}
}