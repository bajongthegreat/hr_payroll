<?php namespace Acme\Repositories\Logs;

interface LogRepositoryInterface
{
	public function log($table, $action, $userID);
}

?>