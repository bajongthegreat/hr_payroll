<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Carbon\Carbon;
use Acme\Repositories\Holiday\Holiday as Holiday;
class HolidaysTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
		DB::table('holidays')->truncate();

		for ($i= 2013; $i <= 2020; $i++) {
			DB::table('holidays')->insert([ 
				['name' => 'New Year\'s  Day',
				 'type' => 'regular',
				 'holiday_date' => $i . '-01-01',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'New Year’s Day is a public holiday in the Philippines on January 1. Government offices, schools and most businesses are closed. Public transport is limited to reduced bus and jeep services operating during New Year’s Day.'	
				],
				['name' => 'Chinese New year',
				 'type' => 'special',
				 'holiday_date' => $i . '-01-31',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Chinese New Year is not an official holiday in the Philippines so all establishments remain open. However, some streets in several China Towns in different cities may be closed to honor this celebration.'	
				],
				['name' => 'Araw ng Kagitingan',
				 'type' => 'special',
				 'holiday_date' => $i . '-04-09',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Araw ng Kagitingan, also known as the Day of Valor, marks the greatness of Filipino fighters during World War II. It is marked on or around April 9 in the Philippines each year.'	
				],
				['name' => 'Maunday Thursday',
				 'type' => 'regular',
				 'holiday_date' => $i . '-04-17',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Maundy Thursday, which is the day before Good Friday, is a popular Christian holiday in countries such as the Philippines. It is a regular non-working holiday in the Philippines.'	
				],
				['name' => 'Good friday',
				 'type' => 'regular',
				 'holiday_date' => $i . '-04-18',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Good Friday is both a religious occasion and a public holiday, where most people follow the Christian faith. It occurs two days before Easter Sunday.'	
				],
				['name' => 'Black Saturday',
				 'type' => 'regular',
				 'holiday_date' => $i . '-04-19',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Holy Saturday commemorates the day that Jesus Christ lay in the tomb after his death, according to the Christian bible. It is the day after Good Friday and the day before Easter Sunday. It is also known as Easter Eve, Easter Even, Black Saturday, or the Saturday before Easter.'	
				],
				['name' => 'Labor Day',
				 'type' => 'regular',
				 'holiday_date' => $i . '-05-01',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'May Day, which usually occurs on May 1 in many countries, stems from ancient customs associated with the celebration of spring. It is also a national holiday for workers in many countries around the world.'	
				],
				['name' => 'Independence Day',
				 'type' => 'regular',
				 'holiday_date' => $i . '-06-12',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'One of the most significant dates in the Philippine’s history is Independence Day because it marks the nation’s independence from the Spanish rule on June 12, 1898. Filipinos celebrate it annually on June 12.'	
				],
				['name' => 'National Heroes Day',
				 'type' => 'regular',
				 'holiday_date' => $i . '-08-25',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Araw ng mga Bayani'	
				],
				['name' => 'All Saints Day',
				 'type' => 'special',
				 'holiday_date' => $i . '-11-01',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => "All Saints' Day is a celebration of all Christian saints, particularly those who have no special feast days of their own, in many Roman Catholic, Anglican and Protestant churches."	
				],
				['name' => 'Bonifacio Day',
				 'type' => 'regular',
				 'holiday_date' => $i . '-11-30',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'Bonifacio Day'	
				],
				['name' => 'Christmas Day',
				 'type' => 'special',
				 'holiday_date' => $i . '-12-25',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'N/A'	
				],
				['name' => 'Rizal Day',
				 'type' => 'regular',
				 'holiday_date' => $i . '-12-30',
				 'created_at' => Carbon::now(),
				 'updated_at' => Carbon::now(),
				 'remarks' => 'N/A'	
				]
			]);
		}
			
		
	}

}