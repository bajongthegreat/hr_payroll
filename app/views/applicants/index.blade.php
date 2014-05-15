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
              
              <li> 
                   <div class="filter-collection well">
          
                    <div class="filter-title" style="font-size: 16px; font-weight: bold;"> Filter by:</div>
                    <div class="filter-content"> 

                        @include('employees.partial.filterby')
                       
                    </div> <!-- Filter content -->
                    
                  </div>
            </li>
              <li> 
                <div style="margin-left: 15px; margin-top: 50px;"> <span > Show only:</span>
                  <div class=""><input type="checkbox" class="_filterby" data-status="all"> Show All</div>
                <div class=""><input type="checkbox" class="_filterby" data-status="shortlisted"> Shortlisted</div>
                <div class=""><input type="checkbox" class="_filterby" data-status="pending"> Pending</div>
              
          </div>

  </div>


  <!-- Modal -->
  @include('applicants.partial.with_selected_modal')
  <div class="table-container col-sm-11" style="">


  <h2 class="page-header"> Applicant list</h1>

  <div class="table-header">


    <div class="pull-right col-md-8">
         
      <div class="row">


      <div class="col-md-6">
        
      </div><!-- /.col-lg-6 -->


      <div class="col-md-6">
        <div class="input-group">
          <div class="input-group-btn">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="fg_current"> In all fields </span> <span class="caret"></span></button>
            <ul class="dropdown-menu searchfields">
              <li data-field="name"><a href="#">Name</a></li>
              <li data-field="department"><a href="#">Department</a></li>
              <li><a href="#"></a></li>
              <li class="divider"></li>
              <li><a href="#">Separated link</a></li>
            </ul>
          </div><!-- /btn-group -->
          <input type="text" class="form-control" placeholder="Enter keywords.">
        </div><!-- /input-group -->
      </div><!-- /.col-lg-6 -->


    </div><!-- /.row -->

     
    </div>  <!-- /pull-right col-md-8 -->

    <div class="header-buttons pull-left">
      <a href="{{ action('ApplicantsController@create')}}" class="btn btn-success"><span class="glyphicon glyphicon-new-window"></span> Add Applicant</a>
     <a  href="{{ action('ApplicantsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-refresh"></span >  Refresh</a>
    </div>

  </div>

  <table class="table table-hover" ng-controller="EmployeeController" id="applicantTable">
  	<thead>
      <th></th>
  		<th >ID </th>
  		<th > Name </th>
  		<th>Applied for this Position</th>
      <th>Date of Application</th>
  		<th>Status</th>
  	</thead>

  

  	<tbody id="applicantTableBody" >

     
        
            <?php foreach ($applicants as $applicant): ?>

             <tr data-applicant_id="{{$applicant->id}}">
                <td>{{ Form::checkbox('applicant_row', $applicant->id) }}</td>
                <td class="clickableRow" href="{{ route('applicants.index') }}/{{ $applicant->id }}"> {{$applicant->id }} </td>
                <td class="clickableRow" href="{{ route('applicants.index') }}/{{ $applicant->id }}"> <?php echo   ucfirst($applicant->lastname) . ', ' . $applicant->firstname . '</td>'; ?>
                <td> <?php echo  $applicant->position['name'] . '</td>'; ?>
                  <td> <?php echo ucfirst( $applicant->application_date) . '</td>'; ?>
                   <td class="employment_status" data-employment_status="{{$applicant->employment_status}}"> <?php echo ucfirst( $applicant->employment_status) . '</td>'; ?>
                <td> <a class="btn btn-small btn-default editButton" href="{{ action('ApplicantsController@edit', $applicant->id ) }}"> <span class="glyphicon glyphicon-edit"></span> Edit</a> <a class="btn btn-small btn-default deleteButton" href="#" data-employee_id="{{ $applicant->employee_work_id}}"> <span class="glyphicon glyphicon-remove"></span> Delete</a> </td>

               </tr>
            <?php endforeach; ?>
       

      
        
         

     
  	</tbody>
  </table>

  <div class="modalResult"></div>


@if (count($applicants) == 0)

  <div  align="center" class="alert alert-warning"> No Applicants found.</div>

@endif


  <?php 

  if (Input::get('search') == '') {
      echo $applicants->links(); 
    } else {
      echo $applicants->appends(['searchTerm' => Input::get('searchTerm'), 'status' => Input::get('status') ] )->links(); 
    }

  ?>

  <div id="auxControls">
      <div class="container" width="70%"> 
        <span class="col-xs-2"><label>With Selected</label></span> 

        <div class="col-xs-4"> 
          <select class="form-control" name="with_selected" id="withSelected">
              <option value="0">Please select action</option>
              <option value="1">Shortlist</option>
              <option value="2">Hire</option>
          </select>
        </div>

      </div>
  </div>

  </div>

