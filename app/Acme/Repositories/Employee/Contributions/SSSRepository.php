<?php namespace Acme\Repositories\Employee\Contributions;

/*** Author: James Norman Mones Jr.
**   Date: June 2014
**/

use SSS;

/** 
* Idea: Since ContributableInterface specified functions almost acts the same way with others that uses this interface,
** It may be a good idea to separate this two functions (getEmployeeShare() && getEmployerShare() ) into an abstract class.
*/

class SSSRepository extends Contributable
{

	// Get all contributions saved in the database
	protected function getContributions()
	{
		return SSS::all();
		
	}

	


}