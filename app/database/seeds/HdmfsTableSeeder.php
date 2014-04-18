<?php

class HdmfsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('hdmf')->truncate();

		$hdmfs = array(
			['salary_range_start' => '100',
			 'salary_range_end' => '1500',
			 'employee_share' =>	'0.01',
			 'employer_share' => '0.02'	
			  ],
			 ['salary_range_start' => '1500',
			 'salary_range_end' => '9999999.99',
			 'employee_share' =>	'0.02',
			 'employer_share' => '0.02'	
			  ]

			  );
		

		// Uncomment the below to run the seeder
		DB::table('hdmf')->insert($hdmfs);
	}

}
