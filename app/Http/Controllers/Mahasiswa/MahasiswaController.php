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
use App\Repositories\IndexDesaRepostiory;
use Session;

class MahasiswaController extends Controller
{

    public function skripsiForm()
    {
        return view('mahasiswa.list-form-skripsi');
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
            'mst_dosen_mengampu.id as judul_id',
            'mst_dosen_mengampu.start_mengampu',
            'mst_dosen_mengampu.selesai_mengampu',
            'mst_dosen_mengampu.created_at',
            DB::raw("(CASE WHEN mst_dosen_mengampu.approval=1 THEN 'Disetujui' WHEN mst_dosen_mengampu.approval=0 THEN 'Belum DiSetujui' END) as approval"),
            'sys_dosen.dosen_name'
        ])
        ->leftJoin('sys_dosen','sys_dosen.dosen_id','mst_dosen_mengampu.dosen_id')
        ->where('mst_dosen_mengampu.mahasiswa_id',$data_mahasiswa['mahasiswa_id']);

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
