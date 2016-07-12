<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountrySeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ModuleSeeder::class);
        $this->call(ActivitySeeder::class);
        $this->call(DestinationSeeder::class);
        $this->call(PackageSeeder::class);

        Model::reguard();
    }
}
