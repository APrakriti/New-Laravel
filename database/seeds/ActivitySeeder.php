<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,10) as $index) {
	        DB::table('activities')->insert([
	            'heading' => $faker->realText($maxNbChars = 20, $indexSize = 2),
	            'slug' => $faker->slug,
	            'description' => $faker->realText($maxNbChars = 500, $indexSize = 2),
	            'title' => $faker->realText($maxNbChars = 20, $indexSize = 2),
	            'meta_tags' => $faker->realText($maxNbChars = 20, $indexSize = 2),
	            'meta_description' => $faker->realText($maxNbChars = 20, $indexSize = 2),
	        ]);
        }
    }
}
