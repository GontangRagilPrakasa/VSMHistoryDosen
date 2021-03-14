<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(OptPendidikanSeeder::class);
        $this->call(OptIdmSeeder::class);
        $this->call(OptOrganisasiDesaSeeder::class);
        $this->call(OptJobSeeder::class);
        $this->call(OptGeoTableSeeder::class);
        $this->call(PositionTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(GenderTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
