<?php

class UsersTableSeeder extends DatabaseSeeder {

	public function run()
	{
		// Get a faker instance
		$faker = $this->getFaker();
		$users = NULL;


		// Uncomment the below to wipe the table clean before populating
		DB::table('users')->truncate();


		// Default user
		$users[] = array('username' => 'admin', 'email' => 'admin@example.com', 'password' => Hash::make('1234'), 'status' => 'Active');

		// Random users
		for($i=0; $i<5; $i++)
		{
			$users[] = array('username' => strtolower($faker->firstname) ,
				  'email' => $faker->email,
				  'password' => Hash::make('1234'),
				  'status' => 'Active');
		}

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
