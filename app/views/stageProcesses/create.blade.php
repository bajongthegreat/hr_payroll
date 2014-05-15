@extends('layout.master')

@section('content')

<div class="content-center">
<h3 class="page-header">
Create Stage Process
</h3>

	{{ Form::open(array('action' => 'StageProcessesController@store', 'class' => 'form-horizontal', 'role'=> 'form')) }}

	<div class="form-group">
		{{ Form::label('stage_process', 'Stage Process', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-5">
		{{ Form::text('stage_process', Input::old('stage_process'), array('class' => 'form-control')) }}
		 </div>
	</div>

	<div class="form-group">
		{{ Form::label('parent_id', 'Parent', array('class'=>"col-sm-2 control-label") ) }}
		 <div class="col-sm-5">
		{{ Form::select('parent_id',$stage_processes, Input::old('parent_id'), array('class' => 'form-control')) }}
		 </div>
	</div>



	<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-default">Reset</button>
    </div>
  </div>
  
@include('partials.errors')

</form>

</div> <!-- Content Center End -->
@stop


