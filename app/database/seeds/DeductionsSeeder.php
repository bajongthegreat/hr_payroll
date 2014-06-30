<?php
use Carbon\Carbon;

class DeductionsSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('fixed_deductions')->truncate();
		// DB::table('companies')->truncate();

		$fixed_deductions = array(
			['name' => 'Health Care',
			 'amount' => 75,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],
			 ['name' => 'CBU - Capital Build-Up',
			  'amount' => 115,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],
			  ['name' => 'Pledge',
			   'amount' => 100,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ]
		);



		// Uncomment the below to run the seeder
		DB::table('fixed_deductions')->insert($fixed_deductions);

	}

}
