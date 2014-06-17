<?php

// Load $companies variable into this views
View::composer(['positions.create','positions.edit', 'employees.create', 'employees.show', 'employees.edit', 'departments.create','departments.edit', 'applicants.create','applicants.edit'], 'Acme\Composers\CompanyComposer');

// Load $departments variable into this views
View::composer(['positions.create','positions.edit', 'employees.create', 'employees.edit','dtr.partials.bulk','dtr.partials.bulk-edit'	], 'Acme\Composers\DepartmentComposer');

// Load $departments variable into this views
View::composer(['employees.index'], 'Acme\Composers\DepartmentComposer@all');


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

View::composer(['dtr.partials.bulk','dtr.partials.bulk-edit'], 'Acme\Composers\TimeComposer');



View::composer(['users.edit'], 'Acme\Composers\RolesComposer');
View::composer(['employees.partial.medical'], 'Acme\Composers\MedicalExaminationsComposer');
View::composer(['employees.medical_examination.partials.single_add', 'employees.medical_examination.partials.bulk_add'], 'Acme\Composers\MedicalExaminationsComposer@medical_establishments');
View::composer(['employees.medical_examination.partials.single_add'], 'Acme\Composers\MedicalExaminationsComposer@medical_findings');
View::composer(['employees.medical_examination.partials.single_add'], 'Acme\Composers\MedicalExaminationsComposer@recommendations');
// View::composer(['employees.index'],'Acme\Composers\AccessControlComposer');


View::composer(['employees.partial.leaves'], 'Acme\Composers\LeavesComposer@leavesObject');
View::composer(['employees.partial.violations'], 'Acme\Composers\EmployeeViolationsComposer@ViolationsObject');
View::composer([ 'disciplinary_actions.index'], 'Acme\Composers\ViolationComposer@ViolationsObject');


View::composer(['disciplinary_actions.create', 'disciplinary_actions.edit'], 'Acme\Composers\ViolationComposer');