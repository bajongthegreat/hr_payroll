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
			
				<div>


				<img src="{{ isset($applicant->image) ? asset($applicant->image): 'http://s3.amazonaws.com/37assets/svn/765-default-avatar.png' }}"  
				width="234" height="234" alt="..." class="img-thumbnail" style="height: 234px; width: 274px;"
				id="picture_holder">

				<!-- <canvas id="canvas" width="274" class="img-thumbnail" height="234" class="hidden"> -->


				</div>
				<span ><a href="#"><span id="label-photo" class="label label-info">Click to change</span></a></span>
				<div style="margin-left: 50px; margin-top: 10px">
					{{ Form::open(['action' => 'EmployeesPhotoController@upload', 'enctype' => 'multipart/formdata']) }}
					<input type="file" name="profilepic" id="profile_pic_input" multiple="multiple" class="hidden">
					{{ Form::close() }}
			</div>
			
		</div>

		<div class="row box">
				<!-- Progress bar for Image upload -->
					<div class="progress ">
					  <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
					    0
					  </div>
					</div>

				</div>

				<div class="menu">
					<div class="profile-label"> <b>Name: </b> {{ ucfirst($applicant->lastname) . ', '  .  ucfirst($applicant->firstname) . ' ' . ucfirst($applicant->middlename[0]) . '.' }}</div>
				<div class="profile-label"> <b>ID: </b> <?php echo (!is_null($applicant->employee_work_id)) ? $applicant->employee_work_id : 'Not specified'; ?></div>
				<div class="profile-label"> <b>For company: </b> <?php echo (!is_null($company)) ? $company : 'Not specified'; ?></div>
				<div class="list-group">
				  <a href="#" class="list-group-item active">
				   <span class="glyphicon glyphicon-user"></span>&nbsp;  Profile
				  </a>
				</div>
			</div>

			<div class="pull-left">
 <a  href="{{ action('ApplicantsController@index') }}" class="btn btn-default " style="margin-top: 15px"><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>

			</div>

		</div>

			
				

			<div class="text-center">
 		<!-- To align buttons -->
			</div>
		
 
	</div>

	<div class="separator"></div>

	@include('partials.modal')

	<div class="member-info-holder col-md-8", #holder>

		@include('partials.requirements')


		@include('applicants.partial.profile')

	

				

			

		</div>  <!-- End of Personal Information -->








@stop

@section('scripts')
<script>

$('#label-photo').on('click', function() {
	$('#profile_pic_input').trigger('click');
})

$('#profile_pic_input').jmFileUpload({
	url: _globalObj._baseURL + '/employees/photo',
	customData: { _token:  _globalObj._token, id: "{{$applicant->id}}" },
	imageContainer: '#picture_holder'
});
	
</script>
@stop