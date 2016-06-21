<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CountrySeeder extends Seeder
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
	            ['country_name' => 'Afghanistan', 'country_code' => 'AF'],
	        ];
		
		DB::table('countries')->insert($roles);
    }
}
