<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class DestinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,12) as $index) {
	        DB::table('destinations')->insert([
	            'heading' => $faker->country,
	            'slug' => $faker->slug,
	            'title' => $faker->country,
	            'meta_tags' => $faker->country,
	            'meta_description' => $faker->country,
	        ]);
        }
    }
}
