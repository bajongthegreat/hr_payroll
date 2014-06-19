<?php

use Carbon\Carbon;

class RatesSeeder extends Seeder {

	public function run()
	{
		DB::table('employees_flat_rates')->truncate();

		
			DB::table('employees_flat_rates')->insert([
				['rate' => 33.750,
				 'overtime_rate' => 42.188,
				 'night_premium_10_3' => 3.250,
				 'night_premium_3_6' => 4.063,
				 'parent_id' => NULL,
				 'type' => 'regular',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now()],
				 ['rate' => 43.500,
				 'overtime_rate' => 54.375,
				 'night_premium_10_3' => 4.225,
				 'night_premium_3_6' => 5.493,
				 'parent_id' => 1,
				 'type' => 'special_holiday',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 ],
				 ['rate' => 67.500,
				 'overtime_rate' => 84.375,
				 'night_premium_10_3' => 6.500,
				 'night_premium_3_6' => 8.450,
				 'parent_id' => 1,
				 'type' => 'regular_holiday',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 ],
				 ['rate' => 43.500,
				 'overtime_rate' => 54.375,
				 'night_premium_10_3' => 4.225,
				 'night_premium_3_6' => 5.493,
				 'parent_id' => 1,
				 'type' => 'restday',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 ],
				 ['rate' => 50.000,
				 'overtime_rate' => 63.375,
				 'night_premium_10_3' => 4.875,
				 'night_premium_3_6' => 6.338,
				 'parent_id' => 1,
				 'type' => 'restday_with_special_holiday',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 ],
				 ['rate' => 85.750,
				 'overtime_rate' => 107.188,
				 'night_premium_10_3' => 8.450,
				 'night_premium_3_6' => 10.985,
				 'parent_id' => 1,
				 'type' => 'restday_with_special_holiday',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 ]

			]);	 

	}

}