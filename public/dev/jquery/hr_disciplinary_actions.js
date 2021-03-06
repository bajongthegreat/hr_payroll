function ordinal_suffix_of(i) {
    var j = i % 10,
        k = i % 100;

    if (j == 1 && k != 11) {
        return i + "st";
    }
    if (j == 2 && k != 12) {
        return i + "nd";
    }
    if (j == 3 && k != 13) {
        return i + "rd";
    }
    return i + "th";
}

			$('.resultContainer').hide();

			// Check if employee hash is present
           	// Then perform an ajax search
            if (hrApp.hasHash()) {
            	__employee = hrApp.getHash('employee');

            	// ajaxSearchEmployee(hrApp.getHash('employee'), '#leave_information, #employee_information, #buttons', 'employee_loader');
            	

				      $('#employee_work_id').val(hrApp.getHash('employee'));

              _searchEmployee(__employee);
            }


            _togglePanels(__panelsToToggle, 'hide');

            // Will search for employee profile
            function _searchEmployee(searchValue, element, department_id) {
            	console.log('searching...');

               if (department_id == undefined) {
                  department_id = 0;
               }

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
                  var _class = "";
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

                      if (i == 0) {
                        _class = "active";
                      } else _class = "";

            					searchItem += '<div class="resultItem ' + _class +'" data-index="' + i +'"  data-employee_name="' + name +'" data-employee_id="' + id +'"><a href="?reload=true&employee_id=' + id +'#employee=' + id +'"> <span class="id-container">'+ id +'</span>  '+  name +'  </div></a>';
            				}

                                    if (element) {
                                          $('.resultContainer').remove();
                                          element.after('<div class="resultContainer" style="width: 330px;">' +searchItem +'</div>');
                                              _togglePanels(__panelsToToggle, 'hide');
      
                                    } else {
                                          resultContainer.html(searchItem);
                                          resultContainer.show();
                                          _togglePanels(__panelsToToggle, 'hide');
      
                                    }

            				
            			} 
                  else if (data.length == 1) {
    // resultContainer.fadeOut(250);
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
                                     // $('.resultContainer').remove();
                                     // $('.resultName').remove();
                                     //   element.val(id);
                                     //      // element.next().remove();

                                     //      // Remove Input group addons
                                     //      element.parent().find('.input-group-addon').remove();
                                     //      console.log(element.parent().find('.input-group-addon'));

                                     //      element.after('<span class="input-group-addon"><span class="label label-info">' + name +'</span></span>');
                                          

                                    } else {
                                            // Redirect to save data even from unexpected page refresh
                                                window.location = '#employee=' + id;
                                          

                                                $('#employee_name').html(name);
                                                $('#date_hired').html(date_hired);
                                                $('#position').html(position);
                                                $('.sss_id').html(data[0].sss_id);
                                                
                                                // Set ID
                                                hiddenID.val(realID);
                                                $('#work_id').val(id);   
                                                   console.log(realID);

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
                     _togglePanels(__panelsToToggle, 'hide');
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

                  console.log('hello');
           			}
            });


                $(document).on('click', '.resultItem a', function(e) {
                if (redirect === false) {


                var id = $(this).parent().data('employee_id'),
                  name = $(this).parent().data('employee_name'),
                    input = $(this).parent().parent().siblings('input.searcheable');
                $('.resultName').remove();            
                      
                input.val(id);
                      input.next().remove();
                                               input.parent().find('.input-group-addon').remove();
                           
                      input.after('<span class="input-group-addon"><span class="label label-info">' + name +'</span></span>');

                $('.resultContainer').remove();
                e.preventDefault();
                }
              });

            

      $(document).on('keyup', '.searcheable', function(e){
      
      if ($(this).val().length > 1) {
      
        // Down
        if (e.which == 40) {
        
          var resultItem = $('.resultContainer .resultItem'); 
          var resultItemActive = $('.resultContainer .resultItem .active');
          // Check if first is selected

            if (resultItem.hasClass('active')) {
              var index = $('.resultItem.active').data('index');
              
                resultItem.eq(index).removeClass('active');
                resultItem.eq(index+1).addClass('active');
              console.log(index);
            }             
          
          
      

        } else if (e.which == 38) {

          var resultItem = $('.resultContainer .resultItem'); 
          var resultItemActive = $('.resultContainer .resultItem .active');
          // Check if first is selected

            if (resultItem.hasClass('active')) {
              var index = $('.resultItem.active').data('index');
              
                resultItem.eq(index).removeClass('active');
                resultItem.eq(index-1).addClass('active');
              console.log(index);
            }             
          

        } else if (e.which == 13) {
          // For enter

          var resultItem = $('.resultContainer .resultItem'); 
          
          resultItem.each(function() {
            if ($(this).hasClass('active')) {
              var id = $(this).data('employee_id');
        
              var id = $(this).data('employee_id'),
                name = $(this).data('employee_name'),
                  input = $(this).parent().siblings('input.searcheable');
              $('.resultName').remove();            
                    
              input.val(id);
                    input.next().remove();
                                             input.parent().find('.input-group-addon').remove();
                         
                    input.after('<span class="input-group-addon"><span class="label label-info">' + name +'</span></span>');

              $('.resultContainer').remove();

            }
          });

          e.preventDefault();
          return false;

        } else {
          _searchEmployee($(this).val(), $(this));
        }
              
      } else {
        $('.resultContainer').remove(); 
      }






      console.log(e.which)
    });









		//  Display description on select
		(function(){

                   $("#violation_date").on("dp.change",function (e) {
                     $('#violation_effectivity_date').data("DateTimePicker").setMinDate(e.date);
                  });
                  $("#violation_effectivity_date").on("dp.change",function (e) {
                     $('#violation_date').data("DateTimePicker").setMaxDate(e.date);
                  });

         
                            var toggleForm = function(filter, is_next_a_warning, is_last) {
                                 if ( filter === true) {
                                    console.log(is_next_a_warning === true);
                                    
                                 if (is_last === true) {
                                    toggleLast(true);
                                 } else {
                                    toggleLast(false);
                                 }

                                    if (is_next_a_warning === true) {
                             
                                       $('#violation_effectivity_date').prop('disabled',true);
                                    } else {

                                        $('#violation_effectivity_date').prop('disabled',false);

                                    }

                                 
                                 
                                 }
                            };

                            var toggleLast = function(is_last) {
                               if (is_last === true) {
                                       $('#violation_effectivity_date').prop('disabled',true);
                                       $('#violation_date').prop('disabled', true);
                                       $('#buttons').hide();
                                    } else {
                                       $('#violation_effectivity_date').prop('disabled',false);
                                       $('#violation_date').prop('disabled', false);
                                       $('#buttons').show();
                                    }
                            }
			$('#violation_decription_container').hide();
			$('#violation_id').on('change', function() {
				var selectValue = $(this).val();
				
            var employee_id = $('.hiddenID').val();

				console.log(selectValue);
				if ( selectValue == 0  || selectValue == -1) {
					return false;
				} else {
					$.ajax({
						type: 'GET',
						url: _globalObj._baseURL + '/violations',
						data: { src: selectValue, output: 'json', field: 'id', employee_id: employee_id},
						success: function(data) {
							console.log(data);
							var formfilter = true;
                     var is_suspended = false;

                     if (data) {
								var decoded = $('.violation_decription').html(data.description).text();
                        $('.violation_decription').html('<br><br>' + decoded);
                        var penalty = "<ul>";
                            penalty += '<br>';
                        


                        for(var i=0; i < data.offenses.length; i++) {
                           penalty += '<li>';
                        
                           if (data.times_committed-1 == i) {
                              penalty += '<span class="label label-danger">';
                           }
                              if (!data.offenses[i]['days_of_suspension']) {
                                    penalty +=  ordinal_suffix_of(data.offenses[i]['offense_number']) + ' offense (' + data.offenses[i]['punishment_type'] +')';  
                                 is_suspended = false;
                                
                              } else {

                                 penalty +=   ordinal_suffix_of(data.offenses[i]['offense_number']) + ' offense (' + data.offenses[i]['punishment_type'] +' for ' + data.offenses[i]['days_of_suspension'] +' days)';
                                is_suspended = true; 
                              }

                            
                            if (data.times_committed-1 == i) {
                              
                              penalty += '</span>';
                           }  
                           
                              
                           penalty += '</li>';
                        }

                        penalty += '</ul>';

                        // Create is_create variable if it is not defined
                        if (typeof is_create === undefined) {
                           var is_create = true;
                        }


                        // Check if the selected value matches what is saved on the database
                        // Only on edit

                        // if (is_create === false ){
                        //    var original_violation_id = $('.old_violation_id').val();
                        //    var current_violation_id = $('#violation_id').val();

                        //    if (original_violation_id == current_violation_id) {
                        //       toggleForm(true, false, false);
                        //    } else {
                        //       toggleForm(true, false, data.is_last);
                        //    } 
                        // }  else toggleForm(true, data.is_next_a_warning, data.is_last);

                        if (is_create === true) {
                          toggleForm(true, data.is_next_a_warning, data.is_last);
                        } else {
                           var original_violation_id = $('.old_violation_id').val();
                           var current_violation_id = $('#violation_id').val();
                             // alert(original_violation_id + ' ' + current_violation_id);
                            if (original_violation_id == current_violation_id) {
                              toggleForm(true, data.is_current_a_warning, false);

                           } else {
                              toggleForm(true, data.is_current_a_warning, data.is_last);
                            }
                        }
                        
                        
                        console.log(data);
                         
                           // ===============================================
   								$('.penalty').html(penalty);
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

      (function(){

               if ($('#violation_id').val() != 0 ) {
                  setTimeout(function(){
                     $('#violation_id').trigger('change');
                  }, 1500);
               }


               // Loan

                $('#duration_in_months, #loan_amount').on('keyup', function() {
                              var duration = parseInt($('#duration_in_months').val() );
                              var loan_amount = parseFloat($('#loan_amount').val());

                              // var monthly_amortization = Math.round( (loan_amount/duration) * 100)/100;
                              var monthly_amortization = Math.round( ((loan_amount/duration )  * 1.10 ) * 100)/100;

                               if (isNaN(monthly_amortization)) {
                                monthly_amortization = 0;
                               }

                              $('#monthly_amortization').val( monthly_amortization); 
                           });
            })();