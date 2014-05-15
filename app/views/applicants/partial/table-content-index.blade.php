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
       