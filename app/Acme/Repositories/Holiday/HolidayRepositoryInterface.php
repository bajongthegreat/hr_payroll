<?php namespace Acme\Repositories\Holiday;

use Acme\Repositories\RepositoryInterface;

interface HolidayRepositoryInterface extends RepositoryInterface {
	public function byYear($year);
}


