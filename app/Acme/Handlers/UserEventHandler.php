<?php namespace Acme\Handlers;

use Log;
class UserEventHandler
{
	public function onDelete()
	{
		return 'Deleted';
	}

	public function onCreate()
	{
		dd('created');
	}

	public function onUpdate()
	{
		return 'updated';
	}

	public function subscribe($events)
	{
		$events->listen('user.create', 'Acme\Handlers\UserEventHandler@onCreate');
		$events->listen('user.update', 'Acme\Handlers\UserEventHandler@onUpdate');
		$events->listen('user.delete', 'Acme\Handlers\UserEventHandler@onDelete');
	}

}


?>