<?php

use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = [
	            ['slug' => 'home', 'title' => 'Home'],
	            ['slug' => 'destinations', 'title' => 'Destinations'],
	            ['slug' => 'packages', 'title' => 'Packages'],
	            ['slug' => 'lastminutedeals', 'title' => 'Last Minute Deals'],
	            ['slug' => 'contact', 'title' => 'Contact Us'],
	            ['slug' => 'login', 'title' => 'Login'],
	            ['slug' => 'register', 'title' => 'Register'],
	            ['slug' => 'success', 'title' => 'Success'],
	            ['slug' => 'cancel', 'title' => 'Cancel'],
	            ['slug' => 'verify', 'title' => 'Verify'],
	            ['slug' => 'search', 'title' => 'Search'],
	        ];
		
		DB::table('pages')->insert($pages);
    }
}
