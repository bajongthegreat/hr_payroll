<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Check file maintenance');

$I->amOnPage('/positions');

perform_login($I);

$I->seeCurrentUrlEquals('/positions');
$I->click('Add new Position');

$I->seeCurrentUrlEquals('/positions/create');
$I->selectOption('company_id', 2);

$I->waitForElement('#department', 1);
$I->selectOption('#department', 1);

$position_name = '_codeception_position' . rand(1,1000);

$I->fillField('name', $position_name);

$I->click('Submit');

$I->seeCurrentUrlEquals('/positions');

$I->submitForm('.search-container form', ['src' => $position_name]);

$I->see($position_name);
$I->click(' Delete');
