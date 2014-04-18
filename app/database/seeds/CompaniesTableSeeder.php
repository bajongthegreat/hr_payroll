<?php

class CompaniesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('companies')->truncate();

		$companies = array(
			['name' => 'TIBUD Cooperative',
			  'address' => 'Poblacion, Polomolok, South Cotabato'],
			  ['name' => 'Dole Philippines',
			   'address' => 'Cannery Site, Polomolok, South Cotabato']
		);

		// Uncomment the below to run the seeder
		DB::table('companies')->insert($companies);
	}

}
