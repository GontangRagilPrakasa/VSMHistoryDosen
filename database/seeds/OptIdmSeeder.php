<?php

use Illuminate\Database\Seeder;
use App\Models\OptIndexDesa;

class OptIdmSeeder extends Seeder
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

        $IdmItems = [
            [
                'idm_id' => 1,
                'nama_idm' => 'Berkembang',
            ],
            [
                'idm_id' => 2,
                'nama_idm' => 'Maju',
            ],
            [
                'idm_id' => 3,
                'nama_idm' => 'Mandiri',
            ],
        ];

        /*
           Add Geo Items
        */
        foreach ($IdmItems as $key => $IdmItem) {
            OptIndexDesa::insert([
                'idm_status_id' => $IdmItem['idm_id'],
                'idm_status_name'  => $IdmItem['nama_idm']
            ]);
        }
    }
}
