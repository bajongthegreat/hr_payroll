<?php

class PhilhealthsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('philhealth')->truncate();

		$philhealth = array(
			['salary_range_start' => '100',
			 'salary_range_end' => '8999.99',
			 'employee_share' =>	'100',
			 'employer_share' => '100'	
			  ],
			['salary_range_start' => '9000',
			 'salary_range_end' => '9999.99',
			 'employee_share' =>	'112.5',
			 'employer_share' => '112.5'	
			  ],
			['salary_range_start' => '10000',
			 'salary_range_end' => '10999.99',
			 'employee_share' =>	'125',
			 'employer_share' => '125'	
			  ],
			['salary_range_start' => '11000',
			 'salary_range_end' => '11999.99',
			 'employee_share' =>	'137.5',
			 'employer_share' => '137.5'	
			  ],
			['salary_range_start' => '12000',
			 'salary_range_end' => '12999.99',
			 'employee_share' =>	'150',
			 'employer_share' => '150'	
			  ],
			['salary_range_start' => '13000',
			 'salary_range_end' => '13999.99',
			 'employee_share' =>	'162.5',
			 'employer_share' => '162.5'	
			  ],
			['salary_range_start' => '14000',
			 'salary_range_end' => '14999.99',
			 'employee_share' =>	'175',
			 'employer_share' => '175'	
			  ],
			['salary_range_start' => '15000',
			 'salary_range_end' => '15999.99',
			 'employee_share' =>	'187.5',
			 'employer_share' => '187.5'	
			  ],
			['salary_range_start' => '16000',
			 'salary_range_end' => '16999.99',
			 'employee_share' =>	'200',
			 'employer_share' => '200'	
			  ],
			['salary_range_start' => '17000',
			 'salary_range_end' => '17999.99',
			 'employee_share' =>	'212.50',
			 'employer_share' => '212.50'	
			  ],
			['salary_range_start' => '18000',
			 'salary_range_end' => '18999.99',
			 'employee_share' =>	'225',
			 'employer_share' => '225'	
			  ],
			['salary_range_start' => '19000',
			 'salary_range_end' => '19999.99',
			 'employee_share' =>	'237.5',
			 'employer_share' => '237.5'	
			  ],
			['salary_range_start' => '20000',
			 'salary_range_end' => '20999.99',
			 'employee_share' =>	'250',
			 'employer_share' => '250'	
			  ],
			['salary_range_start' => '21000',
			 'salary_range_end' => '21999.99',
			 'employee_share' =>	'262.50',
			 'employer_share' => '262.50'	
			  ],
			['salary_range_start' => '22000',
			 'salary_range_end' => '22999.99',
			 'employee_share' =>	'275',
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
		DB::table('philhealth')->insert($philhealth);
	}

}
