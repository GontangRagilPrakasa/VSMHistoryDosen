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
use App\Repositories\IndexDesaRepostiory;
use Session;

class MahasiswaController extends Controller
{
    public function profil()
    {
        $opt_jk = OptGender::pluck('gender_name','gender_id')->toArray();
        $master_mahasiswa = SysMahasiswa::select([
            'sys_mahasiswa.*',
            'opt_gender.gender_name',
            'mst_dosen_mengampu.approval'
        ])
        ->where('users_id', Auth::user()->user_id)
        ->join('opt_gender','opt_gender.gender_id','sys_mahasiswa.mahasiswa_jk')
        ->leftJoin('mst_dosen_mengampu','mst_dosen_mengampu.mahasiswa_id','sys_mahasiswa.mahasiswa_id')
        ->first();

        return view('mahasiswa.profil')->with([
            'master_mahasiswa'  => $master_mahasiswa,
            'opt_jk'            => $opt_jk
        ]);
    }

    public function profilSave(Request $request)
    {
        $element_checks = [
			'mahasiswa_name'    => 'required|string',
            'mahasiswa_telp'    => 'required|string',
            'mahasiswa_jk'      => 'required|integer',
        ];
        $element_attributes = [
			'mahasiswa_name'    => '"Nama Mahasiswa"',
            'mahasiswa_telp'    => '"Telephone Mahasiswa"',
            'mahasiswa_jk'      => '"Jenis Kelamin Mahasiswa"',
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
            
            if (is_null($master_mahasiswa)) {
                $master_mahasiswa = new SysMahasiswa();
            }

            $master_mahasiswa->mahasiswa_name      = $request['mahasiswa_name'];
            $master_mahasiswa->mahasiswa_telp      = $request['mahasiswa_telp'];
            $master_mahasiswa->mahasiswa_jk        = $request['mahasiswa_jk'];

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
        $data_mahasiswa = SysMahasiswa::select(['mahasiswa_judul_skripsi', 'mahasiswa_id'])
        ->join('sys_users','sys_users.user_id','sys_mahasiswa.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();

        $option_dosen_rekomendasi = array();
        $dosen_judul_id = array();
        if (!is_null($data_mahasiswa)) {
            $status_skripsi = MstDosenPengampu::select(['approval'])->where('mahasiswa_id',$data_mahasiswa['mahasiswa_id'])->first();
            
            if (is_null($status_skripsi)) {
                $query =  str_replace(" ", "%20", $data_mahasiswa['mahasiswa_judul_skripsi']);
                $json=file_get_contents("http://localhost:5000/search?q=$query");
                $data = json_decode($json, true);
                
                if(empty($data)) {
                    $option_dosen_rekomendasi[] = [];
                } else {
                    foreach ($data[0]['details'] as $key => $value) {
                        $option_dosen_rekomendasi[] =  [
                            'id'                => $value['dosen_id'],
                            'dosen'             => $value['dosen'] . " judul = ". $value['judul'] ." ( ". $value['score']  ." )",
                        ];
                    }
                }                
            }
        }

        return view('mahasiswa.list-form-skripsi')->with([
            'option_dosen_rekomendasi'      => $option_dosen_rekomendasi,
            'status_skripsi'                => $status_skripsi['approval']
        ]);
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

        $query = MstDosenPengampu::select([
            'mst_dosen_mengampu.id as dosen_id_mengampu',
            'mst_dosen_mengampu.start_mengampu',
            'mst_dosen_mengampu.selesai_mengampu',
            'mst_dosen_mengampu.created_at',
            DB::raw("(CASE WHEN mst_dosen_mengampu.approval=0 THEN 'Belum DiSetujui' WHEN mst_dosen_mengampu.approval=1 THEN 'DiSetujui' WHEN mst_dosen_mengampu.approval=2 THEN 'Pengajuan Pembatalan' END) as approval"),
            'mst_dosen_mengampu.approval as approval_status',
            'sys_dosen.dosen_name'
        ])
        ->leftJoin('sys_dosen','sys_dosen.dosen_id','mst_dosen_mengampu.dosen_id')
        ->where('mst_dosen_mengampu.mahasiswa_id',$data_mahasiswa['mahasiswa_id']);

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

    public function pengajuanSkripsi(Request $request)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $input = $request->all();

        $data_mahasiswa = SysMahasiswa::select('mahasiswa_id')->join('sys_users','sys_users.user_id','sys_mahasiswa.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();
        
        $rekomendasi_dosen = new MstDosenPengampu();
        $rekomendasi_dosen->dosen_id = $input['rekomendasi_dosen'];
        $rekomendasi_dosen->mahasiswa_id = $data_mahasiswa['mahasiswa_id'];
    
        if ($rekomendasi_dosen->save()) {
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

        return \Response::json($ret, 200);
    }

    public function pengajuanBatalskripsi(Request $request)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $input = $request->all();
        $changeStatus = MstDosenPengampu::where('id',$input['data'])->update([
            'approval'      => 2 //Status Dibatalkan
        ]);

        if ($changeStatus) {
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

        return \Response::json($ret, 200);
    }
}
