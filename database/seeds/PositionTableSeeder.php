<?php

use Illuminate\Database\Seeder;
use App\Models\OptPosition;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
            Roles Type
        */

        $PositionItems = [
            [
                'position_id'   => 1,
                'position_name' => 'Sekretaris Desa',
            ],
            [
                'position_id'   => 2,
                'position_name' => 'Kasi Pemerintahan',
            ],
        ];

        /*
           Add Role Items
        */
        foreach ($PositionItems as $PositionItem) {
            OptPosition::insert([
                'position_id'       => $PositionItem['position_id'],
                'position_name'     => $PositionItem['position_name']
            ]);
        }
    }
}
