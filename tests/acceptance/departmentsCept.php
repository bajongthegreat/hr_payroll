<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Check File maintenance');

$I->amOnPage('/departments');

perform_login($I);


// After filling up form
$I->seeCurrentUrlEquals('/departments');

$I->see('Department list');

$I->click('Add new Department');

// After Clicking create
$I->seeCurrentUrlEquals('/departments/create');

$I->see('Add Department');

$rand = rand(0,1000);
$department= '_codeception_dept' . $rand;
$I->selectOption('company_id', '2');
$I->fillField('name', $department);


$I->click('Submit');

// After Clicking create
$I->seeCurrentUrlEquals('/departments');


$I->fillField('src', $department);


$I->submitForm('.search-container form', array('src' => $department));

$I->see($department);
$I->click('Delete');







