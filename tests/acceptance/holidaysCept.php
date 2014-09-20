<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('check file maintenance');
$I->amOnPage('/holidays');

perform_login($I);

$I->seeCurrentUrlEquals('/holidays');

$I->see('Holiday list');

$I->click("Add Holiday");
$rand = rand(1,1000);

$I->see('Add Holiday');
$I->fillField('name', '_codception_holiday' . $rand);
$I->fillField('holiday_date', date('Y-m-d'));
$I->selectOption('type','special');
$I->fillField('remarks', 'This is a sample remark from codeception.');

$I->click('Submit');
$I->seeCurrentUrlEquals('/holidays');

$I->submitForm('.search-container form', ['src' => '_codception_holiday' . $rand]);
$I->see('_codception_holiday' . $rand);
$I->click(' Delete');