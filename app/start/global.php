<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
	Log::error($exception);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';


/*
|--------------------------------------------------------------------------
| Event Handlers
|--------------------------------------------------------------------------
|
*/

Event::subscribe('Acme\Handlers\UserEventHandler');

/*
|--------------------------------------------------------------------------
| Requires all View composer
|--------------------------------------------------------------------------
|
*/

require app_path().'/composers.php';
require app_path().'/Acme/Extension/Validation/CustomValidator.php';
require app_path().'/Acme/Extension/Validation/CustomValidatorResolver.php';

$GLOBALS['_byPassRole'] = [0,1];

function dateDiff($start, $end, $output_type) {

		$result = "";
		$ts1 = strtotime($start);
		$ts2 = strtotime($end);



		$seconds_diff = $ts2 - $ts1;

		switch ($output_type) {
			case 'months':
				$result = round($seconds_diff/2419200,0);
				break;
			case 'days':
				$result = round($seconds_diff/86400,0);
			break;

			case 'weeks':
			$result = round($seconds_diff/604800,0);
			break;

			case 'year':
			$result = round($seconds_diff/31536000,0);
			break;
			
			default:
				$result = $seconds_diff;
				break;
		}

		if ($result == 0 ) $result =1 ;
		

		return $result;
	}
function isDateValid($date) {
	if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date))
    {
        return true;
    }else{
        return false;
    }
}

function monthName($month_number) {
	$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October','Novermber', 'December'];

	if ($month_number > 12  || $month_number < 1) {
		throw new Exception('Invalid month');
	}

	return $months[$month_number - 1 ];
}
