<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('check file maintenance');

$I->amOnPage('/violations');

perform_login($I);

$I->seeCurrentUrlEquals('/violations');
$I->see('Violations list');

$I->click('Add new Violation');
$I->seeCurrentUrlEquals('/violations/create');
$I->see('Add Violation');

$code = '1.1.' . rand(0,1000);


$I->fillField('code', $code);
$I->fillField('description', 'asdiasodiasodiaosdiqowieoqwe');
$I->selectOption('punishment_type', 'Suspended');
$I->fillFied('days_suspended', 3);





$I->click('Submit');

$I->seeCurrentUrlEquals('/violations');
$I->submitForm('.search-container form', ['src' => $code]);
$I->see($code);


$I->seeCurrentUrlEquals('/violations');
$I->click('Refresh');
$I->seeCurrentUrlEquals('/violations');
$I->see('Violations list');