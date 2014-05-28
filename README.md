Todo:
Holidays

Currently working on:

User Roles  --> My attempt to implement RBAC in my system.

DONE:
-Annual Physical Examination result
-Violations

TODO::
**Code cleanup for employees
**Rework employees table -- remove annual_pe
**Integrate employee violations to each employee's profile.



TODO:

** Implement rates
**** Choose between flate rate and by piece rate to calculate the salary of employees
**** Remove salaries field to employees table --> This is not necessary since salary will be automatically computed


employees_salary_rate 

(1) Regular working day

Name: Regular
Hours to complete: 8
Rate: 33.750
Overtime Rate: 1.25
Holiday rate: 1
Night Premium (10-3): .10
Night Premium (3-6):  .125

(2) Regular Holiday with Work

Name: Regular Holiday with Work
Hours to complete: 8
Rate: 33.750
Overtime Rate: 2.60
Holiday rate: 1
Night Premium (10-3): .2
Night Premium (3-6):  .26

(3) REGULAR HOLIDAY + REST DAY

Name: Regular Holiday + Rest Day
Hours to complete: 8
Rate: 33.750
Overtime Rate: 3.38
Holiday rate: 1.6
Night Premium (10-3): 0.26
Night Premium (3-6):  0.338

(4) REST DAY (Sunday)

Name: Rest day (Sunday)
Hours to complete: 8
Rate: 33.750
Overtime Rate: 1.69
Holiday rate: .30
Night Premium (10-3): 0.130
Night Premium (3-6):  0.169

(5) Special Day (No work No Pay)

Name: Special Day (No work No Pay)
Hours to complete: 8
Rate: 33.750
Overtime Rate: 1.69
Holiday rate: .30
Night Premium (10-3): 0.130
Night Premium (3-6):  0.169



Timekeeping History Table

Employee ID
Date
Hours worked
Shift

Position Table

ID
Name


