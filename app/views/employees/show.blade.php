@extends('layout.master')

@section('content')
<style>

	

	.portrait-holder {
		
		position:relative;
		margin-top: 40px;

		min-height: 200px;
		min-width: 300px;

	}

	.member-info-holder
	{
		position: relative;
		margin-top: 40px;
		min-height: 200px;
		min-width: 250px;
		
		
	}

	.page-header {
		margin-top: 12px;
		padding-bottom: 2px;
	}

	img {
			 display: block;
	    margin-left: auto;
	    margin-right: auto;
	}

	.box
	{
		margin-top: 15px;
		margin-left:45px;
		background-color:#fff;
		border-width: 1px;
		border-color: #ddd;
		border-radius: 4px 4px 0 0;
		box-shadow: none;
		width: 75%;
	}

	.box ul {
		margin: auto 0;
		padding-left: 0;
	}
	.box ul li {
		margin-left: 0;
		list-style: none;
		text-align: center;

		background-color: #fafafa; 
		margin-top: 10px;
		border-color: #e5e5e5 #eee #eee;
		border-style: solid;
		border-width: 1px 0;
	}

	.editor {
		background: blue;
	}

	.panel-heading {
		color: #003366 !important;
	}

	

</style>




<div class="container-fluid">


	<div class="portrait-holder col-md-4">
		
		<div class="row text-center">
			
				<img src="https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcRp-MLoHVHXxaOFY6k-ZTqEkQr4Di_p-gfbWI9Mhq--x16i18tYPA" alt="..." class="img-thumbnail">
			
		</div>

		<div class="row box">


				<div class="menu">
				<div class="profile-label"> <b>ID: </b> <?php echo (!is_null($employee->employee_work_id)) ? $employee->employee_work_id : 'Not specified'; ?></div>
				<div class="profile-label"> <b>Company: </b> <?php echo (!is_null($company)) ? $company : 'Not specified'; ?></div>
				<div class="list-group">
				  <a href="#" class="list-group-item active">
				   <span class="glyphicon glyphicon-user"></span>&nbsp;  Profile
				  </a>
				  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;   Attendance</a>
				  <a href="#" class="list-group-item"><span class="glyphicon glyphicon glyphicon-briefcase"></span>&nbsp;   Benefits</a>
				  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-star"></span>&nbsp;   Promotions</a>
				  <a href="#" class="list-group-item"><span class="glyphicon glyphicon glyphicon-home"></span>&nbsp;   Leaves</a>
				  <a href="#" class="list-group-item"><span class="glyphicon glyphicon-th-list"></span>&nbsp;   Loans</a>
				</div>
			</div>

		</div>

			<div class="pull-left">
 <a  href="{{ action('EmployeesController@index') }}" class="btn btn-default " style="margin-top: 15px"><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>

			</div>
				

			<div class="text-center">
 		<!-- To align buttons -->
			</div>
		
 
	</div>

	<div class="separator"></div>

	<div class="member-info-holder col-md-8", #holder>

		<div class="panel panel-warning">
		  <div class="panel-heading">
		    <h3 class="panel-title">Requirements Overview</h3>
		  </div>
		  <div class="panel-body">
		   
		  	<strong>Interview</strong>
		    <ul class="list-group" style="list-style: none;">
			  <li><span class="glyphicon glyphicon-ok"></span> Application Letter (Handwritten)</li>
			  <li><span class="glyphicon glyphicon-ok"></span> Biodata with ID picture</li>
			  <li><span class="glyphicon glyphicon-remove"></span> SSS E1/E4/E6</li>
			  <li><span class="glyphicon glyphicon-ok"></span> Birth Certificate (Photocopy)</li>
			  <li><span class="glyphicon glyphicon-remove"></span> Employment Certificate (Photocopy)</li>
			</ul>

			<strong>Orientation</strong>
			 <ul class="list-group" style="list-style: none;">
			  <li><span class="glyphicon glyphicon-ok"></span> Police Clearance</li>
			  <li><span class="glyphicon glyphicon-ok"></span> Barangay Clearance</li>
			  <li><span class="glyphicon glyphicon-remove"></span> Cedula</li>
			  <li><span class="glyphicon glyphicon-remove"></span> Medical Certificate</li>
			  <li><span class="glyphicon glyphicon-ok"></span> Health Card</li>
			 </ul>



		  </div>
		</div>


		@include('employees.partial.profile')

	

				

			

		</div>  <!-- End of Personal Information -->








@stop

@section('scripts')
@stop