
			$('.resultContainer').hide();

			// Check if employee hash is present
           	// Then perform an ajax search
            if (hrApp.hasHash()) {
            	__employee = hrApp.getHash('employee');

            	// ajaxSearchEmployee(hrApp.getHash('employee'), '#leave_information, #employee_information, #buttons', 'employee_loader');
            	_searchEmployee(__employee);

				$('#employee_work_id').val(hrApp.getHash('employee'));
            }


            _togglePanels(__panelsToToggle, 'hide');

            // Will search for employee profile
            function _searchEmployee(searchValue, element) {
            	console.log('searching...');

            	$.ajax({
            		type: 'GET',
            		url: _globalObj._baseURL + "/employees",
            		data: { src: searchValue, output: 'json' },
            		beforeSend: function() {
            			$('#employee_loader').html('<img src="' + _globalObj.loaderImage +'" class=\"loading\" >');
            		},
            		success: function(data) {

            			// Hide loader
            			$('#employee_loader').html('');
                              $('.employee_loader').html('');

            			var name;
            			var id;
            			var searchItem = "";


                                    console.log('Length of data found:' + data.length);

            			// More than 1 result
            			if (data.length > 1) {
            				
            				if (data.length < __rowsToDisplay) {
            					__rowsToDisplay = data.length;
            					// console.log(__rowsToDisplay);
            				}

            				for (var i=0; i< __rowsToDisplay; i++) {
            					name = hrApp.personName(data[i]);
            					id = data[i].employee_work_id;

            					searchItem += '<div class="resultItem" data-employee_name="' + name +'" data-employee_id="' + id +'"><a href="?reload=true&employee_id=' + id +'#employee=' + id +'"> <span class="label label-default">'+ id +'</span>  '+  name +'  </div></a>';
            				}

                                    if (element) {
                                          $('.resultContainer').remove();
                                          element.after('<div class="resultContainer" style="width: 330px;">' +searchItem +'</div>');
                                    } else {
                                          resultContainer.html(searchItem);
                                          resultContainer.show();
                                          _togglePanels(__panelsToToggle, 'hide');
      
                                    }

            				
            			} else if (data.length == 1) {

                                     
            				resultContainer.fadeOut(250);
            				realID = data[0].id;			
            				id = data[0].employee_work_id;

            				name = hrApp.personName(data[0]);
            				date_hired = data[0].date_hired;

                                    if (data.hasOwnProperty('position') ) {
                                          position = data[0].position.name;
      
                                    } else {
                                          position = 'Unassigned';
                                    }
            				
                                    if (element) {
                                     $('.resultContainer').remove();
                                     $('.resultName').remove();
                                          element.val(id);
                                          element.after('<span class="resultName">' + name +'</span>');
                                    } else {
                                          // Redirect to save data even from unexpected page refresh
                                                window.location = '#employee=' + id;
                                          

                                                $('#employee_name').html(name);
                                                $('#date_hired').html(date_hired);
                                                $('#position').html(position);
                                                
                                                // Set ID
                                                hiddenID.val(realID);
                                                
                                                // Toggle Panels
                                                _togglePanels(__panelsToToggle, 'show');
                                                // console.log();      
                                    }
            				
            			} else {


                                    if (element) {
                                     $('.resultContainer').html('<span class="text-center">No data found</span>');
                                   
                                    } else {
                                          resultContainer.hide();
                                          
                                    }

            				$('#employee_loader').html('<span class="label label-danger">No data found</span>');
            			}

            		}

            	});
            }

            // Show/hide panels
            function _togglePanels(panels, type) {
            	$.each(panels, function(key, value) {
            		if (type == 'hide') {
            			console.log(value);
            			$(value).hide();
            		} else {
            			$(value).show();
            		}
            	})
            }

            // Empties the content of field
            function _emptyFields() {

            }

            // Add a hidden element to save the searched employee ID


            $('#employee_work_id').keyup(function(e) {
            		e.preventDefault();

           			var searchVal = $(this).val();

           			// Enter key
           			if (e.which == 13) {
           				_searchEmployee(searchVal);
           			}
            });








		//  Display description on select
		(function(){

			$('#violation_decription_container').hide();
			$('#violation_id').on('change', function() {
				var selectValue = $(this).val();
				
				console.log(selectValue);
				if ( selectValue == 0  || selectValue == -1) {
					return false;
				} else {
					$.ajax({
						type: 'GET',
						url: _globalObj._baseURL + '/violations',
						data: { src: selectValue, output: 'json', field: 'id'},
						success: function(data) {
							console.log(data);
							if (data) {
								$('.violation_decription').html(data.description);
								$('.penalty').html(data.penalty);
								$('#violation_decription_container').show();
							} else {
								$('.violation_decription').hide();
								$('#violation_decription_container').hide();
							}
								
						}
					});
				}
			});			
		})();