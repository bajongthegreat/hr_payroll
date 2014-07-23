<?php
use Carbon\Carbon;

class DeductionsSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('fixed_deductions')->truncate();
		// DB::table('companies')->truncate();

		$fixed_deductions = array(
			['name' => 'health_care',
			 'amount' => 125,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],
			 ['name' => 'cbu',
			  'amount' => 100,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],
			  ['name' => 'pledge',
			   'amount' => 75,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ]
		);



		// Uncomment the below to run the seeder
		DB::table('fixed_deductions')->insert($fixed_deductions);

	}

}
