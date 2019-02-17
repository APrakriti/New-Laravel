<?php

use Illuminate\Database\Seeder;

class AccessListTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $access_lists = [
               ['user_type'=>1,'module_id'=>1,'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1,'access_publish' => 1,'access_trash'=>1,'access_reterive'=>1,'is_active' =>1],
	            ['user_type'=>1,'module_id'=>2,'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1,'access_publish' => 1,'access_trash'=>1,'access_reterive'=>1,'is_active' =>1],
	            ['user_type'=>1,'module_id'=>3,'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1,'access_publish' => 1,'access_trash'=>1,'access_reterive'=>1,'is_active' =>1],
                ['user_type'=>1,'module_id'=>4,'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1,'access_publish' => 1,'access_trash'=>1,'access_reterive'=>1,'is_active' =>1],
                ['user_type'=>2,'module_id'=>3,'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1,'access_publish' => 1,'access_trash'=>1,'access_reterive'=>1,'is_active' =>1],
	            ['user_type'=>2,'module_id'=>4,'access_view' => 1, 'access_add' => 1, 'access_delete' => 1, 'access_update' => 1,'access_publish' => 1,'access_trash'=>1,'access_reterive'=>1,'is_active' =>1]
        	];
		
		DB::table('access_lists')->insert($access_lists);
    }
}
