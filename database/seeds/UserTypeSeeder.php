<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $user_types = [
	            ['role' => 'superadmin'],
	            ['role' => 'admin'],
	            ['role' => 'normaluser']
        	];
		
		DB::table('user_types')->insert($user_types);
    }
}
