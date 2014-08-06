<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class DtrsTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create();
		$min = [00, 15,30,45];
		$shift = ['ns', 'ds','ds','ns','ds'];

		DB::table('dailytimerecords')->truncate();
		$employees = DB::table('employees')->limit(1200)->get();


		foreach ($employees as $employee) {
			# code...

			for ($i=1; $i < 29; $i++) { 
				# code...
				$sf = $shift[rand(0,4)];

				$_date = new DateTime('2014-06-' .$i);

				if (in_array($_date->format('D'), ['Sun','Sat'])) {
					continue;
				}
 
				if ($sf == 'ds')
				{
					DB::table('dailytimerecords')->insert(['employee_id' => $employee->id,
																	  'shift' => 'ds',
									                                  'time_in_am' => "0". rand(6,9) .":" . $min[rand(0,3)],
									                                  'time_out_am' => "11:" . $min[rand(0,3)],
									                                  'time_in_pm' => "13:00",
									                                  'time_out_pm' => rand(14,19) .":" . $min[rand(0,3)],
									                                  'work_date' => '2014-06-' . $i,
									                                  'work_assignment_id' => rand(3,15)]);	
				}
				else 
				{
					DB::table('dailytimerecords')->insert(['employee_id' => $employee->id,
																	  'shift' => 'ns',
									                                  'time_in_am' => "00:". $min[rand(0,3)],
									                                  'time_out_am' => "0" .rand(2,7) .":" . $min[rand(0,3)],
									                                  'time_in_pm' => "18:00",
									                                  'time_out_pm' => "23:00",
									                                  'work_date' => '2014-06-' .$i,
									                                  'work_assignment_id' => rand(3,15)]);	
				}
				
			}
		}
		// $time_out_am = '11:00';
		// $time_in_pm = "12:00";

		// $dtr_data = [
		// 	['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-02',
		// 	 'work_assignment_id' => 1],
		// 	['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '07:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '17:30',
		// 	 'work_date' => '2014-06-03',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '17:00',
		// 	 'work_date' => '2014-06-04',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-05',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '17:30',
		// 	 'work_date' => '2014-06-06',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '17:00',
		// 	 'work_date' => '2014-06-07',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '07:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-9',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-10',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-11',
		// 	 'work_assignment_id' => 1]	,
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '16:00',
		// 	 'work_date' => '2014-06-12',
		// 	 'work_assignment_id' => 1],
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-13',
		// 	 'work_assignment_id' => 1]	,
		// 	 ['employee_id' => 1,
		// 	 'shift' => 'ds',
		// 	 'time_in_am' => '06:00',
		// 	 'time_out_am' => $time_out_am,
		// 	 'time_in_pm' => $time_in_pm,
		// 	 'time_out_pm' => '18:00',
		// 	 'work_date' => '2014-06-14',
		// 	 'work_assignment_id' => 1]
		//  ];

		 // DB::table('dailytimerecords')->insert($dtr_data);
	}

}