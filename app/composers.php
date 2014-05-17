<?php

// Load $companies variable into this views
View::composer(['positions.create','positions.edit', 'employees.create', 'employees.show', 'employees.edit', 'departments.create','departments.edit', 'applicants.create','applicants.edit'], 'Acme\Composers\CompanyComposer');

// Load $departments variable into this views
View::composer(['positions.create','positions.edit', 'employees.create', 'employees.edit'], 'Acme\Composers\DepartmentComposer');

// Employee Composer
View::composer(['employees.edit', 'employees.show', 'applicants.create','applicants.edit', 'employees.index', 'applicants.index'], 'Acme\Composers\EmployeeComposer@employee_status');
View::composer(['employees.create'], 'Acme\Composers\EmployeeComposer@employment_status_create');
View::composer(['applicants.create', 'applicants.edit'], 'Acme\Composers\EmployeeComposer@membership_status_applicant');
View::composer(['employees.create', 'employees.edit', 'employees.show'], 'Acme\Composers\EmployeeComposer@membership_status');
View::composer(['employees.create', 'employees.edit', 'employees.show', 'applicants.edit', 'applicants.create'], 'Acme\Composers\EmployeeComposer@marital_status');

// Requirement Composer
View::composer(['requirements.create', 'requirements.edit'], 'Acme\Composers\RequirementComposer@document_types');
View::composer(['applicants.show', 'employees.show'], 'Acme\Composers\RequirementComposer@raw');
View::composer(['requirements.create', 'requirements.edit'], 'Acme\Composers\StageProcessComposer');
View::composer([	'stageProcesses.create'], 'Acme\Composers\StageProcessComposer@createStageProcess');
// View::composer(['stageProcesses.index'], 'Acme\Composers\StageProcessComposer');


// Indexes
View::composer(['employees.index', 'applicants.index'], 'Acme\Composers\CompanyComposer@raw');
View::composer(['employees.index', 'applicants.index'], 'Acme\Composers\PositionComposer@raw');

// View::composer(['employees.index'],'Acme\Composers\AccessControlComposer');