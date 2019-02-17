<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $modules = [
	           
	            ['module' => 'User Management', 'slug'=>'users']	
                 ['module' => 'UserType', 'slug'=>'user-type'],
                ['module' => 'Configuration', 'slug'=>'configuration'],
                ['module' => 'Modules', 'slug'=>'modules']       
        	];
		
		DB::table('modules')->insert($modules);
    }
}
