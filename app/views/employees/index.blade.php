@extends('layout.master')


@section('content')



<div>
     
  @include('partials.sidebar')




  <div class="table-container col-sm-11">


  <h2 class="page-header"> Employee list</h2>

  @include('partials.breadcrumbs')

@if ($accessControl->hasAccess('employees/medical_examinations', 'view', $GLOBALS['_byPassRole']) || 
     $accessControl->hasAccess('leaves', 'view', $GLOBALS['_byPassRole']) ||
     $accessControl->hasAccess('employees/disciplinary_actions', 'view', $GLOBALS['_byPassRole']) )
<div class="panel panel-default smooth-panel-edges" >
      <div class="panel-body">
      
        <div class="parent">
    @if ($accessControl->hasAccess('employees/medical_examinations', 'view', $GLOBALS['_byPassRole']))        
  <div class="child">
      <a href="{{ action('EmployeesMedicalExaminationsController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-th  "></span> Manage Medical Examinations</a>
</div>

  @endif

 @if ($accessControl->hasAccess('leaves', 'view', $GLOBALS['_byPassRole']))
<div class="child">
      <a href="{{ action('LeavesController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-dashboard"></span> Manage Leaves</a>
</div>
@endif
  

 @if ($accessControl->hasAccess('employees/disciplinary_actions', 'view', $GLOBALS['_byPassRole']))
<div class="child">
      <a href="{{ action('DisciplinaryActionsController@index') }}" class="btn btn-default"> <span class="glyphicon glyphicon-dashboard"></span> Disciplinary Actions</a>
</div>
@endif
    </div>


      </div>
</div>
@endif

  @if (Input::has('src'))
  <p>Search term: <span class="label label-default">{{Input::get('src') }}</span></p>
  @endif

  


  <div class="search-container col-md-4 pull-right">
   {{ Form::open(['method' => 'GET', 'action' => 'EmployeesController@index'])}}
   <?php  $request_param = Input::except('_token', '_method', 'src'); ?>

  <input class="form-control " name="src" placeholder="Search an employee..." id="search" ng-model="query" value="{{Input::get('src')}}">
  
  <!-- Retain query strings even while searching -->
   @foreach($request_param as $key => $value)
      {{Form::hidden($key, $value)}}
   @endforeach

  {{ Form::close()}}


  </div>

  <div class="header-buttons pull-left">
    @if ($accessControl->hasAccess($uri, 'create', $GLOBALS['_byPassRole']))
  <a href="{{ action('EmployeesController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Create new Employee</a>
    @endif
   <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
 
     
 

  </div>

  
