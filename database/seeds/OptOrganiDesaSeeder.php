<?php

use Illuminate\Database\Seeder;
use App\Models\OptOrganisasiDesa;

class OptOrganisasiDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /*
            Organisasi Type
        */

        $OtganiDesaItems = [
            [
                'organisasi_id' => 1,
                'nama_organisasi' => 'Sekretaris Desa ',
            ],
            [
                'organisasi_id' => 2,
                'nama_organisasi' => 'Kepala Urusan Tata Usaha dan Umum ',
            ],
            [
                'organisasi_id' => 3,
                'nama_organisasi' => 'Kepala Urusan Keuangan ',
            ],
            [
                'organisasi_id' => 4,
                'nama_organisasi' => 'Kepala Urusan Perencanaan ',
            ],
            [
                'organisasi_id' => 5,
                'nama_organisasi' => 'Kepala seksi pemerintahan ',
            ],
            [
                'organisasi_id' => 6,
                'nama_organisasi' => 'Kepala seksi kesejahteraan ',
            ],
            [
                'organisasi_id' => 7,
                'nama_organisasi' => ' Kepala seksi pelayanan ',
            ],
            [
                'organisasi_id' => 8,
                'nama_organisasi' => 'Staf petugas Desa ',
            ],
            [
                'organisasi_id' => 9,
                'nama_organisasi' => 'BPD dan Anggota ',
            ],
            [
                'organisasi_id' => 10,
                'nama_organisasi' => ' LPM dan Anggota ',
            ],
            [
                'organisasi_id' => 11,
                'nama_organisasi' => 'TP. PKK Desa ',
            ],
            [
                'organisasi_id' => 12,
                'nama_organisasi' => 'Kepala Dusun ',
            ],
            [
                'organisasi_id' => 13,
                'nama_organisasi' => 'Ketua RW ',
            ],
            [
                'organisasi_id' => 14,
                'nama_organisasi' => 'Ketua RT',
            ],
        ];

        /*
           Add Geo Items
        */
        foreach ($OtganiDesaItems as $key => $OtganiDesaItem) {
            OptOrganisasiDesa::insert([
                'organisasi_id' => $OtganiDesaItem['organisasi_id'],
                'nama_organisasi'  => $OtganiDesaItem['nama_organisasi']
            ]);
        }
    }
}
