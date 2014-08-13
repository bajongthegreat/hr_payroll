<?php

class ExampleTest extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		  $mock = Mockery::mock('Acme\Repositories\Employee\EmployeeRepositoryInterface');
 	        $mock->shouldReceive('all')->once();

 	        $this->app->instance('Acme\Repositories\Employee\EmployeeRepositoryInterface', $mock);
 
  			  $this->call('GET', 'employees');
 
   		   $this->assertViewHas('employees');
	}

}