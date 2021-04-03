<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\SysMahasiswa;
use App\Models\MstDosenPengampu;
use App\Models\OptGender;
use App\Models\SysUsers;
use App\Models\MstFakultas;
use App\Models\MstProdi;
use App\Models\MstSkripsiLog;
use Session;

class MahasiswaController extends Controller
{
    public function profil()
    {
        $opt_jk = OptGender::pluck('gender_name','gender_id')->toArray();
        $master_mahasiswa = SysMahasiswa::select([
            'sys_mahasiswa.*',
            'opt_gender.gender_name',
        ])
        ->where('users_id', Auth::user()->user_id)
        ->join('opt_gender','opt_gender.gender_id','sys_mahasiswa.mahasiswa_jk')
        ->first();
        $fakultas   = MstFakultas::pluck('fakultas_name','fakultas_id')->toArray();
        $prodi      = MstProdi::pluck('prodi_name','prodi_id')->toArray();

        return view('mahasiswa.profil')->with([
            'master_mahasiswa'  => $master_mahasiswa,
            'opt_jk'            => $opt_jk,
            'fakultas'          => $fakultas,
            'prodi'             => $prodi
        ]);
    }

    public function profilSave(Request $request)
    {
        $element_checks = [
			'mahasiswa_name'            => 'required|string',
            'mahasiswa_telp'            => 'required|string',
            'mahasiswa_jk'              => 'required|integer',
            'mahasiswa_npm'             => 'required|string',
            'mahasiswa_tempat_lahir'    => 'required|string',
            'mahasiswa_tanggal_lahir'   => 'required|string',
            'mahasiswa_fakultas'        => 'required|integer|min:1',
            'mahasiswa_prodi'           => 'required|integer|min:1',
        ];
        $element_attributes = [
			'mahasiswa_name'            => '"Nama Mahasiswa"',
            'mahasiswa_telp'            => '"Telephone Mahasiswa"',
            'mahasiswa_jk'              => '"Jenis Kelamin Mahasiswa"',
            'mahasiswa_npm'             => 'NPM Mahasiswa',
            'mahasiswa_tempat_lahir'    => 'Tempat Lahir Mahasiswa',
            'mahasiswa_tanggal_lahir'   => 'Tanggal Lahir Mahasiswa',
            'mahasiswa_fakultas'        => 'Fakultas Mahasiswa',
            'mahasiswa_prodi'           => 'Program Studi Mahasiswa',
		];

        $validator = Validator::make($request->all(), $element_checks)->setAttributeNames($element_attributes);
		if ($validator->fails()) {
			$res["result"] = false;
			$res["msg"] = $validator->messages()->all();
            return response()->json($res);
        }

        $request = $request->all();

        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        DB::beginTransaction();
        try{

            $master_mahasiswa = SysMahasiswa::where('users_id', Auth::user()->user_id)->first();
            $user             = SysUsers::where('user_id', $master_mahasiswa['users_id'])->first();

            $user->full_name    = $request['mahasiswa_name'];
            $user->username     = $request['mahasiswa_name'];

            if ($user->save()) {
                $master_mahasiswa->mahasiswa_name               = $request['mahasiswa_name'];
                $master_mahasiswa->mahasiswa_telp               = $request['mahasiswa_telp'];
                $master_mahasiswa->mahasiswa_jk                 = $request['mahasiswa_jk'];
                $master_mahasiswa->mahasiswa_npm                = $request['mahasiswa_npm'];
                $master_mahasiswa->mahasiswa_tempat_lahir       = $request['mahasiswa_tempat_lahir'];
                $master_mahasiswa->mahasiswa_tanggal_lahir      = date('Y-m-d', strtotime($request['mahasiswa_tanggal_lahir']));
                $master_mahasiswa->mahasiswa_fakultas           = $request['mahasiswa_fakultas'];
                $master_mahasiswa->mahasiswa_prodi              = $request['mahasiswa_prodi'];

            }
            

            if ($master_mahasiswa->save()) {
                $ret->status = 200;
                $ret->result = true;
                $ret->msg = "Berhasil menyimpan data";
                DB::commit();

            } else {
                DB::rollback();

                $ret->status = 400;
                $ret->result = false;
                $ret->msg = "Gagal menyimpan data";
            }
                
        } catch(QueryException $e){
            DB::rollback();

            $ret->status = 400;
            $ret->result = false;
            $ret->msg = $e->getMessage();
        }
        
		return \Response::json($ret, 200);
    }

