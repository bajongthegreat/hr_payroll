<?php
use Carbon\Carbon;

class StageprocessesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('stageprocesses')->truncate();

		$stageprocesses = array(
			['stage_process' => 'Interview',
			 'parent_id' => 0,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()],
			 ['stage_process' => 'Orientation',
			 'parent_id' => 0,
			 'created_at' => Carbon::now(),
			 'updated_at' => Carbon::now()]
		);

		// Uncomment the below to run the seeder
		DB::table('stageprocesses')->insert($stageprocesses);
	}

}
