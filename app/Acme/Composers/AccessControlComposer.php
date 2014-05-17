<?php namespace Acme\Composers;


class AccessControlComposer {



	public function compose($view) 
	{
		$acessControl = \App::make('AccessControl');
		$view->with('accessControl', $acessControl);
	}




}