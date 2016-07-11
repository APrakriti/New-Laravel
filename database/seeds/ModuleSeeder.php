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
	            ['module' => 'Banner Management', 'slug'=>'banners'],
	            ['module' => 'Content Management', 'slug'=>'contents'],
	            ['module' => 'Activity Management', 'slug'=>'activities'],
	            ['module' => 'Destination Management', 'slug'=>'destinations'],
	            ['module' => 'Package Management', 'slug'=>'packages'],
	            ['module' => 'Booking Management', 'slug'=>'bookings'],
	            ['module' => 'Testimonial Management', 'slug'=>'testimonials'],
	            ['module' => 'User Management', 'slug'=>'users']	            
        	];
		
		DB::table('modules')->insert($modules);
    }
}