</div>




@stop


@section('scripts')

<script>

(function() {

 
    $('._filterby').on('change', function(e) {
      var status = $(this).data('status');

      console.log(status)
      if (status == 'all') {
         window.document.location = _globalObj._baseURL + "/applicants";
         return false;
      }

        window.document.location = _globalObj._baseURL + "/applicants?status=" + status ;
    });


    $('.searchfields li').on('click', function(e) {
      e.preventDefault();
      var field = $(this).data('field');
      $('.fg_current').html( hrApp.ucfirst(field) );
      
    });
    // Function: When this class is appended into an element, it will grab the href attribute
    //           and redirect to that link.
    $(".clickableRow").click(function() {
            window.document.location = $(this).attr("href");
      });

    // Exists on: applicants/index
    // Function: Perform some actions on the selected checkboxes
    $('#withSelected').on('change', function() {

        var queuedApplicants = [],
            self = $(this),
            action = $('#withSelected option:selected').text(),
            actionIndex = $(this).val(),
            employment_status = "";

        // Do nothing if selected the first index
        if (actionIndex == 0) return false;
        console.log(action);

        // Grab all "checked" checkbox.
        $('#applicantTableBody tr input:checkbox:checked ').each(function() {

                queuedApplicants.push( $(this).val() );

            
        });

        // Terminate if none are checked
        if (queuedApplicants.length == 0 && queuedApplicants[0] == undefined) return false;

      // Modal processing

         // Title of Modal
         $('.modal-title').html('You are about to <span class="label label-info">' + action + '</span> this listed applicant(s):');

         // Get applicant info from selected applicants
         $.ajax({
              type: 'GET',
              data: { id : JSON.stringify(queuedApplicants) },
              url: _globalObj._baseURL + '/applicants/jsonApplicantInfo',
              success: function(data) {

                var  name = position = "", applicant_list = "<ol>";

                $.each(data, function(key, value) {
                  name = hrApp.ucfirst(value.lastname) + ", " + value.firstname;

                  if (action == 'Hire') {
                    position= ' as ' +'<span class="label label-default">'  + value.position.name + "</span>";
                  }

                  

                  applicant_list += "<li>" + name + position + "</li>";
                });

                applicant_list += "</ol>";

                $('.modal-body').html(applicant_list);
              }
         });
        
        if (action == 'Hire') {
          $('#date_hired_container').removeClass('hidden');
        } else {
           $('#date_hired_container').addClass('hidden');
        }
         
         // Show a modal dialog to confirm action
         $('.modal').modal('show');

          $('.save').on('click', function(e) {
            e.preventDefault();

            if (action == 'Shortlist') {
                processApplicant('PATCH', 'applicants/jsonApplicant', { id: JSON.stringify(queuedApplicants), status: 'shortlisted' }, '.modalResult',true);
            }
            else if (action == 'Hire') {
              date_hired = $('#date_hired').val();
              processApplicant('PATCH', 'applicants/jsonApplicant', { id: JSON.stringify(queuedApplicants), status: 'hire', date_hired: date_hired }, '.modalResult',true);
            }


          });


    });

    function processApplicant(type, URL_segement, dataObj, outputDIV, refresh) {
      $.ajax({
        type: type,
        dataType: 'json',
        data: dataObj,
        url: _globalObj._baseURL + "/" + URL_segement,
        success: function(data) {
          $(outputDIV).html(data);

          if (refresh === true) {
            location.reload();
          }
        }
      });
    }





    // Exists on: applicants/index
    // Function: Peform an AJAX request to data to db from the selected row
    $('.deleteButton').on('click', function(e) {

      // Prevent from going back to top when clicking the button
      e.preventDefault();

      var deleteButton = $(this);

      // Get the data attribute with a key "employee_id"
      var id = deleteButton.data('employee_id');


      // Contact server to delete the applicant
      $.ajax({
        type: 'DELETE',
        url: '{{ action('ApplicantsController@destroy') }}',
        data: { id: id },
        success: function(data) {
        
          if (data == "1") {
            deleteButton.closest('tr').fadeOut(255)
          }
        }
      });
      
    });


})();

   $('#date_hired').datetimepicker({
                    pickTime: false
                });




</script>

@stop