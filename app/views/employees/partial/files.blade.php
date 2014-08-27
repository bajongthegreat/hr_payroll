<div class="panel panel-default ">
		  <div class="panel-heading">
		    <h3 class="panel-title"><h4><a data-toggle="collapse" data-parent="#accordion" href="#parentsinfo">
          Downloadable Files
        </a></h4></h3>
		  </div>

		  <div style="margin: 15px;"> Here are the list of document templates pre-filled with data. Customization is also applicable.

		  	<div class="list" style="margin-top: 15px;">			

		  		<div class="list-group">
				  <a href="{{ action('EmployeesFileController@employment_certification_show') }}" class="list-group-item ajax-modal" data-title="Employment Certificate" data-employee_id="{{ $employee->employee_work_id }}">
				    <h4 class="list-group-item-heading">Employment Certificate</h4>
				    <p class="list-group-item-text">Generates a Word document for Employment Certificate.</p>
				  </a>
				  <a href="#" class="list-group-item">
				    <h4 class="list-group-item-heading">Retirement Certificate</h4>
				    <p class="list-group-item-text">Generates a Word document for Retirement Certificate.</p>
				  </a>	
				</div>
			</div>
		  </div>
				


		  </div>  <!-- End of Body -->
		</div> <!-- End of Panel -->
