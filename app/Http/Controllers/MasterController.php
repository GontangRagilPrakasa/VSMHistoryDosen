<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\MstDosenJudul;
use App\Models\SysDosen;
use App\Models\SysUsers;
use App\Models\SysMahasiswa;
use App\Models\OptGender;

class MasterController extends Controller
{
    public function adminDosenList() {
        $genders = OptGender::pluck('gender_name','gender_id')->toArray();
        
        return view('admin.dosen',compact('genders'));
    }

    public function adminDosenGetAll(Request $input) {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();
        $query = SysDosen::select(['sys_dosen.*',DB::raw("(CASE WHEN sys_dosen.dosen_jk=1 THEN 'Laki-Laki' WHEN sys_dosen.dosen_jk=2 THEN 'Perempuan' END) as dosen_jk_ret"),'sys_users.email'])->join('sys_users','sys_users.user_id','sys_dosen.users_id')
        ->whereNull('sys_users.deleted_at');

        $keyword = $request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where("sys_dosen.dosen_name", "like", "%".$keyword."%");
        }

        $ret->recordsTotal = $query->get()->count();
        $ret->recordsFiltered = $query->get()->count();
        foreach($request["order"] as $i=>$order){
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $ret->data = $query->skip($request["start"])->take($request["length"])->get()->toArray();

        return \Response::json($ret,200);

    }

    public function adminDosenShow(Request $input) {
        $ret = (object) [];
        $ret->result = true;
        $ret->msg = "";
        $ret->data = null;
        $request = $input->all();
        $dosen_id = $request['dosen_id'];

        $query = SysDosen::select(['sys_dosen.*'])
        ->where('sys_dosen.dosen_id',$dosen_id)
        ->first();

        if( $query ){
            $ret->data = $query;
        }else{
            $ret->result = false;
            $ret->msg = "Data not found";
        }

        return \Response::json($ret,200);
    }

    public function adminDosenSave(Request $input) {

        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        
        DB::beginTransaction();
        try{
            
            if ($request['mode'] == 'add') {
                $user               = new SysUsers();
                $dosen              = new SysDosen();

                $user->role         = 2; //default role dosen
                $user->email        = $request['email'];
                $user->password     = bcrypt($request['password']);
                $user->verification = 1; //active
                $user->created_at   = date('Y-m-d H:i:s');
                $user->created_by   = Auth::User()->user_id;
            } else {
                $dosen              = SysDosen::where('dosen_id',$request['dosen_id'])->first();
                if (is_null($dosen)) {
                    $ret->status = 200;
                    $ret->result = true;
                    $ret->msg = "Data Tidak Ada";
                    return \Response::json($ret,200);
                }
                $user               = SysUsers::where('user_id', $dosen['users_id'])->first();

                $user->updated_at   = date('Y-m-d H:i:s');
                $user->updated_by   = Auth::User()->user_id;
            }

            $user->full_name    = $request['dosen_name'];
            $user->username     = $request['dosen_name'];

            if ( $user->save() ) {
                if ($request['mode'] == 'add') {
                    $dosen->users_id    = $user->user_id;
                } else {
                    $dosen->users_id    = $user['user_id'];
                }
                $dosen->dosen_name  = $request['dosen_name'];
                $dosen->dosen_jk    = $request['dosen_jk'];
                $dosen->dosen_telp  = $request['dosen_telp'];
                $dosen->save();
            }

           
            $ret->status = 200;
            $ret->result = true;
            $ret->msg = "Berhasil menyimpan data";
            DB::commit();
        } catch(QueryException $e){
            DB::rollback();

            $ret->status = 400;
            $ret->result = false;
            $ret->msg = $e->getMessage();
        }

        return \Response::json($ret,200);
    }

    public function adminDosenDelete(Request $input) {
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";

        $request = $input->all();

        $pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
        try{
            $dosen_id = $request['dosen_id'];
			$dosen = SysDosen::where('dosen_id',$dosen_id)
            ->join('sys_users','sys_users.user_id','sys_dosen.users_id')
            ->first();

			if( $dosen ){
				$user_id = $dosen['user_id'];
				$user = SysUsers::find($user_id);
				$user->deleted_at = date("Y-m-d H:i:s");
				$user->deleted_by = Auth::User()->user_id;
				$user->save();

                $ret->result = true;
				$ret->msg = "User berhasil dihapus";
                DB::commit();
			}else{
				$ret->result = false;
				$ret->msg = "Token is not valid";
			}
		}catch(QueryException $e){
            DB::rollback();
			$ret->result = false;
			$ret->msg = $e->getMessage();
		}
        return \Response::json($ret,200);
    }


