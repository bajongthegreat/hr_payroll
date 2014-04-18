@extends('layout.master')


@section('content')



<div>

     
     <div class="container-fluid">

          <div class="col-sm-3 col-md-2 sidebar" >
            

            <ul class="nav nav-sidebar">
              <li class="active"><a href="#">Employees</a></li>
              <li ><a href="#">Promotions</a></li>
              <li><a href="#">Terminations</a></li>
              <li><a href="#">Assignments</a></li>
              <li><a href="{{ action('LeavesController@index') }}">Leaves</a></li>
            </ul>
            
          </div>

  </div>




  <div class="table-container col-sm-11" style="">


  <h2 class="page-header"> Employee list</h2>

<p>Search term: <i><u><% query %></u></i></p>


  <div class="search-container col-md-4 pull-right">

  <input class="form-control " name="src" placeholder="Search an employee..." id="search" ng-model="query">

  </div>

  <div class="header-buttons pull-left">
  <a href="{{ action('EmployeesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Create new Employee</a>
   <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>

  </div>



  <table class="table table-hover" ng-controller="EmployeeController" id="employeeTable">
  	<thead>
  		<th >ID </th>
  		<th > Name </th>
  		<th>Position</th>
  		<th>Status</th>
  	</thead>

  

  	<tbody id="employees" >

     
        
            <?php foreach ($employees as $employee): ?>

             <tr class="" >

                <td class="clickableRow" href="{{ route('employees.index') }}/{{ $employee->employee_work_id }}"> <?php echo $employee->employee_work_id . '</td>'; ?>
                <td class="clickableRow" href="{{ route('employees.index') }}/{{ $employee->employee_work_id }}"> <?php echo   ucfirst($employee->lastname) . ', ' . $employee->firstname . '</td>'; ?>
                <td> <?php echo  $employee->position['name'] . '</td>'; ?>
                <td> <?php echo  $employee->employment_status . '</td>'; ?>
                <td> <a class="btn btn-small btn-default editButton" href="{{ action('EmployeesController@edit', $employee->employee_work_id ) }}"> <span class="glyphicon glyphicon-edit"></span> Edit</a> <a class="btn btn-small btn-default deleteButton" href="#" data-employee_id="{{ $employee->employee_work_id}}"> <span class="glyphicon glyphicon-remove"></span> Delete</a> </td>

               </tr>
            <?php endforeach; ?>
       

      
        
         

     
  	</tbody>
  </table>

  <?php 

  if (Input::get('search') == '') {
      echo $employees->links(); 
    } else {
      echo $employees->appends(['search' => Input::get('search') ] )->links(); 
    }

   // echo $users->appends(array('sort' => 'votes'))->links();
  ?>


  </div>

</div>



@include('partials.old_new')

@stop


@section('scripts')

<script>

(function() {
  // For clickable <tr> table rows
    $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });


    $('.deleteButton').on('click', function(e) {

      // Prevent from going back to top when clicking the button
      e.preventDefault();

      var deleteButton = $(this);

      // Get the data attribute with a key "employee_id"
      var id = deleteButton.data('employee_id');


      // Contact server to delete the employee
      $.ajax({
        type: 'DELETE',
        url: '{{ action('EmployeesController@destroy') }}',
        data: { employee_work_id: id },
        success: function(data) {
        
          if (data == "1") {
            deleteButton.closest('tr').fadeOut(255)
          }
        }
      });
      
    });


})();



// $(document).ready(function($) {
    
 

    
    // $('#search').keyup(function(e) {
    //     var searchURL =  '/employees',
    //         searchString = $(this).val();  

    //     $.ajax({
    //         method: 'GET',
    //         url: searchURL,
    //         data: { searchJSON: searchString },
    //         datatype: 'json',
    //         beforeSend: function() {
    //           console.log('loading');
    //         },
    //         success: function(data) {
    //           $('#employees').html(data);
    //         }


    //     });
    // });
       
// });

</script>

@stop