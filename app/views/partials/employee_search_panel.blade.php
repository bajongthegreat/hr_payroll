<div class="panel panel-default">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Search Employee</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">



	<div class="row">

			<div class="form-group">
						
				{{ Form::label('employee_work_id', 'Employee ID: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					<?php 

					if (isset($employee_work_id)) {
						$disabled = "disabled";
						$name = "employee_work_id";
						$value = $employee_work_id;
					} else {
						$disabled = '';
						$name = "";
						$value = Input::old('employee_work_id');
					}
				
					 ?>
					{{ Form::text($name, $value, array('class' => 'form-control', 'id' => 'employee_work_id', $disabled) ) }}
					
				</div> 
				 <div id="employee_loader" class="col-md-2 text-center" style="margin-top: 5px;"></div>

			</div>



	

	</div> <!-- Container -->
</div>  <!-- Panel Body -->


	</div> <!-- End of Panel -->




	

</div>


<div class="panel panel-default" id="employee_information">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4>Employee Information</h4></h3>
		  </div>
		  <div class="panel-body">

	
<div class="container">



	<div class="row">

			<div class="form-group">
						
				{{ Form::label('name', 'Name: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-10">
					<p id="employee_name">{{ isset($employee_name) ? $employee_name : "-----------"}}</p>
				</div> 

			</div>

			<div class="form-group">
						
				{{ Form::label('date_hired', 'Date Hired: ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-8">
					<p id="date_hired">{{ isset($date_hired) ? $date_hired : "-----------"}}</p>
				</div>  

			</div>



	

	</div> <!-- Container -->
</div>  <!-- Panel Body -->


	</div> <!-- End of Panel -->




	

</div>