    public function adminMahasiswaList() {
        $genders = OptGender::pluck('gender_name','gender_id')->toArray();
        return view('admin.mahasiswa',compact('genders'));
    }

    public function adminMahasiswaSave(Request $input) {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        
        DB::beginTransaction();
        try{
            
            if ($request['mode'] == 'add') {
                $user               = new SysUsers();
                $mahasiswa          = new SysMahasiswa();

                $user->role         = 3; //default role mahasiswa
                $user->email        = $request['email'];
                $user->password     = bcrypt($request['password']);
                $user->verification = 1; //active
                $user->created_at   = date('Y-m-d H:i:s');
                $user->created_by   = Auth::User()->user_id;
            } else {
                $mahasiswa = SysMahasiswa::where('mahasiswa_id',$request['mahasiswa_id'])->first();

                if (is_null($mahasiswa)) {
                    $ret->status = 200;
                    $ret->result = true;
                    $ret->msg = "Data Tidak Ada";
                    return \Response::json($ret,200);
                }
                $user               = SysUsers::where('user_id', $mahasiswa['users_id'])->first();

                $user->updated_at   = date('Y-m-d H:i:s');
                $user->updated_by   = Auth::User()->user_id;
            }

            $user->full_name    = $request['mahasiswa_name'];
            $user->username     = $request['mahasiswa_name'];

            if ( $user->save() ) {
                if ($request['mode'] == 'add') {
                    $mahasiswa->users_id    = $user->user_id;
                } else {
                    $mahasiswa->users_id    = $user['user_id'];
                }
                $mahasiswa->mahasiswa_name  = $request['mahasiswa_name'];
                $mahasiswa->mahasiswa_jk    = $request['mahasiswa_jk'];
                $mahasiswa->mahasiswa_telp  = $request['mahasiswa_telp'];
                $mahasiswa->save();
            }

           
            $ret->status = 200;
            $ret->result = true;
            $ret->msg = "Berhasil menyimpan data";
            DB::commit();
        } catch(QueryException $e){
            DB::rollback();

            $ret->status = 400;
            $ret->result = false;
            $ret->msg = $e->getMessage();
        }

        return \Response::json($ret,200);
    }

    public function adminMahasiswaGetAll(Request $input) {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();
        $query = SysMahasiswa::select(['sys_mahasiswa.*',DB::raw("(CASE WHEN sys_mahasiswa.mahasiswa_jk=1 THEN 'Laki-Laki' WHEN sys_mahasiswa.mahasiswa_jk=2 THEN 'Perempuan' END) as mahasiswa_jk_ret"),'sys_users.email'])->join('sys_users','sys_users.user_id','sys_mahasiswa.users_id')
        ->whereNull('sys_users.deleted_at');

        $keyword = $request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where("sys_mahasiswa.mahasiswa_name", "like", "%".$keyword."%");
        }

        $ret->recordsTotal = $query->get()->count();
        $ret->recordsFiltered = $query->get()->count();
        foreach($request["order"] as $i=>$order){
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $ret->data = $query->skip($request["start"])->take($request["length"])->get()->toArray();

        return \Response::json($ret,200);
    }

    public function adminMahasiswaShow(Request $input) {
        $ret = (object) [];
        $ret->result = true;
        $ret->msg = "";
        $ret->data = null;
        $request = $input->all();
        $mahasiswa_id = $request['mahasiswa_id'];

        $query = SysMahasiswa::select(['sys_mahasiswa.*'])
        ->where('sys_mahasiswa.mahasiswa_id',$mahasiswa_id)
        ->first();

        if( $query ){
            $ret->data = $query;
        }else{
            $ret->result = false;
            $ret->msg = "Data not found";
        }

        return \Response::json($ret,200);
    }

    public function adminMahasiswaDelete(Request $input) {
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";

        $request = $input->all();

        $pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
        try{
            $mahasiswa_id = $request['mahasiswa_id'];
			$mahasiswa = SysMahasiswa::where('mahasiswa_id',$mahasiswa_id)
            ->join('sys_users','sys_users.user_id','sys_mahasiswa.mahasiswa_id')
            ->first();

			if( $mahasiswa ){
				$user_id = $mahasiswa['user_id'];
				$user = SysUsers::find($user_id);
				$user->deleted_at = date("Y-m-d H:i:s");
				$user->deleted_by = Auth::User()->user_id;
				$user->save();

                $ret->result = true;
				$ret->msg = "User berhasil dihapus";
                DB::commit();
			}else{
				$ret->result = false;
				$ret->msg = "Token is not valid";
			}
		}catch(QueryException $e){
            DB::rollback();
			$ret->result = false;
			$ret->msg = $e->getMessage();
		}
        return \Response::json($ret,200);
    }



}
