<?php

namespace App\Services;

use App\Models\AlPeriode;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class PeriodeSync {

    static public function periode_per_tahun()
    {
        $tahun = date('Y');

        $al_periode = AlPeriode::where('tahun', $tahun)->count();
        if ($al_periode == 0) {
            $desa_list = DB::table('tb_desa')->select('id')->orderBy('id', 'asc')->get();
            
            DB::beginTransaction();
            foreach ($desa_list as $desa) {
              try {
                    $savePeriode = new AlPeriode();
                    $savePeriode->desa = $desa->id;
                    $savePeriode->tahun = $tahun;
                    $savePeriode->start_date = date('Y-01-01');
                    $savePeriode->end_date = date('Y-12-31');
                    $savePeriode->save();
                    
                } catch (QueryException $e) {
                    DB::rollback();
                    return false;
                }  
            }
            DB::commit();
            return true;
        }
    }
}