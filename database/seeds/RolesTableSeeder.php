<?php

use Illuminate\Database\Seeder;
use App\Models\SysRoles;

class RolesTableSeeder extends Seeder
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

        $RoleItems = [
            [
                'role_id' => 1,
                'role_name' => 'Super Admin',
            ],
            [
                'role_id' => 2,
                'role_name' => 'Dosen',
            ],
            [
                'role_id' => 3,
                'role_name' => 'Mahasiswa',
            ],
        ];

        /*
           Add Role Items
        */
        foreach ($RoleItems as $RoleItem) {
            SysRoles::insert([
                'role_id'  => $RoleItem['role_id'],
                'role_name'  => $RoleItem['role_name']
            ]);
        }
    }
}
