<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DtrsTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create();

		DB::table('dailytimerecords')->truncate();
		$employees = DB::table('employees')->limit(50)->get();


		foreach ($employees as $employee) {
			# code...

			for ($i=1; $i < rand(10,15); $i++) { 
				# code...

				DB::table('dailytimerecords')->insert(['employee_id' => $employee->id,
																	  'shift' => 'ds',
									                                  'time_in_am' => '06:00',
									                                  'time_out_am' => '11:00',
									                                  'time_in_pm' => '13:00',
									                                  'time_out_pm' => '15:00',
									                                  'work_date' => '2014-06-' .$i,
									                                  'work_assignment_id' => rand(3,15)]);
			}
		}
	}

}