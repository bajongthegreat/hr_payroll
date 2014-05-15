// Create & Edit
 var departmentsURL = _globalObj._baseURL + "/departments/departmentsByCompany";
 var positionsURL = _globalObj._baseURL + "/positions/positionsByDepartment";

 if (typeof _applicants_oldStageProcess  != "undefined") {
    hrApp.getSelectOptions(_globalObj._baseURL + '/stageprocesses', 0, 'stage_process', _applicants_oldStageProcess);
    // Interview Requirements
    hrApp.getCheckBox(_globalObj._baseURL + '/requirements', 1, '_applicants_InterviewRequirementsContainer', 'requirement_id[]', _applicants_oldRequirements, 'requirement');
    // Orientation Requirements
    hrApp.getCheckBox(_globalObj._baseURL + '/requirements', 2, '_applicants_OrientationRequirementsContainer', 'requirement_id[]', _applicants_oldRequirements, 'requirement');
     
      
 }


$('#_applicants_department_row, #_applicants_position_row').hide();

                          

$('#_applicants_submit').on('click', function(e) {
            	
	var submit = $(this), 
        clear = $('#_applicants_clear'),
        submitLoad = $('#_applicants_submitload');

    var url = _globalObj._baseURL + "/img/loading.gif";

    submit.fadeOut(200);
    clear.fadeOut(200);

    submitLoad.html('Sending.. &nbsp; &nbsp;' + '<img src="' + url +'" class="loading">' );
   		
    // Disable for 10 seconds
    setTimeout(function() {
    	submit.fadeIn(200);
    	clear.fadeIn(200);

    	submitLoad.html('');

    }, 5000);

});

           
$('#_applicants_company_id').change(function() {


  var company_id = $(this).find(":selected").val(),
      position_id = $('#_applicants_position_id'),
      employment_status = $('#_applicants_employment_status'),
      department_row = $('#_applicants_department_row'),
      department_id  = $('#_applicants_department_id');

  emptyOptions();

  if (company_id == 0) {
  	console.log('Please select a company');

  	// Enable selection of position
  	position_id.prop('disabled',true);
  	employment_status.prop('disabled',true);
                	  	
  	// Hide department row
  	// department_row.hide();
                	  	
     } 

     else {

    // Show department row
    department_row.show();
                	  	
    hrApp.getSelectOptions(departmentsURL, company_id, '_applicants_department_id', _applicants_oldDepartment);

     if (_applicants_oldDepartment > 0) {
     	department_id.trigger('change');
     }
                	  
    // Enable selection of position
    position_id.prop('disabled',false);
    employment_status.prop('disabled',false);
					

        }
    });

                
    $('#_applicants_department_id').change(function(e, old) {
		var department_id = $(this).find(":selected").val();
		 		
		 $('#_applicants_position_row').show();
         hrApp.getSelectOptions(positionsURL, department_id, '_applicants_position_id', _applicants_oldPosition);
	});

	function emptyOptions() {
		$('#_applicants_department_id, #_applicants_position_id').empty();
		$('#_applicants_department_row, #_applicants_position_row').hide(); 
        }
    
    $('#_applicants_company_id').triggerHandler('change');
   


// Exists on: Applicants.show
    $('._applicant_show_requirement').on('click', function() {
         var requirement_id = $(this).closest('li').data('requirement_id'),
            applicant_id = $(this).closest('li').data('applicant_id'),
            ptype = $(this).closest('li').data('type'),
            _document    = $(this).closest('li').data('document');

         // Manipuldate Modal Content
         $('#modal_body_content').html(ptype);
         $('#myModalLabel').html('Employee Requirement');
         $('#itemtype').html( _document );
            $('#myModal').modal('show');

        // When clicking "Accept", perform an AJAX request
        $('#modal_save').on('click', function (e) {
          // do something...

              var defaultClass = '<span class="label label-success"><span class="glyphicon glyphicon-ok"></span></span>',
                   unavailableClass  ='<a href="#" class="_applicant_show_requirement"><span class="label label-danger"><span class="glyphicon glyphicon-remove"></span></span></a>';

            $.ajax({
                type: 'POST',
                url: _globalObj._baseURL + '/applicants/requirements',
                data: { process_type: ptype, employee_id: applicant_id, requirement_id: requirement_id, _token:_globalObj._token },
                success: function(data) {
                    jsonData = JSON.parse(data);
                    
                    if (jsonData.status == 'created') {
                        location.reload();
                    }
                    
                }
            });
        })

        
    });