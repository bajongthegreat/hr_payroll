<?php

class MembersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('positions')->truncate();

		$positions = array(
			
			['department_id' => 1,
			 'name' => 'Manager'],
			 ['department_id' => 2,
			 'name' => 'Accountant']

		);

		// Uncomment the below to run the seeder
		DB::table('positions')->insert($positions);
	}

}
