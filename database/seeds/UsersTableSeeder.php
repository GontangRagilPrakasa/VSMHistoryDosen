<?php

use Illuminate\Database\Seeder;
use App\Models\SysUsers;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SysUsers::insert([
            'username'      => 'super.user',
            'full_name'     => 'Super Admin',
            'role'          => 1,
            'email'         => 'admin@mail.com',
            'password'      => bcrypt('password'),
            'verification'  => true,
            'last_login'    => NULL,
            'remember_token'=> NULL,
            'created_at'    => date('Y-m-d H:i:s'),
            'created_by'    => 1
        ]);
    }
}
