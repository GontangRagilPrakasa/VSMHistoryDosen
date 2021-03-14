<?php
namespace App\Console\Commands;
 
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\AlPeriode;
use Illuminate\Database\QueryException;

class PeriodeSync extends Command
{
    /**
    * The name and signature of the console command.
    *
    * @var string
    */
    protected $signature = 'sync:periode';

    /**
    * The console command description.
    *
    * @var string
    */
    protected $description = 'Sync Periode';

    /**
    * Create a new command instance.
    *
    * @return void
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Execute the console command.
    *
    * @return mixed
    */
    public function handle()
    {
        date_default_timezone_set("Asia/Jakarta");
        $tahun = date('Y');
        $this->periode_per_tahun($tahun);
    }
    
    public function periode_per_tahun($tahun)
    {
        $al_periode = AlPeriode::where('tahun', $tahun)->count();
        if ($al_periode == 0) {
            $desa_list = DB::table('tb_desa')->select('tb_desa.id', 'tb_provinsi.name')
                ->join('tb_kecamatan', ['tb_kecamatan.id' => 'tb_desa.kecamatan_id'])
                ->join('tb_kabupaten', ['tb_kabupaten.id' => 'tb_kecamatan.kabupaten_id'])
                ->join('tb_provinsi', ['tb_provinsi.id' => 'tb_kabupaten.provinsi_id'])
                ->where('tb_provinsi.id', 52) // NTB
                ->orderBy('id', 'asc')
                ->get();
            
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