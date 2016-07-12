<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
    	foreach (range(1,30) as $index) {
	        DB::table('packages')->insert([
                'activity_id' => 1,
	            'destination_id' => 1,
	            'heading' => $faker->realText($maxNbChars = 40, $indexSize = 2),
	            'slug' => $faker->slug,
                'description' => $faker->realText($maxNbChars = 500, $indexSize = 2),
	            'title' => $faker->realText($maxNbChars = 40, $indexSize = 2),
	            'meta_tags' => $faker->realText($maxNbChars = 40, $indexSize = 2),
	            'meta_description' => $faker->realText($maxNbChars = 40, $indexSize = 2),
	        ]);
        }
    }
}
