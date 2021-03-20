<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\MstDosenPengampu;
use App\Models\MstDosenJudul;
use App\Models\SysDosen;
use App\Repositories\IndexDesaRepostiory;
use Session;
use GuzzleHttp\Client;

class DosenController extends Controller
{
 

    public function penelitian()
    {
      
        return view('dosen.judul-penelitian');
    }

    public function listPenelitian(Request $input)
    {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();

        $data_dosen = SysDosen::select('dosen_id')->join('sys_users','sys_users.user_id','sys_dosen.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();

        $query = MstDosenJudul::select([
            'mst_dosen_judul.dosen_judul_id',
            'mst_dosen_judul.dosen_judul',
        ])
        ->where('mst_dosen_judul.dosen_id',$data_dosen['dosen_id']);

        $keyword = $request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where("mst_dosen_judul.dosen_judul", "like", "%".$keyword."%");
        }

        $ret->recordsTotal = $query->get()->count();
        $ret->recordsFiltered = $query->get()->count();
        foreach($request["order"] as $i=>$order){
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $ret->data = $query->skip($request["start"])->take($request["length"])->get()->toArray();

        return \Response::json($ret,200);
    }

    public function mahasiswa()
    {
        return view('dosen.list-mahasiswa');
    }

    public function listMahasiswa(Request $input)
    {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();

        $data_dosen = SysDosen::select('dosen_id')->join('sys_users','sys_users.user_id','sys_dosen.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();

        $query = MstDosenPengampu::select([
            'mst_dosen_mengampu.id as judul_id',
            'mst_dosen_mengampu.start_mengampu',
            'mst_dosen_mengampu.selesai_mengampu',
            DB::raw("(CASE WHEN mst_dosen_mengampu.approval=1 THEN 'Disetujui' WHEN mst_dosen_mengampu.approval=0 THEN 'Belum DiSetujui' END) as approval"),
            'sys_mahasiswa.mahasiswa_name'
        ])
        ->leftJoin('sys_mahasiswa','sys_mahasiswa.mahasiswa_id','mst_dosen_mengampu.mahasiswa_id')
        ->where('mst_dosen_mengampu.dosen_id',$data_dosen['dosen_id']);

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

    public function listSaveMahasiswa(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        if($request['mode'] == 'edit') {
            $query = MstDosenPengampu::where('id', $request['judul_id'])->update([
                'approval'      => 1
            ]);

            $ret->status = 200;
            $ret->result = true;
            $ret->msg = "Berhasil menyimpan data";
            DB::commit();
        } else if ($request['mode'] == 'delete') {
            $query = MstDosenPengampu::where('id', $request['judul_id'])->delete();

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

        return \Response::json($ret,200);
    }

    public function listPenelitianTambah()
    {
        return view('dosen.judul-penelitian-tambah');
    }

    public function listPenelitianSave(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request    = $input->all();
        $judul      = $request['judul'];

        $data_dosen = SysDosen::select('dosen_id')->join('sys_users','sys_users.user_id','sys_dosen.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();
        
        
        DB::beginTransaction();
        try{
            foreach ($judul as $key => $detail_judul) {

                $client = new Client(['base_uri' => 'http://localhost:5000']);
                $response = $client->request('POST', '/preprocessing', ['form_params' => [
                    'judul' => $detail_judul
                ]]);

                $judul_dosen                        = new MstDosenJudul();
                $judul_dosen->dosen_id              = $data_dosen['dosen_id'];
                $judul_dosen->dosen_judul           = $detail_judul;
                $judul_dosen->dosen_judul_processing  = $response->getBody();
                $judul_dosen->created_at            = date('Y-m-d H:i:s');
                $judul_dosen->save();
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

    public function listPenelitianShow(Request $input)
    {
        try {
            $ret = (object) [];
            $ret->result = true;
            $ret->msg = "";
            $ret->data = null;
            $request = $input->all();
            $dosen_judul_id = $request['dosen_judul_id'];

            
            $query = MstDosenJudul::select([
                'mst_dosen_judul.dosen_judul_id',
                'mst_dosen_judul.dosen_judul',
            ])
            ->where('mst_dosen_judul.dosen_judul_id',$dosen_judul_id)
            ->firsT();

            if( $query ){
                $ret->data = $query;
            }else{
                $ret->result = false;
                $ret->msg = "Data not found";
            }

            return \Response::json($ret,200);
        } catch(Exception $e) {
            return \Response::json($e,200);
        }
    }

    public function listPenelitianEdit(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request        = $input->all();
        $judul          = $request['dosen_judul'];
        $judul_id       = $request['dosen_judul_id'];
        DB::beginTransaction();
        try{
            $client = new Client(['base_uri' => 'http://localhost:5000']);
            $response = $client->request('POST', '/preprocessing', ['form_params' => [
                'judul' => $judul
            ]]);

            $data_dosen = SysDosen::select('dosen_id')->join('sys_users','sys_users.user_id','sys_dosen.users_id')->where('sys_users.user_id', Auth::user()->user_id)->first();
        
            $judul_dosen                            = MstDosenJudul::where('dosen_judul_id',$judul_id)->first();
            $judul_dosen->dosen_id                  = $data_dosen['dosen_id'];
            $judul_dosen->dosen_judul               = $judul;
            $judul_dosen->dosen_judul_processing    = $response->getBody();
            $judul_dosen->updated_at                = date('Y-m-d H:i:s');
            if ($judul_dosen->save()) {
                $ret->status = 200;
                $ret->result = true;
                $ret->msg = "Berhasil menyimpan data";
                DB::commit();
            }
            
        } catch(QueryException $e){
            DB::rollback();

            $ret->status = 400;
            $ret->result = false;
            $ret->msg = $e->getMessage();
        }
        return \Response::json($ret,200);
    }
}
