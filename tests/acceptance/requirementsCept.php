<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('check file maintenance');

$I->amOnPage('/requirements');

perform_login($I);

$I->seeCurrentUrlEquals('/requirements');
$I->see('Required Documents list');

$I->click('Add new Requirement');
$I->seeCurrentUrlEquals('/requirements/create');
$I->see('Add Requirement');

$document = '_codeception_requirement' . rand(0,1000);
$type = ['Original', 'Photocopy', 'Handwritten', 'Scanned'];

$I->fillField('document', $document);

$I->selectOption('document_type', $type[rand(0,3)]);
$I->selectOption('stage_process_id', 'Interview');
$I->click('Submit');

$I->seeCurrentUrlEquals('/requirements');
$I->submitForm('.search-container form', ['src' => $document]);
$I->see($document);
$I->click(' Delete');


$I->seeCurrentUrlEquals('/requirements');
$I->click('Refresh');
$I->seeCurrentUrlEquals('/requirements');
$I->see('Required Documents list');