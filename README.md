This file documents every stage of the program. 

---> Working with repositories [good]
---> Implemented some foreign libraries [good]
---> Use Tests to promote efficiency of the program


TODO::

Both Server-side and Client side
--> Finish all Contributables [SSS, Philhealth, Pagibig and Witholding TAX]
--> Start making early versions for Loans and Remittances
--> Understand what is Payroll Period and other Payroll terms to fully implement the process.
--> Reports ['Ledgers', 'Payroll Journal', 'Pay list', 'Pay slip','Payout','Remittances']


Implement --> AngularJS

 Goals of using Angular
** For the page to be more interactive
** Smoother transitions
** Be more presentable



Undecided features to implement:

Daily time record ['Not yet approved']
Holiday Management ['--']
Leaves Management ['--']




Start of code logging:

Year: 2014

January:

--> Incorporated DOM PDF libarry

February

--> Incorporated Date time picker for bootstrap

--------------------------------------- In this months, logging are active and more details are described -----------------

March:

21: Incorporated Angular JS to the system. Working on Employee Repository and expected to spread few weeks later.
29: Removed AngularJS, since the app can't work as a sigle page application (SPA)
30: Implemented "Quick lookup search" on the navigation bar to quickly lookup employees
31: Re-designed "Employees Profile -- adding panels to separate useful informations"
    ----> The establishment had their first look and impressions to the prototype of the system
April:

1: ---> Added new fields to employees table [annual_pe, ppe_issuance, with_r1a, employment_status, company_id]
   ---> Created a new table "companies"
   ---> Re-designed the form for creating employees and adding new fields to cope up the establishment needs
   ---> Defaced Employee Views [Needs reworks]
   ---> Employee "Create View" needs work on Javascript [Select only positions related to the company]
   ---> THe edit button on employee list is working again
   ---> Pagination for employees was implemented

Todo: 

- Create View on Employees
- AJAX search
- Leaves Management