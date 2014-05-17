@extends('layout.master')


@section('content')

<div class="content-center">

<div class="page-header">
<h1>Edit Holiday  <a  href="{{ action('DepartmentsController@index') }}" class="btn btn-default "><span class="glyphicon glyphicon-chevron-left"></span >  Go Back</a>
</h1>
</div>


	
<div class="container">

	{{ Form::model($holiday, ['action' => ['HolidaysController@update', $holiday->id], 'method' => 'PATCH', 'class' => 'form-horizontal', 'role' => 'form']) }}
			@include('holidays.partial.form')
	{{ Form::close() }}

	@include('partials.errors')




</div> <!-- Content Center End -->
@stop

@section('scripts')
<script>

            	$('#holiday_date').datetimepicker({
                    pickTime: false
                });

</script>
@stop