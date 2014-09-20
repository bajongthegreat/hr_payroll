<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('sign in');
$I->amOnPage('/login');
$I->fillField('user', 'admin');
$I->fillField('password', '1234');
$I->click('Sign in');
$I->seeCurrentUrlEquals('/dashboard');