<table class="table table-hover tablesorter">
    <thead>
      <th></th>
      <!-- Image -->
      <th></th> 
      <th></th>

    </thead>

    <tbody>
       @foreach ($employees as $employee)

              <?php 
              // dd($employees); 
              // Birth date
              if ($employee->birthdate == '0000-00-00' || $employee->birthdate == '') {
                // echo '<span class="label label-default">Not specified</span>';
              } else {

                $date = new DateTime($employee->birthdate);

                $datetime1 = date_create($employee->birthdate);
                  $datetime2 = date_create(date('Y-m-d'));
                  
                  $interval = date_diff($datetime1, $datetime2);

                  $age = '(' . $interval->format('%y') .' years old) ';
                  $birthdate_raw = $date->format('F m, Y');

              }

              $took_pe = DB::table('employees_physical_examinations')->where('employee_id', '=', $employee->id)
                                                                     ->where(DB::raw(' YEAR(date_conducted) '), '=', date('Y'))
                                                                     ->count();
              if ($took_pe > 0) $took_pe = true;
              else $took_pe = false;

              // Date Hired
             if ($employee->date_hired && $employee->date_hired != "0000-00-00" && $employee->date_hired != "") {
                $d_hired = new DateTime($employee->date_hired);

                $datetime1 = date_create($employee->date_hired);
                  $datetime2 = date_create(date('Y-m-d'));
                  
                  $date_hired_interval = date_diff($datetime1, $datetime2);
                  
                  if ( $date_hired_interval->format('%y') == 0) {
                    $date_hired = $d_hired->format('F d,  Y') . ' ( ' . $date_hired_interval->format('%m') .' month(s) and ' . $date_hired_interval->format('%d') .' day(s)  in service)';
                  } else {
                    
                    if ($date_hired_interval->format('%y') == 1) {
                      $year_str = 'year';
                    } else {
                      $year_str = 'years';
                  } 

                  $date_hired = $d_hired->format('F d,  Y') . ' (' . $date_hired_interval->format('%y') .' ' . $year_str .' in service)';
              } 
            } else {
              $date_hired = "Not specified";
            }

              $photo = ($employee->image != "") ? $employee->image : 'img/default-avatar.png'; 
              ?>
      <tr>
        <!-- <td><input type="checkbox" data-employee_id="{{ $employee->id }}" class="employee-item-checkbox" style="margin-top: 54px;"></td> -->
        <td width="125px"> <a href="{{ route('employees.show', $employee->employee_work_id) }}"> <img class="img-thumbnail" src="{{ asset($photo) }}" style="width:120; height:120;"> </a></td>
        <td colspan="5">
            <div class="short-profile" style="width: 70%; float:left;">
                  <div class="name" style="font-size: 15px; "> <strong> <u>{{ strtoupper($employee->lastname) }}, {{ strtoupper($employee->firstname)}}</u> <span  style="font-size:13px; font-style:italic; font-weight: normal;" > <span class="b_tooltip" data-toggle="tooltip" data-placement="right" title="{{ $birthdate_raw }}">{{ $age }}</span> </span></strong></div>
                    <div class="name" style="font-size: 13px"> {{ $employee->company->name }}  </div>
                    <div class="name" style="font-size: 13px"> <u>{{ ($employee->department_name != "") ? $employee->department_name : "<i>Not Assigned</i>" }}</u>  {{ ($employee->position_name != "") ? '/ <u>' . $employee->position_name  . '</u>': "" }}</div>
              <hr>
                    <div class="name" style="font-size: 13px; margin-top:5px;"> ID: <u>{{ $employee->employee_work_id }}</u></div>                  
                    <div class="name" style="font-size: 13px; margin-top:5px;"> Date hired: {{ $date_hired }}</div>                  
                    <div class="name" style="font-size: 13px; margin-top:5px;"> Employment status: <u>{{ ucfirst(strtolower($employee->employment_status))}}</u></div>
                    <div class="name" style="font-size: 13px; margin-top:5px;"> Membership status: <u>{{ ucfirst(strtolower($employee->membership_status))}}</u></div>

            </div>

            <div class="list-buttons" style="width: 30%;float:left;">
              
              @if ($accessControl->hasAccess($uri, 'delete', $GLOBALS['_byPassRole']))
              <button data-employee_id="{{ $employee->employee_work_id}}" type="button" class="close pull-right deleteButton"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              @endif
 
              @if ($accessControl->hasAccess($uri, 'edit', $GLOBALS['_byPassRole']))
              <a href="{{ route('employees.edit', $employee->employee_work_id) }}" class="btn btn-default" style="margin: 30px 50px;">Edit Profile Information</a>
              @endif

              @if($took_pe)
              <div class="name label label-info" style="font-size: 12px; margin-top:5px; margin-left: 50px;"> <span class="glyphicon glyphicon-check"></span> took P.E this year</div>
              @endif
            </div>

        </td>
      </tr>
      @endforeach
    </tbody>
</table>


@if (count($employees) == 0)

  <div  align="center" class="alert alert-warning"> No Employees found.</div>

@endif
  
  <?php 

      echo $employees->appends(['src' => Input::get('src'), 'filterby' => Input::get('filterby')] )->links(); 
    
  ?>

  <div> <strong>Total records found</strong>: <span class="item-count">{{ $employees->getTotal() }}</span></div>

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

      if (! confirm('Are you sure to delete this item?') ) return false;
      // Prevent from going back to top when clicking the button
      e.preventDefault();

      var deleteButton = $(this);

      // Get the data attribute with a key "employee_id"
      var id = deleteButton.data('employee_id');


      // Contact server to delete the employee
      $.ajax({
        type: 'DELETE',
        url: '{{ action('EmployeesController@index') }}' + '/'+ id,
        data: { employee_work_id: id },
        success: function(data) {
        
          if (data == "1") {
            deleteButton.closest('tr').fadeOut(255);
            var item_count = parseInt($('.item-count').html()) - 1;
            $('.item-count').html(item_count);

          }
        }
      });
      
    });

    $('.employee-item-checkbox').on('click', function() {
      console.log($(this).data('employee_id'));
    });

    // $('.tablesorter').dataTable();
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