<?php

class DatabaseSeeder extends Seeder {

	protected $faker;

	 public function getFaker()
	  {
	    if (empty($this->faker))
	    {
	      $this->faker = Faker\Factory::create();
	    }
	    return $this->faker;
	  }

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('CompaniesTableSeeder');
		// $this->call('MembersTableSeeder');
		// $this->call('HdmfsTableSeeder');
		// $this->call('DeductionsSeeder');
		// $this->call('UsersTableSeeder');

		
			$this->call('DtrsTableSeeder');
		// $this->call('DepartmentsTableSeeder');
		// $this->call('SssesTableSeeder');
		// $this->call('PagibigsTableSeeder');
		// $this->call('LeavesTableSeeder');
		// $this->call('PhilhealthsTableSeeder');
		// $this->call('HolidaysTableSeeder');
		// $this->call('RatesSeeder');
		// $this->call('Sss_loansTableSeeder');
		// $this->call('RequirementsTableSeeder');
		// $this->call('StageprocessesTableSeeder');
		// 	$this->call('DiseasesTableSeeder');
		// // $this->call('ViolationsTableSeeder');
		
	}



}