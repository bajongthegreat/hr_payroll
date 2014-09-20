<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('check file maintenance');


$I->amOnPage('/stageprocesses');

perform_login($I);

$I->seeCurrentUrlEquals('/stageprocesses');

$I->see('Stage Process list');
$I->click('Create new Stage Process');

$I->seeCurrentUrlEquals('/stageprocesses/create');

$stage_process = '_codeception_stage_process' . rand(1,1000);

$I->fillField('stage_process', $stage_process);

$stageprocesses = ['Interview', 'Orientation'];

$I->selectOption('parent_id', $stageprocesses[rand(0,1)]);
$I->click("Submit");

$I->seeCurrentUrlEquals('/stageprocesses');

$I->submitForm('.search-container form', ['src' => $stage_process]);
$I->see($stage_process);

$I->click(' Delete');	