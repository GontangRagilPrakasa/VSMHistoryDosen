<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\MstFakultas;
use App\Models\MstProdi;

class MasterInstansi extends Controller
{

    public function fakultas()
    {
        return view('admin.master.fakultas');
    }

    public function fakultasList(Request $input)
    {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();
        $query = MstFakultas::select(['mst_fakultas.*']);

        $keyword = $request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where("mst_fakultas.fakultas_name", "like", "%".$keyword."%");
        }

        $ret->recordsTotal = $query->get()->count();
        $ret->recordsFiltered = $query->get()->count();
        foreach($request["order"] as $i=>$order){
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $ret->data = $query->skip($request["start"])->take($request["length"])->get()->toArray();

        return \Response::json($ret,200);
    }

    public function fakultasShow(Request $input)
    {
        $ret = (object) [];
        $ret->result = true;
        $ret->msg = "";
        $ret->data = null;
        $request = $input->all();
        $fakultas_id = $request['fakultas_id'];

        $query = MstFakultas::select(['mst_fakultas.*'])
        ->where('mst_fakultas.fakultas_id',$fakultas_id)
        ->first();

        if( $query ){
            $ret->data = $query;
        }else{
            $ret->result = false;
            $ret->msg = "Data not found";
        }

        return \Response::json($ret,200);
    }

    public function fakultasSave(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        
        DB::beginTransaction();
        try{
            
            if ($request['mode'] == 'add') {
                $fakultas               = new MstFakultas();
                $fakultas->created_at   = date('Y-m-d H:i:s');
            } else {
                $fakultas              = MstFakultas::where('fakultas_id',$request['fakultas_id'])->first();
                if (is_null($fakultas)) {
                    $ret->status = 200;
                    $ret->result = true;
                    $ret->msg = "Data Tidak Ada";
                    return \Response::json($ret,200);
                }
                $fakultas->updated_at   = date('Y-m-d H:i:s');
            }

            $fakultas->fakultas_name    = $request['fakultas_name'];
            $fakultas->save();
           
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

    public function prodi()
    {
        $master_fakultas = MstFakultas::pluck('fakultas_name','fakultas_id')->toArray();
        return view('admin.master.prodi',compact('master_fakultas'));
    }

    public function prodiList(Request $input)
    {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();
        $query = MstProdi::select(['mst_prodi.*','mst_fakultas.fakultas_name'])->join('mst_fakultas','mst_fakultas.fakultas_id','mst_prodi.fakultas_id');

        $keyword = $request["keyword"];
        if( $keyword<> "" ){
            $query = $query->where("mst_fakultas.fakultas_name", "like", "%".$keyword."%")->orWhere("mst_prodi.prodi_name", "like", "%".$keyword."%");
        }

        $ret->recordsTotal = $query->get()->count();
        $ret->recordsFiltered = $query->get()->count();
        foreach($request["order"] as $i=>$order){
            $query = $query->orderBy($order["column"], $order["dir"]);
        }
        $ret->data = $query->skip($request["start"])->take($request["length"])->get()->toArray();

        return \Response::json($ret,200);
    }

    public function prodiSave(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        
        DB::beginTransaction();
        try{
            
            if ($request['mode'] == 'add') {
                $prodi               = new MstProdi();
                $prodi->created_at   = date('Y-m-d H:i:s');
            } else {
                $prodi              = MstProdi::where('prodi_id',$request['prodi_id'])->first();
                if (is_null($prodi)) {
                    $ret->status = 200;
                    $ret->result = true;
                    $ret->msg = "Data Tidak Ada";
                    return \Response::json($ret,200);
                }
                $prodi->updated_at   = date('Y-m-d H:i:s');
            }
            $prodi->fakultas_id    = $request['fakultas_id'];
            $prodi->prodi_name    = $request['prodi_name'];
            $prodi->save();
           
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

    public function prodiShow(Request $input)
    {
        $ret = (object) [];
        $ret->result = true;
        $ret->msg = "";
        $ret->data = null;
        $request = $input->all();
        $prodi_id = $request['prodi_id'];

        $query = MstProdi::select(['mst_prodi.*'])
        ->where('mst_prodi.prodi_id',$prodi_id)
        ->first();

        if( $query ){
            $ret->data = $query;
        }else{
            $ret->result = false;
            $ret->msg = "Data not found";
        }

        return \Response::json($ret,200);

    }

    public function jsonProdi($fakultas_id)
    {
        $prodi = MstProdi::where('fakultas_id',$fakultas_id)->pluck('prodi_name','prodi_id')->toArray();
        return response()->json($prodi, 200);   
    }


}
