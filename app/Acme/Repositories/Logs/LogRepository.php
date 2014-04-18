<?php namespace Acme\Repositories\Logs;

class LogRepository implements LogRepositoryInterface
{
	public function log($table, $action, $userID)
	{
		return Log::create(array('table' => $table, 'action' => $action, 'user_id' => $userid));
	}
}