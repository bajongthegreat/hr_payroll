<?php namespace Acme\Extension;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
	public function register()
	{
		$this->app->singleton('jExcel', function()  { 
			 new jExcel(new PHPExcel, new PHPExcel_Cell);
		}); 
	
	}
}