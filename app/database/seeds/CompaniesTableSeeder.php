<?php

class CompaniesTableSeeder extends Seeder {

	public function run()
	{
			// DB::statement('SET foreign_key_checks = 0;');
			DB::statement('ALTER TABLE companies AUTO_INCREMENT = 1;');
	
		// Uncomment the below to wipe the table clean before populating
		// DB::table('companies')->select(DB::raw('select * companies where id not in (1,2)'))->delete();
		
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
