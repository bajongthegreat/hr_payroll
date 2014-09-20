<?php
// Here you can initialize variables that will be available to your tests

function perform_login($I) {
	// Redirected
	$I->fillField('user', 'admin');
	$I->fillField('password', '1234');
	$I->click('Sign in');
}


