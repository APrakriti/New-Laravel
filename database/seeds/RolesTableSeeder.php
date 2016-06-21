<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $roles = [
	            ['role' => 'superadmin'],
	            ['role' => 'admin'],
	            ['role' => 'normaluser']
        	];
		
		DB::table('roles')->insert($roles);
    }
}
