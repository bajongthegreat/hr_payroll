<?php namespace Acme\Composers;

class TimeComposer {

	protected $time;

	public function __construct() {
		for ($i=0; $i <= 23 ; $i++) { 
			# code...

			if ($i <= 9) {
				$this->time["0$i:00"] = "0$i:00";
				$this->time["0$i:30"] = "0$i:30";
			} else {
				$this->time["$i:00"] = "$i:00";
				$this->time["$i:30"] = "$i:30";
			}
		}
	}

	public function compose($view) 
	{
		$view->with('time', $this->time);
	}

	public function day_shift($view) {

		foreach ($time as $key => $value) {
			# code...
			
		}

		$view->with('day_shift', $day_shift);
	}


	public function night_shift($view) {

		for ($i=0; $i <= 23 ; $i++) { 
			# code...

			if ($i <= 9) {
				$this->time["0$i:00"] = "0$i:00";
				$this->time["0$i:30"] = "0$i:30";
			} else {
				$this->time["$i:00"] = "$i:00";
				$this->time["$i:30"] = "$i:30";
			}
		}

		$view->with('day_shift', $day_shift);
	}
}