<?php

use Illuminate\Database\Seeder;
use App\Models\OptPendidikan;

class OptPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $PendidikanItems = [
            [
                'pendidikan_id' => 1,
                'nama_pendidikan' => 'Tidak Sekolah / Tidak Tamat SD',
            ],
            [
                'pendidikan_id' => 2,
                'nama_pendidikan' => 'SD / Sederajat',
            ],
            [
                'pendidikan_id' => 3,
                'nama_pendidikan' => 'SMP / Sederajat',
            ],
            [
                'pendidikan_id' => 4,
                'nama_pendidikan' => 'SMA / SMK / Sederajat',
            ],
            [
                'pendidikan_id' => 5,
                'nama_pendidikan' => 'Diploma',
            ],
            [
                'pendidikan_id' => 6,
                'nama_pendidikan' => 'Sarjana',
            ],
            [
                'pendidikan_id' => 7,
                'nama_pendidikan' => 'Magister',
            ],
            [
                'pendidikan_id' => 8,
                'nama_pendidikan' => 'Doktor',
            ]
        ];

        /*
           Add Geo Items
        */
        foreach ($PendidikanItems as $key => $PendidikanItem) {
            OptPendidikan::insert([
                'pendidikan_id' => $PendidikanItem['pendidikan_id'],
                'nama_pendidikan'  => $PendidikanItem['nama_pendidikan']
            ]);
        }
    }
}
