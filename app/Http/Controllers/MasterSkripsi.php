<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Models\MstFakultas;
use App\Models\MstProdi;
use App\Models\MstSkripsiLog;
use App\Models\MstDosenPengampu;
use App\Models\SysMahasiswa;
use App\Models\sysDosen;

class MasterSkripsi extends Controller
{

    public function skripsi()
    {

        
        return view('admin.master.skripsi');
    }

    public function skripsiList(Request $input)
    {
        $request = $input->all();
        $ret = (object) [];
        $ret->draw = $request["draw"];
        $ret->recordsTotal = 0;
        $ret->recordsFiltered = 0;
        $ret->data = array();
        $query = SysMahasiswa::select([
            'sys_mahasiswa.mahasiswa_name',
            'sys_mahasiswa.mahasiswa_id',
            'sys_mahasiswa.mahasiswa_judul_skripsi',
            'mst_skripsi_log.skripsi_log_id',
            'mst_dosen_mengampu.id as pengampu_id',
            'mst_dosen_mengampu.approval as approval',
            DB::raw('IFNULL(sys_dosen.dosen_name, "Belum Mendapatkan Dosen") as dosen_name'),
        ])
        ->join('mst_dosen_mengampu','mst_dosen_mengampu.mahasiswa_id','sys_mahasiswa.mahasiswa_id')
        ->join('mst_skripsi_log','mst_skripsi_log.mahasiswa_id','sys_mahasiswa.mahasiswa_id')
        ->leftJoin('sys_dosen','sys_dosen.dosen_id','mst_dosen_mengampu.dosen_id')
        ->whereNotNull('sys_mahasiswa.mahasiswa_judul_skripsi')
        ->groupBy('mst_dosen_mengampu.id')
        ;

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

    public function skripsiJson($pengampu_id)
    {
        try {
            $mahasiswa = MstDosenPengampu::where('id',$pengampu_id)
            ->join('sys_mahasiswa','sys_mahasiswa.mahasiswa_id','mst_dosen_mengampu.mahasiswa_id')->first()->mahasiswa_judul_skripsi;
            
            $option_dosen_rekomendasi = array();
            $query =  str_replace(" ", "%20", $mahasiswa);
            $json=file_get_contents("http://localhost:5000/search?q=$query");
            $data = json_decode($json, true);
            foreach ($data[0]['details'] as $key => $value) {
                $option_dosen_rekomendasi[] =  [
                    'id'                => $value['dosen_id'],
                    'dosen'             => $value['dosen'] . " (". $value['judul'] ." [ ". $value['score']  ." ] )",
                ];
            }    
            return response()->json($option_dosen_rekomendasi, 200);   
        }catch(Exception $e) {
            return response()->json($e->getMessage(), 400);   
        }
        
    }

    public function skripsiStatusLog($pengampu_id)
    {
        $status = MstDosenPengampu::find($pengampu_id)->first()->approval;
        
        return view('admin.master.skripsi-status',compact('status'));
    }

    public function skripsiFormLogMahasiswa($mahasiswa_id)
    {
        $logs = MstSkripsiLog::where('mahasiswa_id',$mahasiswa_id)
        ->orderBy('mst_skripsi_log.created_at','desc')->get();
        return view('admin.master.list-log-skripsi-mahasiswa',compact('logs'));
    }

    public function skripsiSave(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        
        DB::beginTransaction();
        try{
            // update status pengampu menjadi persetujuan

            $mulai_skripsi      = date('Y-m-d');
            $selesai_skripsi    = date("Y-m-d", strtotime("+6 month")); 
            $update_pengampu_dosen = MstDosenPengampu::find($request['id']);
            $update_pengampu_dosen->approval            = 1; //permohonan disetujui
            $update_pengampu_dosen->dosen_id            = $request['dosen_id'];
            $update_pengampu_dosen->dosen_id_2          = $request['dosen_id_2'];
            $update_pengampu_dosen->start_mengampu      = $mulai_skripsi;
            $update_pengampu_dosen->selesai_mengampu    = $selesai_skripsi;
            $update_pengampu_dosen->created_at          = date('Y-m-d H:i:s');
            $update_pengampu_dosen->save();

            $mahasiswa_judul_skripsi = SysMahasiswa::find($update_pengampu_dosen['mahasiswa_id']);

            $pembimbing1 = sysDosen::find($request['dosen_id'])->dosen_name;
            $pembimbing2 = sysDosen::find($request['dosen_id_2'])->dosen_name;

            // simpan log baru 
            $skripsi_log                            = new MstSkripsiLog();
            $skripsi_log->mahasiswa_id              = $update_pengampu_dosen['mahasiswa_id'];
            $skripsi_log->mahasiswa_skripsi_name    = $mahasiswa_judul_skripsi['mahasiswa_judul_skripsi'];

            $skripsi_log->status_skripsi = 1; //permohonan disetujui
            $logs = array(
                'status'            => 'Persetujuan Judul Skripsi',
                'dari'              => 'Admin',
                'judul skripsi'     => $mahasiswa_judul_skripsi['mahasiswa_judul_skripsi'] ?? "-",
                'pembimbing 1'      => $pembimbing1,
                'pembimbing 2'      => $pembimbing2,
                'mulai skripsi'     => $mulai_skripsi,
                'selesai skripsi'   => $selesai_skripsi
            );
            $serialize = serialize($logs);
            $skripsi_log->skripsi_log = $serialize;

            $skripsi_log->dosen_id_log    = $request['dosen_id'];
            $skripsi_log->dosen_id_log_2  = $request['dosen_id_2'];
            
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

        return \Response::json($ret,200);
    }

    public function skripsiPemabatalan(Request $input)
    {
        $ret = (object) [];
        $ret->status = 200;
        $ret->result = true;
        $ret->msg = "";

        $request = $input->all();
        
        DB::beginTransaction();
        try{
            // update status pengampu menjadi pembatalan
            $update_pengampu_dosen = MstDosenPengampu::find($request['id']);
            $update_pengampu_dosen->approval = 2;
            $update_pengampu_dosen->created_at = date('Y-m-d H:i:s');
            $update_pengampu_dosen->save();

            $mahasiswa_judul_skripsi = SysMahasiswa::find($update_pengampu_dosen['mahasiswa_id']);

            // simpan log baru 
            $skripsi_log                            = new MstSkripsiLog();
            $skripsi_log->mahasiswa_id              = $update_pengampu_dosen['mahasiswa_id'];
            $skripsi_log->mahasiswa_skripsi_name    = $mahasiswa_judul_skripsi['mahasiswa_judul_skripsi'];
            $skripsi_log->status_skripsi = 2; //permohonan tidak disetujui
            $logs = array(
                'status'        => 'Pemngembalian Judul Skripsi',
                'dari'          => 'Admin',
                'judul skripsi' => $mahasiswa_judul_skripsi['mahasiswa_judul_skripsi'] ?? "-"
            );
            $temp_log = [];
            foreach ($request['alasan'] as $key => $value) {
                $number = $key +1;
                $alasan = "alasan ".$number;
                $temp_log[$alasan] = $value;
            }
            $serialize = serialize(array_merge($logs,$temp_log));
            $skripsi_log->skripsi_log = $serialize;
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

        return \Response::json($ret,200);
    }
}