    public function skripsiForm()
    {
        $skripsi = SysMahasiswa::join('sys_users','sys_users.user_id','sys_mahasiswa.users_id')->where('sys_users.user_id', Auth::user()->user_id)
        ->join('mst_dosen_mengampu','mst_dosen_mengampu.mahasiswa_id','sys_mahasiswa.mahasiswa_id')->first()->approval;

        return view('mahasiswa.list-form-skripsi',compact('skripsi'));
    }

    public function listskripsiForm(Request $input)
    {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();

        $data_mahasiswa = SysMahasiswa::select('mahasiswa_id')->join('sys_users','sys_users.user_id','sys_mahasiswa.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();

        $query = MstSkripsiLog::select([
            'mst_dosen_mengampu.id as dosen_id_mengampu',
            'mst_dosen_mengampu.start_mengampu',
            'mst_dosen_mengampu.selesai_mengampu',
            'mst_skripsi_log.created_at',
            DB::raw("(CASE WHEN mst_skripsi_log.status_skripsi=0 THEN 'Tahap Pengajuan' WHEN mst_skripsi_log.status_skripsi=1 THEN 'DiSetujui' WHEN mst_skripsi_log.status_skripsi=2 THEN 'Pengajuan Pembatalan' WHEN status_skripsi=3 THEN 'Pembatalan Skripsi' END) as approval"),
            'mst_dosen_mengampu.approval as approval_status',
            DB::raw('IFNULL(sys_dosen.dosen_name, "Belum Mendapatkan Dosen") as dosen_name'),
            DB::raw('IFNULL(dosen2.dosen_name, "Belum Mendapatkan Dosen") as dosen_name_2'),
            'mst_skripsi_log.skripsi_log_id'
        ])
        ->join('mst_dosen_mengampu','mst_dosen_mengampu.mahasiswa_id','mst_skripsi_log.mahasiswa_id')
        ->leftJoin('sys_dosen','sys_dosen.dosen_id','mst_skripsi_log.dosen_id_log')
        ->leftJoin('sys_dosen as dosen2','dosen2.dosen_id','mst_skripsi_log.dosen_id_log_2')
        ->where('mst_dosen_mengampu.mahasiswa_id',$data_mahasiswa['mahasiswa_id'])
        ->orderBy('mst_skripsi_log.created_at','desc');

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

    public function skripsiFormLog($skripsi_log_id)
    {
        $data = MstSkripsiLog::find($skripsi_log_id)->skripsi_log;
        return view('mahasiswa.list-log-skripsi',compact('data'));
    }

    public function pengajuanSkripsi(Request $request)
    {
        try{
            $ret = (object) [];
            $ret->status = 200;
            $ret->result = true;
            $ret->msg = "";

            $input = $request->all();

            $data_mahasiswa = SysMahasiswa::select('mahasiswa_id')->join('sys_users','sys_users.user_id','sys_mahasiswa.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();

            $data_mahasiswa->mahasiswa_judul_skripsi = $input['mahasiswa_judul_skripsi'];
            $data_mahasiswa->save();

            $rekomendasi_dosen = MstDosenPengampu::where('mahasiswa_id',$data_mahasiswa['mahasiswa_id'])->first();

            if(is_null($rekomendasi_dosen)) {
                $rekomendasi_dosen = new MstDosenPengampu();
            }

            $rekomendasi_dosen->mahasiswa_id = $data_mahasiswa['mahasiswa_id'];
            $rekomendasi_dosen->approval = 0;
            $rekomendasi_dosen->save();

            $skripsi_detail = array(
                'status'            => 'Pengajuan Skripsi',
                'dari'              => 'Mahasiswa',
                'Judul Skripsi'     => $input['mahasiswa_judul_skripsi']    
            );
            $serialize = serialize($skripsi_detail);

            $skripsi_log = new MstSkripsiLog();
            $skripsi_log->mahasiswa_id              = $data_mahasiswa['mahasiswa_id'];
            $skripsi_log->mahasiswa_skripsi_name    = $input['mahasiswa_judul_skripsi'];
            $skripsi_log->status_skripsi            = 0; // default pengajuan
            $skripsi_log->skripsi_log               = $serialize;
            $skripsi_log->save();
            
            
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

        return \Response::json($ret, 200);
    }
}
