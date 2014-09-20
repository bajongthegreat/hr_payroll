<?php 
$I = new AcceptanceTester($scenario);



$I->amOnPage('/users');

perform_login($I);


// After filling up form
$I->seeCurrentUrlEquals('/users');

$I->see('Users List');

$I->click('Create new User');

// After Clicking create
$I->seeCurrentUrlEquals('/users/create');

$I->see('Create User');
$rand = rand(1,1000);

$I->fillField('username', 'admin' . $rand);
$I->fillField('email', 'admin' . $rand . '@site.com');
$I->fillField('password', '1234');
$I->fillField('password_confirmation', '1234');

$I->click('Submit');

// After Clicking create
$I->seeCurrentUrlEquals('/users');

$I->submitForm('.search-container form', ['src' => 'admin'.$rand]);
$I->see('admin'.$rand);
$I->click(' Delete');






