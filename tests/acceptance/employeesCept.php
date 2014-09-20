<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Check File maintenance');

$I->amOnPage('/employees');


// Redirected
$I->fillField('user', 'admin');
$I->fillField('password', '1234');
$I->click('Sign in');

// After filling up form
$I->seeCurrentUrlEquals('/employees');

// Create a new employee
$I->click('Create new Employee');

// After filling up form
$I->seeCurrentUrlEquals('/employees/create');

// Fill registation form
$I->fillField('firstname', 'James');
$I->fillField('lastname', 'Mones');
$I->fillField('middlename', 'Salada');
$I->fillField('birthdate', '1993-02-16');
$I->selectOption('gender', 'Male');
$I->selectOption('marital_status', 'single');
$I->selectOption('company_id', '2');


$I->waitForElement('#department_id', 5); // secs
$I->selectOption('department_id', 1);

$I->waitForElement('#position_id', 5); // secs
$I->selectOption('position_id', 1);

$I->click('Register Employee');
$I->seeCurrentUrlEquals('/employees');
