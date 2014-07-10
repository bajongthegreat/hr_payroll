
<?php 
$punishment_type = NULL;
$days_suspended = NULL;
$days_suspended_disabled = 'disabled';
if (isset($offenses[$i-1])) {
	$punishment_type = $offenses[$i-1]->punishment_type;

	if ($punishment_type == 'suspended') $days_suspended_disabled = '';

	$days_suspended = $offenses[$i-1]->days_of_suspension;
}
	
?>

				<div class="panel panel-default offense_panel" >

					<div class="panel-heading">
						<div class="panel-title"> {{ $i }} Offense {{ ($i > 1) ? '<button type="button" class="close" aria-hidden="true">&times;</button>' : '';}}</div>
					</div>

					<div class="panel-body">
						

						<div class="form-group">

							<input type="hidden" value="{{ $i }}" name="offense_number" class="_ofn">

							
							{{ Form::label('first_offense', 'Punishment type', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::select('punishment_type', ['Please select an item', 'warning' => 'Warning', 'suspended' => 'Suspended', 'demotion' => 'Demotion', 'discharged' => 'Discharge' ], $punishment_type, ['class' => 'form-control _punishment_type']) }}
							</div>

						</div>


						<div class="form-group">
							{{ Form::label('first_offense', 'Days suspended', array('class' => 'col-sm-2 text-right')) }}

							<div class="col-sm-4">
								{{ Form::text('days_suspended', $days_suspended , ['class' => 'form-control days_suspended', $days_suspended_disabled , 'id' => 'days_suspended']) }}
							</div>

						</div>

						
					</div>

				</div>
