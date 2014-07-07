<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Carbon\Carbon;

class DiseasesTableSeeder extends Seeder {

	public function run()
	{
			// Uncomment the below to wipe the table clean before populating
		DB::table('diseases')->truncate();

		$stageprocesses = array(
			['name' => 'Urinary Tract Infection',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],
			 ['name' => 'Tuberculosis',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],
			 ['name' => 'Diabetes',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()]
		);

		// Uncomment the below to run the seeder
		DB::table('diseases')->insert($stageprocesses);
	}

}