'use strict';

// <------- Main ------------>

var app = angular.module('app', ['AppControllers','EmployeeService'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
	});




// Controller holder array
var hrpayControllers = angular.module('AppControllers', []);


// <------- Controllers ------------>

// Employee Controller
hrpayControllers.controller('EmployeeController', ['$scope', '$http', '$location', 'Employee',
  function($scope, $http, $location, Employee) {

    // Get all employees
    Employee.get()
         .success(function(data) {

              $scope.employees = data;
              
              $scope.loading = false;
        });


    $scope.promoteClick = function() {
          
            console.log('Processing Promotion...');
            Employee.promote($scope.employeeData);
    }
    
   // Function to handle submition of form
   // Save an Employee
    $scope.submitEmployee = function() {
      $scope.loading = true;

      // Save the employee and pass in employee data from form 
      // use the function we created in our service
      Employee.save($scope.employeeData)
        .success(function(data) {

          // if successful, we'll need to refresh the employee list
          Employee.get()
            .success(function(getData) {
              $scope.employees = getData;
              $scope.loading = false;
            });

        })
        .error(function(data) {
          console.log(data);
        });
    };


    // Function to handle deletion of an employee
    // Deletes an Employee
    $scope.deleteEmployee = function(id) {
      $scope.loading = true; 

      // use the function we created in our service
      Employee.destroy(id)
        .success(function(data) {

          // if successful, we'll need to refresh the employee list
          Employee.get()
            .success(function(getData) {
              $scope.employees = getData;
              $scope.loading = false;
            });

        });
    };

   
    // $scope.orderProp = 'age';
  }]);





// <---- Routes ---->
//This configures the routes and associates each route with a view and a controller



// <------- Services ------------>

angular.module('EmployeeService', [])

  .factory('Employee', function($http) {

    return {
      // get all the employees
      get : function() {
        console.log('(inside get() ) Processing.. ');
        return $http.get('/api/employees/?output=json');
      },

      getPosition: function(employee_id) {
        console.log('(inside getPosition() ) Processing.. ');
        return $http.get('/api/employees/getPosition?employee_id=' + employee_id);
      },

      promote: function (employeeData) {

         console.log('(inside function) Processing Promotion...');


         // Figure out how to work with employee data to send to our server
         // This is just a  suspected error, search for more possible solutions

        return $http({
            method: "POST",
            url: '/api/promote',
            headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
            data: { employee_id: 1},
            success: function() {
              console.log('Reached server... And this is the response.');
            },
            error: function() {
              console.log('Something went wrong with the request. Please check!');
            }
        });
      },

      // save a employee (pass in employee data)
      save : function(employeeData) {
        return $http({
          method: 'POST',
          url: '/api/employees',
          headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
          data: $.param(employeeData),
          success: function () {
            console.log('Reached the server!');
          }
        });
      },

      // destroy a employee
      destroy : function(id) {
        return $http.delete('/api/employees/' + id);
      }
    }

  });
  










