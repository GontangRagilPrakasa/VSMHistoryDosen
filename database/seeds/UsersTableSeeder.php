<?php

use Illuminate\Database\Seeder;
use App\Models\SysUsers;
use App\Models\SysMahasiswa;
use App\Models\SysDosen;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'username'      => 'super admin',
                'full_name'     => 'Super Admin',
                'role'          => 1,
                'email'         => 'admin@mail.com',
                'jk'            => 2,
                'telp'          => '089608489983',
                'password'      => bcrypt('password'),
                'verification'  => true,
                'last_login'    => NULL,
                'remember_token'=> NULL,
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => 1
            ],[
                'username'      => 'dosen',
                'full_name'     => 'Dosen',
                'role'          => 2,
                'jk'            => 2,
                'telp'          => '089608489983',
                'email'         => 'dosen@mail.com',
                'password'      => bcrypt('password'),
                'verification'  => true,
                'last_login'    => NULL,
                'remember_token'=> NULL,
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => 1
            ],[
                'username'      => 'mahasiswa',
                'full_name'     => 'Mahasiswa',
                'role'          => 3,
                'jk'            => 2,
                'telp'          => '089608489983',
                'email'         => 'mahasiswa@mail.com',
                'password'      => bcrypt('password'),
                'verification'  => true,
                'last_login'    => NULL,
                'remember_token'=> NULL,
                'created_at'    => date('Y-m-d H:i:s'),
                'created_by'    => 1
            ]
        ];

        foreach ($datas as $data) {
            $user = new SysUsers;
            $user->username =  $data['username'];
            $user->full_name =  $data['full_name'];
            $user->role =  $data['role'];
            $user->email =  $data['email'];
            $user->password =  $data['password'];
            $user->verification =  $data['verification'];
            $user->last_login =  $data['last_login'];
            $user->remember_token =  $data['remember_token'];
            $user->created_at =  $data['created_at'];
            $user->created_by =  $data['created_by'];
            $user->save();
            if ($data['role'] == 2) {
                $dosen = new SysDosen;
                $dosen->users_id        = $user->user_id;
                $dosen->dosen_name      = $data['full_name'];
                $dosen->dosen_jk        = $data['jk'];
                $dosen->dosen_telp      = $data['telp'];
                $dosen->save();

            } else if ($data['role'] == 3) {
                $mahasiswa = new SysMahasiswa;
                $mahasiswa->users_id         = $user->user_id;
                $mahasiswa->mahasiswa_name  = $data['full_name'];
                $mahasiswa->mahasiswa_jk    = $data['jk'];
                $mahasiswa->mahasiswa_telp  = $data['telp'];
                $mahasiswa->save();
            }  
        }
    }
}
