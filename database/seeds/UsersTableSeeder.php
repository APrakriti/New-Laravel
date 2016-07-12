<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
		
		$users = [
	            ['role_id' => 1,'first_name' => 'superadmin','last_name'=>'','email' => 'admin@ibook.com','password' => bcrypt('password'), 'is_active'=>1],
	            ['role_id' => 2,'first_name' => 'admin','last_name'=>'','email' => 'adhikarysunil.1@outlook.com','password' => bcrypt('password'), 'is_active'=>1],
	            ['role_id' => 3,'first_name' => 'normal','last_name'=>'','email' => 'thapa.kokil@gmail.com','password' => bcrypt('password'), 'is_active'=>1]
        	];
		
		DB::table('users')->insert($users);
    }
}
