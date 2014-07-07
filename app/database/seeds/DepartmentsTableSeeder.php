<?php
use Carbon\Carbon;

class DepartmentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('departments')->truncate();
		DB::table('positions')->truncate();
		// DB::table('companies')->truncate();

		$departments = array(
			['company_id' => 2,
			 'name' => 'Field Maintenance',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],

			 ['company_id' => 2,
			 'name' => 'Harvesting',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],

			 ['company_id' => 2,
			 'name' => 'Land Preparation',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],

			 ['company_id' => 2,
			 'name' => 'AGR. RES. and Development',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],

			 ['company_id' => 2,
			 'name' => 'Manage Farm',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],

			 ['company_id' => 2,
			 'name' => 'PCFP',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ],

			 ['company_id' => 2,
			 'name' => 'FRPC',
			 'status' => 'Active',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now() ]

		);


		
		$positions = array(
			['department_id' => 1,
			 'name' => 'Handweeding',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Farm 1',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Farm 2',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Farm 3',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Trimming',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Fruit Detaching ',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Cogon Rubbing',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 1,
			 'name' => 'Fruit Bagging',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 1,
			 'name' => 'Spraying Stroller',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 1,
			 'name' => 'Plastic Retrieval',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 1,
			 'name' => 'Ant Control',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 1,
			 'name' => 'Propping',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 1,
			 'name' => 'Thinning',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 2,
			 'name' => 'Ndf Harvest',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 2,
			 'name' => 'Regular Harvest (FF/CF)',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 3,
			 'name' => 'Soil Conservation',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Mulching',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 3,
			 'name' => 'Pala Brigada',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			 ['department_id' => 3,
			 'name' => 'Survey',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Planting',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Sucker Retrieval',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Loader',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Unloader',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Sorter',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Crown Collection',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Infield Dipping',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Resetting',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 3,
			 'name' => 'Redistribution',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 4,
			 'name' => 'Greenhouse',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 4,
			 'name' => 'Research',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 5,
			 'name' => 'Handweeding',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 ['department_id' => 5,
			 'name' => 'Planting',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			  ['department_id' => 5,
			 'name' => 'Trimming/Chopping',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			  ['department_id' => 5,
			 'name' => 'Dolomite / Spraying',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			  ['department_id' => 6,
			 'name' => 'Raw Materials - Papaya',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 6,
			 'name' => 'Raw Materials - Guava',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 6,
			 'name' => 'Nata de Coco',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 6,
			 'name' => 'IQF',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 6,
			 'name' => 'Aloe Vera',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 6,
			 'name' => 'Fun Shape',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 7,
			 'name' => 'Fruit Receiving / Unloading',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 7,
			 'name' => 'MD2',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],


			  ['department_id' => 7,
			 'name' => 'BASE',
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],

			 
		);

		// Uncomment the below to run the seeder
		DB::table('departments')->insert($departments);
		DB::table('positions')->insert($positions);
	}

}
