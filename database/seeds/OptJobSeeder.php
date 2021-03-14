<?php

use Illuminate\Database\Seeder;
use App\Models\OptJobs;


class OptJobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /*
            Geo Type
        */

        $JobItems = [
            [
                'job_id' => 1,
                'job_name' => 'Petani',
            ],
            [
                'job_id' => 2,
                'job_name' => 'Nelayan',
            ],
            [
                'job_id' => 3,
                'job_name' => 'Buruh Tani/Buruh Nelayan',
            ],
            [
                'job_id' => 4,
                'job_name' => ' Buruh Pabrik',
            ],
            [
                'job_id' => 5,
                'job_name' => 'PNS',
            ],
            [
                'job_id' => 6,
                'job_name' => 'Pegawai Swasta',
            ],
            [
                'job_id' => 7,
                'job_name' => 'Wiraswasta / pedagang',
            ],
            [
                'job_id' => 8,
                'job_name' => 'TNI',
            ],
            [
                'job_id' => 9,
                'job_name' => 'POLRI',
            ],
            [
                'job_id' => 10,
                'job_name' => 'Dokter (Swasta/ Honorer)',
            ],
            [
                'job_id' => 11,
                'job_name' => 'Bidan (Swasta/ Honorer)',
            ],
            [
                'job_id' => 12,
                'job_name' => 'Perawat (Swasta/ Honorer)',
            ],
            [
                'job_id' => 13,
                'job_name' => 'Lainnya',
            ],


        ];

        /*
           Add Geo Items
        */
        foreach ($JobItems as $key => $JobItem) {
            OptJobs::insert([
                'job_id' => $JobItem['job_id'],
                'job_name'  => $JobItem['job_name']
            ]);
        }
    }
}
