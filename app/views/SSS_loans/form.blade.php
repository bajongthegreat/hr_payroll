			<div class="form-group">
						
				{{ Form::label('sss_id', 'SSS ID: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-3">
					<p class="sss_id label-value"></p>
					<input type="hidden" class="sss_id" name="sss_id" value="{{ Input::old('sss_id') }}">
				</div>
				
			</div>

			<hr>

			<div class="form-group">
						
				{{ Form::label('date_issued', 'Date Issued: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					<div class='input-group date' id='date_hired' data-date-format="YYYY-MM-DD">

					{{ Form::text('date_issued', Input::old('date_issued'), array('class' => 'form-control', 'data-date-format' => "YYYY-MM-DD") ) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
        
                	</div>
				</div>
				
			</div>

			<hr>

			<div class="form-group">
						
				{{ Form::label('check_date', 'Check Date: ', array('class' => 'col-sm-2 text-right')) }}


					<div class="col-sm-2">
					<div class='input-group date' id='date_hired' data-date-format="YYYY-MM-DD">

					{{ Form::text('check_date', Input::old('check_date'), array('class' => 'form-control', 'data-date-format' => "YYYY-MM-DD") ) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
        
                	</div>
				</div>
			
				
			</div>

			<div class="form-group">
						
				{{ Form::label('check_number', 'Check Number: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::text('check_number', Input::old('check_number'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<div class="form-group">
						
				{{ Form::label('check_amount', 'Check Amount: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::text('check_amount', Input::old('check_amount'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

			<hr>
				<div class="form-group">
						
				{{ Form::label('loan_amount', 'Loan Amount: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::text('loan_amount', Input::old('loan_amount'), array('class' => 'form-control') ) }}
				</div>
				
			</div>


				<div class="form-group">
						
				{{ Form::label('duration_in_months', 'Duration in Months: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::input('number','duration_in_months', Input::old('duration_in_months'), array('class' => 'form-control') ) }}
				</div>
				
			</div>

				<div class="form-group">

						
				{{ Form::label('salary_deduction_date', 'Start of Salary Deduction: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
				<div class='input-group date' id='date_hired' data-date-format="YYYY-MM-DD">
	
					{{ Form::text('salary_deduction_date', Input::old('salary_deduction_date'), array('class' => 'form-control', 'data-date-format' => "YYYY-MM-DD") ) }}
					<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
        
                	</div>

				</div>
				
			</div>

			<hr>

				<div class="form-group">
						
				{{ Form::label('monthly_amortization', 'Monthly Amortization: ', array('class' => 'col-sm-2 text-right')) }}

				<div class="col-sm-2">
					{{ Form::text('monthly_amortization', Input::old('monthly_amortization'), array('class' => 'form-control') ) }}
				</div>
				
			</div>
