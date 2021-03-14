<?php

use Illuminate\Database\Seeder;
use App\Models\OptGender;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         /*
            Gender Type
        */

        $GenderItems = [
            [
                'gender_id' => 1,
                'gender_name' => 'Laki Laki',
            ],
            [
                'gender_id' => 0,
                'gender_name' => 'Perempuan',
            ],
        ];

        /*
           Add Role Items
        */
        foreach ($GenderItems as $key => $GenderItem) {
            OptGender::insert([
                'gender_id' => $GenderItem['gender_id'],
                'gender_name'  => $GenderItem['gender_name']
            ]);
        }
    }
}
