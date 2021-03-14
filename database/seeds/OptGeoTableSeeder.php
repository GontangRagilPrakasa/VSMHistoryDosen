<?php

use Illuminate\Database\Seeder;
use App\Models\OptJenisGeo;


class OptGeoTableSeeder extends Seeder
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

        $GeoItems = [
            [
                'geo_id' => 1,
                'geo_name' => 'Dataran Rendah',
            ],
            [
                'geo_id' => 2,
                'geo_name' => 'Dataran Tinggi / Pegunungan',
            ],
            [
                'geo_id' => 3,
                'geo_name' => 'Pesisir',
            ],
        ];

        /*
           Add Geo Items
        */
        foreach ($GeoItems as $key => $GeoItem) {
            OptJenisGeo::insert([
                'geo_id' => $GeoItem['geo_id'],
                'geo_name'  => $GeoItem['geo_name']
            ]);
        }
    }
}
