<div class="row">
			
			<div class="form-group">
						
				{{ Form::label('document', 'Document', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::text('document', Input::old('document'), array('class' => 'form-control', 'id' => 'document') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('document_type', 'Document Type', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::select('document_type', $document_types ,Input::old('document_type'), array('class' => 'form-control', 'id' => 'document') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('stage_process_id', 'Stage Process', array('class' => 'col-sm-2')) }}

				<div class="col-sm-6">
					{{ Form::select('stage_process_id', $stage_processes ,Input::old('stage_process'), array('class' => 'form-control', 'id' => 'document') ) }}
				</div>
				
			</div>

		

		

			<div class="form-group">
						
				{{ Form::label('submit', ' ', array('class' => 'col-sm-2')) }}

				<div class="col-sm-4">
					
	     <div>{{ Form::submit('Submit', array('class' => 'btn btn-primary', 'id'=>'submit')) }}</div>
			</div>
	      </div>
				
		

	</div>