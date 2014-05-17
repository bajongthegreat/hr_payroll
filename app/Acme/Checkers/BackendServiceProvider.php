<?php namespace Acme\Checkers;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{
	public function register()
	{
		// $this->app->singleton('AccessControl', function()  { 
		// 	 new AccessControl(Auth::user()->id, Auth::user()->role_id);
		// }); 
	
	}
}