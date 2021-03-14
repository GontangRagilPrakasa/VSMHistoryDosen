<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

use App\Models\SysUsers;
use App\Models\SysAdmin;
use App\Models\OptPosition;
use App\Models\OptGender;
use App\Models\MstVillages;
use App\Models\MstDistricts;
use App\Models\MstSubDistrict;
use App\Models\MstProvinces;



class AdminDesaRepository
{
    public function __construct()
    {
        // jika dibutuhkan variabel yang berulang bisa ditambahkan disini

        $this->roles = array(
            'AdminDesa' => 5,
        );
    }   

    public function list_data($request = array())
    {
        try {
            $ret = (object) [];
            $ret->draw = $request["draw"];
            $ret->recordsTotal = 0;
            $ret->recordsFiltered = 0;
            $ret->data = array();

            $query = SysAdmin::join('sys_users','sys_users.user_id','sys_admin.user')
            ->join('tb_desa','tb_desa.id','sys_admin.desa')
            ->join('tb_kecamatan','tb_kecamatan.id','tb_desa.kecamatan_id')
            ->join('tb_kabupaten','tb_kabupaten.id','tb_kecamatan.kabupaten_id')
            ->join('opt_gender','opt_gender.gender_id','sys_admin.gender')
            ->join('opt_position','opt_position.position_id','sys_admin.informant_position')
            ->select([
                'sys_admin.admin_id',
                'sys_users.email',
                'opt_position.position_name',
                'opt_gender.gender_name',
                'tb_desa.name as desa',
                'tb_kecamatan.name as kecamatan',
                'tb_kabupaten.name as kabupaten',
            ])->wherenull('sys_users.deleted_at');

            $keyword = $request["keyword"];
            if( $keyword<> "" ){
                $query = $query->where(function($q) use ($keyword){
                    $q->where("sys_users.email", "like", "%".$keyword."%")
                        ->orWhere("sys_users.username", "like", "%".$keyword."%")
                        ->orWhere("tb_desa.name", "like", "%".$keyword."%")
                        ->orWhere("tb_kecamatan.name", "like", "%".$keyword."%")
                        ->orWhere("tb_desa.name", "like", "%".$keyword."%");
                });
            }

            $ret->recordsTotal = $query->get()->count();
            $ret->recordsFiltered = $query->get()->count();
            foreach($request["order"] as $i=>$order){
                $query = $query->orderBy($order["column"], $order["dir"]);
            }
            $ret->data = $query->skip($request["start"])->take($request["length"])->get()->toArray();
            
            return $ret;
        } catch(Exception $e) {
            return \Response::json($e, 500); 
        }
    }

    public function show_data($request = array())
    {
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";
		$ret->data = null;

        $admin_id = $request['admin_id'];

        $query = SysAdmin::join('sys_users','sys_users.user_id','sys_admin.user')
            ->join('tb_desa','tb_desa.id','sys_admin.desa')
            ->join('tb_kecamatan','tb_kecamatan.id','tb_desa.kecamatan_id')
            ->join('tb_kabupaten','tb_kabupaten.id','tb_kecamatan.kabupaten_id')
            ->join('tb_provinsi','tb_provinsi.id','tb_kabupaten.provinsi_id')
            ->join('opt_gender','opt_gender.gender_id','sys_admin.gender')
            ->join('opt_position','opt_position.position_id','sys_admin.informant_position')
            ->select([
                'sys_admin.admin_id',
                'sys_users.username',
                'sys_users.full_name',
                'sys_users.email',
                'sys_admin.informant_birthday',	
                'sys_admin.informant_phone',
                'sys_admin.informant_position',
                'sys_admin.gender',
                'sys_admin.desa',
                'tb_desa.id as desa_id',
                'tb_desa.name as desa_name',
                'tb_kecamatan.id as kecamatan_id',
                'tb_kecamatan.name as kecamatan_name',
                'tb_kabupaten.id as kabupaten_id',
                'tb_kabupaten.name as kabupaten_name',
                'tb_provinsi.id as provinsi_id',
                'tb_provinsi.name as provinsi_name',
            ])->where("sys_admin.admin_id", $admin_id)
            ->wherenull('sys_users.deleted_at')
            ->first();

        if( $query ){
            $ret->data = $query;
        }else{
            $ret->result = false;
            $ret->msg = "Users not found";
            
        }

        return $ret;
    }

    public function delete_data($request = array()) {
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";

        $pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
        try{
            $admin_id = $request['admin_id'];
			$user = SysUsers::where('admin_id',$admin_id)->join('sys_admin','sys_admin.user','sys_users.user_id')->first();
			if( $user ){
				$user_id = $user->user_id;
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
        return $ret;
    }

    public function save_data($input = array())
    {
        $ret = (object) [];
        $ret->status = 200;
		$ret->result = true;
		$ret->msg = "";

        $admin_id = $input['admin_id'];

        /* Ambil request untuk save table sys_users */
        $username       = $input['informant_name'];
        $full_name      = $input['full_name'];
        $email          = $input['email'];
        $role           = $this->roles['AdminDesa'];
        $password       = @$input['password'];
        $verification   = True; 

        /* Ambil request untuk save table sys_admin */
        $informant_name     = $input['informant_name'];
		$informant_position = $input['informant_position'];
		$informant_phone    = $input['informant_phone'];
		$informant_birthday = $input['informant_birthday'];
		$gender             = $input['gender'];
		$desa               = $input['villages'];

        $pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
        try{

            $mode = $input['mode'];
            if( $mode == "add"){
				$user = new SysUsers();
				$user->created_at = date("Y-m-d H:i:s");
				$user->created_by = Auth::User()->user_id;

                $admin = new SysAdmin();
			}else{
				$user = SysUsers::where('admin_id',$admin_id)->join('sys_admin','sys_admin.user','sys_users.user_id')->first();
				if (is_null($user)) {
					$ret->result = false;
					$ret->msg = "Token is not valid";
					return \Response::json($ret, 200);
				}
				
				$user->updated_at = date("Y-m-d H:i:s");
				$user->updated_by = Auth::User()->user_id;

                $admin = SysAdmin::where('admin_id',$admin_id)->first();
			}
            $user->role          = $role;
            $user->full_name     = $full_name;
            $user->username      = $username;
            $user->email         = $email;
            if ($password <> "") {
                $user->password      = bcrypt($password);   
            }
            $user->verification = $verification;
            $save_user = $user->save();
            if ($save_user) {
                $admin->user                = $user->user_id;
                $admin->informant_name      = $informant_name;
                $admin->informant_position  = $informant_position;
                $admin->informant_phone     = $informant_phone;
                $admin->informant_birthday  = date('Y-m-d', strtotime($informant_birthday));
                $admin->gender              = $gender;
                $admin->desa                = $desa;
                $admin->save();
                DB::commit();
            } else {
                DB::rollback();
                $ret->status = 400;
                $ret->result = false;
                $ret->msg = "Gagal menyimpan data user";
            }
            
        } catch(QueryException $e){
			DB::rollback();
            $ret->status = 400;
			$ret->result = false;
			$ret->msg = $e->getMessage();
		}
        return $ret;
    }
}