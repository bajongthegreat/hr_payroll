<?php

class SssesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('sss')->truncate();

		$sss = array(
			['salary_range_start' => '100',
			 'salary_range_end' => '1249.99',
			 'employee_share' =>	'36.3',
			 'employer_share' => '73.70'	
			  ],
			['salary_range_start' => '1250',
			 'salary_range_end' => '1749.99',
			 'employee_share' =>	'54.5',
			 'employer_share' => '110.5'	
			  ],
			['salary_range_start' => '1750',
			 'salary_range_end' => '2249.99',
			 'employee_share' =>	'72.70',
			 'employer_share' => '147.30'	
			  ],
			['salary_range_start' => '2250',
			 'salary_range_end' => '2749.99',
			 'employee_share' =>	'90.80',
			 'employer_share' => '184.20'	
			  ],
			['salary_range_start' => '2750',
			 'salary_range_end' => '3249.99',
			 'employee_share' =>	'109',
			 'employer_share' => '221'	
			  ],
			['salary_range_start' => '3250',
			 'salary_range_end' => '3749.99',
			 'employee_share' =>	'127.20',
			 'employer_share' => '257.80'
			  ],
			['salary_range_start' => '3750',
			 'salary_range_end' => '4249.99',
			 'employee_share' =>	'145.30',
			 'employer_share' => '294.70'
			  ],
			['salary_range_start' => '4250',
			 'salary_range_end' => '4749.99',
			 'employee_share' =>	'163.50',
			 'employer_share' => '331.50',
			  ],
			['salary_range_start' => '4750',
			 'salary_range_end' => '5249.99',
			 'employee_share' =>	'181.70',
			 'employer_share' => '368.30'	
			  ],
			['salary_range_start' => '5250',
			 'salary_range_end' => '5749.99',
			 'employee_share' =>	'199.80',
			 'employer_share' => '405.20'	
			  ],
			['salary_range_start' => '5750',
			 'salary_range_end' => '6249.99',
			 'employee_share' =>	'218',
			 'employer_share' => '442'	
			  ],
			['salary_range_start' => '6250',
			 'salary_range_end' => '6749.99',
			 'employee_share' =>	'236.20',
			 'employer_share' => '478.80'	
			  ],
			['salary_range_start' => '6750',
			 'salary_range_end' => '7249.99',
			 'employee_share' =>	'254.30',
			 'employer_share' => '515.70'	
			  ],
			['salary_range_start' => '7250',
			 'salary_range_end' => '7749.99',
			 'employee_share' =>	'272.50',
			 'employer_share' => '552.50'	
			  ],
			['salary_range_start' => '7750',
			 'salary_range_end' => '8249.99',
			 'employee_share' =>	'290',
			 'employer_share' => '275'	
			  ],
			['salary_range_start' => '23000',
			 'salary_range_end' => '23999.99',
			 'employee_share' =>	'287.5',
			 'employer_share' => '287.5'	
			  ],
			['salary_range_start' => '24000',
			 'salary_range_end' => '24999.99',
			 'employee_share' =>	'300',
			 'employer_share' => '300'	
			  ],
			['salary_range_start' => '25000',
			 'salary_range_end' => '25999.99',
			 'employee_share' =>	'312.5',
			 'employer_share' => '312.5'	
			  ],
			['salary_range_start' => '26000',
			 'salary_range_end' => '26999.99',
			 'employee_share' =>	'325',
			 'employer_share' => '325'	
			  ],
			['salary_range_start' => '27000',
			 'salary_range_end' => '27999.99',
			 'employee_share' =>	'337.5',
			 'employer_share' => '337.5'	
			  ],
			['salary_range_start' => '28000',
			 'salary_range_end' => '28999.99',
			 'employee_share' =>	'350',
			 'employer_share' => '350'	
			  ],
			['salary_range_start' => '29000',
			 'salary_range_end' => '29999.99',
			 'employee_share' =>	'362.5',
			 'employer_share' => '362.5'	
			  ],
			['salary_range_start' => '30000',
			 'salary_range_end' => '30999.99',
			 'employee_share' =>	'375',
			 'employer_share' => '375'	
			  ],
			['salary_range_start' => '31000',
			 'salary_range_end' => '31999.99',
			 'employee_share' =>	'387.5',
			 'employer_share' => '387.5'	
			  ],
			['salary_range_start' => '32000',
			 'salary_range_end' => '32999.99',
			 'employee_share' =>	'400',
			 'employer_share' => '400'	
			  ],
			['salary_range_start' => '33000',
			 'salary_range_end' => '33999.99',
			 'employee_share' =>	'412.5',
			 'employer_share' => '412.5'	
			  ],
			['salary_range_start' => '34000',
			 'salary_range_end' => '34999.99',
			 'employee_share' =>	'425',
			 'employer_share' => '425'	
			  ],
			['salary_range_start' => '35000',
			 'salary_range_end' => '9999999.99',
			 'employee_share' =>	'437.5',
			 'employer_share' => '437.5'	
			  ]

		);
		// Uncomment the below to run the seeder
		DB::table('sss')->insert($sss);
	}

}
