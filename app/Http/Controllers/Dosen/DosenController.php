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
}
