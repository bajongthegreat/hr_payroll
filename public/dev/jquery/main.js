var myApp = function(mainURL) {

    this.mainURL = mainURL;

    this.ucfirst = function (string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
    
    this.hasHash = function () {
        // Get the hash
        var hash = location.hash;

      // Split hash value into value pairs in a variable
        hashValue = hash.split('=', 2);

        // If it is a pair value, get ths
        if (hashValue.length == 2) { 
            return true;
        }
        return false;
    }
    this.getHash = function(hashName) {
    
      // Get the hash
        var hash = location.hash;

      // Split hash value into value pairs in a variable
        hashValue = hash.split('=', 2);

        // If it is a pair value, get ths
        if (hashValue.length == 2) {

            if ('#' + hashName == hashValue[0]) {
                return hashValue[1];
            }
            
            return false;
        }
    };

    this.personName = function (obj, type) {
        if (type == 'lastname_first') {
            return this.fullNameStartLastname(obj['firstname'], obj['lastname'], obj['middlename']);   
        } 

        return this.fullname(obj['firstname'], obj['lastname'], obj['middlename']);
           
    };

    this.fullname = function (firstname, lastname, middlename) {
        return firstname + " " + middlename + " " + lastname;
    };

    this.fullNameStartLastname = function (firstname, lastname, middlename) {
        return lastname + ", " + firstname + " " + middlename[0] + ".";
    };

    this.dateToString = function(date) {
        var month = date.getMonth(),
            year = date.getFullYear(),
            day = date.getDate();

       
    };

    this.getSelectOptions = function (URL, id, element, selectedID){
        $.ajax({
            type: 'GET',
            url: URL,
            data: { id: id, output: 'json', select: 'true' },
            success: function(data) {
               
               console.log(data);

                var options = "";

                $.each(data, function(key, value) {
                         
                         if (selectedID == key) {
                             options += '<option value="' + key + '" selected>' + value + '</option>';
                         } else {
                             options += '<option value="' + key + '">' + value + '</option>';
                         }
                        
                    
                   
                });
                        
                 $('#' + element).html(options).trigger('change');
            }
        });
    }

    this.getCheckBox = function(URL, id, element, name, selectedID, formClass) {
        $.ajax({
            type: 'GET',
            url: URL,
            data: { id: id, output: 'json', select: 'true' },
            success: function(data) {
                // console.log(data);
                var options = "";

                $.each(data, function(key, value) {



                        options += '<div class="form-group">';
                             options += '<label for="' + value +'" class="col-sm-2">' + value + '</label>';
                        
                        options += '<div class="col-sm-1">';

                        if (selectedID != null) {

                            checked = false;

                            for (var i = selectedID.length - 1; i >= 0; i--) {

                               if (selectedID[i] == key) {
                                    checked = true;
                               }
                            };

                             if (checked === true) {
                                 options += '<input type="checkbox" data-parent="'+ id +'" class="' + formClass +'" name="'+ name +'" value="' + key + '" checked>';
                             } else {
                                 options += '<input type="checkbox" data-parent="'+ id +'" class="' + formClass +'" name="'+ name +'" value="' + key + '">';
                             }


                        }
                        else {
                             options += '<input type="checkbox" data-parent="'+ id +'" class="' + formClass +'" name="'+ name +'" value="' + key + '">';
                        }
                         
                       
                        
                        options += '</div></div>';
                   
                });
                    console.log(options);
                 $('#' + element ).html(options).trigger('change');
                 $('.' + element ).html(options).trigger('change');
            }
        });
    }


};


// Custom Javascript functions

var __in_array = function(type, allowedTypes) {
                var found = false;

                for (var i = allowedTypes.length - 1; i >= 0; i--) {
                    if (allowedTypes[i] == type) {
                        found = true;
                    }
                };

                return found;
            }
/* Note: Regular expressions contain special (meta) characters, 
*  and as such it is dangerous to blindly pass an argument in the find function above without pre-processing it to escape those characters. 
*  This is covered in the Mozilla Developer Network's JavaScript Guide on Regular Expressions
*/ 
function escapeRegExp(string) {
    return string.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}

/* replaceAll function below is safer, it could be modified to the following if you also include escapeRegExp
*/ 
function replaceAll(string, find, replace) {
  return string.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}

// Native way of checking if class exists
var __hasClass = function(element, className) {

    var regex = '/' + className +'/';

    if ( element.className.match(regex) ) 
    {
       return true;
    }

    return false;
}

var __indexOf = function(needle) {
    if(typeof Array.prototype.indexOf === 'function') {
        indexOf = Array.prototype.indexOf;
    } else {
        indexOf = function(needle) {
            var i = -1, index = -1;

            for(i = 0; i < this.length; i++) {
                if(this[i] === needle) {
                    index = i;
                    break;
                }
            }

            return index;
        };
    }

    return indexOf.call(this, needle);
};

function __parseTime(s) {
    var part = s.match(/(\d+):(\d+)(?: )?(am|pm)?/i);

    if (part == null ) return false;

    var hh = parseInt(part[1], 10);
    var mm = parseInt(part[2], 10);
    var ap = part[3] ? part[3].toUpperCase() : null;
    if (ap === "AM") {
        if (hh == 12) {
            hh = 0;
        }
    }
    if (ap === "PM") {
        if (hh != 12) {
            hh += 12;
        }
    }
    return { hh: hh, mm: mm };
}

function __getHour(diff) {
  var msec = diff;
  var hh = msec / 1000 / 60 / 60;
 
  msec -= hh * 1000 * 60 * 60;
  var mm = Math.floor(msec / 1000 / 60);
 
  msec -= mm * 1000 * 60;
  var ss = Math.floor(msec / 1000);
 
  msec -= ss * 1000;

  // console.log(msec);
  // console.log(hh);

  return hh;
}

function calculateTotalHours(raw_timein_am, raw_timeout_am, raw_timein_pm, raw_timeout_pm, shift) {


      var np_10_03 = 0,
          np_03_06 = 0;
          var overtime = 0;
      // GET AM Time in & OUT
      time_in_am = __parseTime(raw_timein_am);
      time_out_am = __parseTime(raw_timeout_am);


      // GET PM Time in & OUT
      time_in_pm = __parseTime(raw_timein_pm);
      time_out_pm = __parseTime(raw_timeout_pm);

      var am_in = new Date(2000, 0, 1, time_in_am.hh , time_in_am.mm); // 9:00 AM,
      var am_out = new Date(2000, 0, 1, time_out_am.hh , time_out_am.mm);

      var pm_in = new Date(2000, 0, 1, time_in_pm.hh , time_in_pm.mm); // 9:00 AM,
      var pm_out = new Date(2000, 0, 1, time_out_pm.hh , time_out_pm.mm);

      var am_time = __getHour(am_out - am_in);
      var pm_time = __getHour(pm_out - pm_in);

      if (shift == 'ns') {
        np_10_03 =  getNightPemium_10_03(raw_timein_pm, raw_timeout_pm, raw_timein_am, raw_timeout_am);
      }

      total = pm_time + am_time;  

     if (total > 8) {
        overtime = total - 8;
     }

      return {'total': total,
                'np_10_03': np_10_03,
                'np_03_06': np_03_06,
                'overtime': overtime};  
    } 

    function arrayHasOwnIndex(array, prop) {
        return array.hasOwnProperty(prop) && /^0$|^[1-9]\d*$/.test(prop) && prop <= 4294967294; // 2^32 - 2
    }

    function getNightPemium_10_03(timein_pm, timeout_pm, time_in_am, time_out_am){

      var set_1 = 0,
          set_2 = 0,
          pm_diff_deduct = 0;

          // start at 10PM
          var t1_pm = moment('22:00', 'HH:mm');
          var t2_pm = moment(timeout_pm, 'HH:mm');

          var pm_diff =  t2_pm.diff(t1_pm);

        // End at 3 AM

        var t1_am = moment(time_in_am, 'HH:mm');
        var t2_am_def = moment('03:00', 'HH:mm');
        var t2_am = moment(time_out_am, 'HH:mm');

        if (__parseTime(time_out_am).hh < 3) {
          var am_diff = t2_am.diff(t1_am);
        } else {
          var am_diff = t2_am_def.diff(t1_am);
        }
        
      return __getHour(pm_diff) + __getHour(am_diff);

  }


function getJSONdata(obj, keyToFind) {
  
  mapped =  jQuery.map(obj, function(value, key) {
    if (key == keyToFind) return value;
  }); 

  if (mapped.length > 0) {
    return mapped[0];
  }
}


// function rowCleanup(tableID) {

// }
function addRow_pe(tableID, rowsToAdd) {

      // Work on JSON Objects
      
      var table = document.getElementById(tableID);
    
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
      var diseases_raw = [];
            var diseases = [];
            var recommendations_raw = [];
            var recommendations = [];


            //  Not yet working
      $.ajax({
            async: false,
            type: 'GET',
            url: _globalObj._baseURL + '/syncdata' + '?get=medical_findings',
            success: function(data) {
              diseases_raw = data;
              
            }
          });

      $.ajax({
            async: false,
            type: 'GET',
            url: _globalObj._baseURL + '/syncdata' + '?get=recommendations',
            success: function(data) {
              recommendations_raw = data;
              
            }
          });

      for (key in diseases_raw) {
          if (arrayHasOwnIndex(diseases_raw, key)) {
              diseases[key] = diseases_raw[key];
          }
      }

      for (key in recommendations_raw) {
          if (arrayHasOwnIndex(recommendations_raw, key)) {
              recommendations[key] = recommendations_raw[key];
          }
      }

      diseases.push('None');

            var elementName = ['employee_work_id', 'medical_findings', 'recommendation', 'remarks'];

            for (var j=0; j<= rowsToAdd-1; j++) {
              
                row = table.insertRow(j);

              for (var i = 0; i <= elementName.length-1; ++i) {
                  
                  var cell = row.insertCell(i);

                  if (elementName[i] == 'medical_findings') {
                      var element = document.createElement('select');
                  
                    for (var o = 0; o <= diseases.length - 1; o++)     {                
                        
                      if (diseases[o] != undefined) {

                        opt = document.createElement("option");
                          opt.value = o;

                        if (diseases[o] == 'None') {
                          opt.value = 'None'; 
                        }

                          opt.text=diseases[o];
                          element.appendChild(opt); 

                        if (diseases[o] == 'None') {
                          opt.selected = true;  
                        }
                      }
                        
                    }


                  } else if (elementName[i] == 'recommendation') {

                    var element = document.createElement('select');

                    for (var o = 0; o <= recommendations.length - 1; o++)     {                
                       
                      if (recommendations[o] != undefined) {
                        opt = document.createElement("option");
                          opt.value = recommendations[o];
                          opt.text=recommendations[o];
                          element.appendChild(opt); 
                      }
                        
                    }
                  } else {
                    var element = document.createElement('input');
                    element.type = "text";

                    if (elementName[i] == 'employee_work_id'){
                      element.className = element.className + 'searcheable';
                    }
                    
                  }
                  element.name = elementName[i];
                  element.dataset.name= elementName[i];
                    element.classList.add('form-control');
                    cell.appendChild(element);
                  
                 
                };
                    
             

            };

          
           // console.log(currentRowCount);
           $('.rowcount').html("" + rowCount);
    }


 function fillBlankTable(tableID, tableDataToUse, identifier, type) {

// if identifier is not assigned, use ID as default value
if(typeof(identifier)==='undefined') {
  identifier = 'id';
}


// if identifier is not assigned, use ID as default value
if(typeof(type)==='undefined') {
  type = 'pe';
}

  var __dataToUse = tableDataToUse;

    if (__dataToUse.length > 0) {

     
   
      var oldDataLength = __dataToUse.length;
      var table = document.getElementById(tableID);
      var rowCount = table.rows.length;
      var row = table.rows;


       // Add rows based on the number of data available
      if (type == 'pe') {
        addRow_pe(tableID,__dataToUse.length, []);  
      }
      
      console.log(__dataToUse);
            for(var i=0; i< oldDataLength; ++i) {

                // Only fill a table row with <td> element

                if (row[i].cells.length > 0) {

                    // Loop through each cell
                    for(var j=0; j<row[i].cells.length; j++) {
                    
                      // Set ID to row
                      row[i].dataset.id = __dataToUse[i][identifier];

                      // console.log(i)

                      // Grab input element
                      element = row[i].cells[j].getElementsByTagName('input');


                      // Check if it is a valid input element
                      if (element[0] != undefined) {
                        elementName = element[0].getAttribute('name');
                        
                        // Set element value from Database
                        // console.log(elementName);
                        element[0].value = __dataToUse[i][elementName];
                      } 

                      select  = row[i].cells[j].getElementsByTagName('select');

                      // Check if it is a valid input element
                      if (select[0] != undefined) {
                        elementName = select[0].getAttribute('name');
                        
                        // Set element value from Database

                        // console.log(typeof __dataToUse[i][elementName] === 'undefined');
                        if (typeof __dataToUse[i][elementName] === 'undefined' || (!__dataToUse[i][elementName])) {
                          continue;
                        } else {
                          select[0].value = __dataToUse[i][elementName];
                        }
                        
                      }



                    }
                }
            }


    }

}

$(document).ready(function() {
  


   $('#_applicants_date_hired, #_applicants_birthdate, #date_conducted, .text-date').datetimepicker({
                    pickTime: false
    });

   $('#birth_date').datetimepicker( {maxDate: '12/31/1998' , defaultDate: "1998-01-01", pickTime: false});


var __timeout =undefined;

$('.filter-item').on('click', function(e) {

  var category = $(this).data('category');
  var fieldvalue = $(this).data('fieldvalue');
  var parent = $(this).closest('ul');
  var selection_limit = parent.data('limit');
  
  // Prevent from redirecting multiple times
  if (typeof __timeout != undefined) {
    clearTimeout(__timeout);
  }

    // get checkbox within category, check length
    var len = parent.find(":checkbox:checked").length;

    var collection = {};

    // Loop through each list with a class of "filter-list"
    $('.filter-list').each(function(obj, key, value) {

      var inside_collection =[];

        // Find all checked checkboxes and push its value into a temporary array
       $(this).find('li :checkbox:checked').each(function(i,key,value){
            inside_collection.push ($(this).data('fieldvalue'));
       });

       if (inside_collection.length > 0) {
        collection[$(this).data('category')] = inside_collection;
       }
       
    });

    // Refresh the page with the new filterby param in the url
    __timeout = setTimeout(function() {
      window.location.href = encodeURI("?" + "filterby=" + JSON.stringify(collection));
    }, 3500)

});


// Delete collection
$(document).on('click', '._deleteItem',function(e) {

  
      // Prevent from going back to top when clicking the button
      e.preventDefault();

      var deleteButton = $(this);

      // Get the data attribute with a key "employee_id"
      var id = deleteButton.data('employee_id'),
          link = deleteButton.data('url');

      // Contact server to delete the employee
      $.ajax({
        type: 'DELETE',
        url: link,
        data: { id: id },
        success: function(data) {
        
          if (data == "1") {
            deleteButton.closest('tr').fadeOut(255)
          }
        }
      });
      
    
});



// ============= Roles ===================




});




// ============================ USED in DTR ======================
// ** Must create an instance to the page you want to use this
// ** i.e var _dtrModule = new dtrModule();

var dtrModule = function() {

  // Get table data
  this.getTableData = function(table) {
    
    var cellData = {};
    var tableData = {}; 
    var field = value = ""; 

    // Loop through each table rows
      for(var i =0; i < table.rows.length; i++) {

          cellData = {};

          cellData['id'] = table.rows[i].dataset.id;
            

          // Loop through each table cells
          for (var j=0; j < table.rows[i].cells.length; j++) {
            console.log(table.rows[i].cells[j].children[0].dataset.name);   
           
            // Check if it is a span or an input type
           
            if (table.rows[i].cells[j].children[0].tagName.toLowerCase() == 'input') {
        
              // Get the attribute
              field = table.rows[i].cells[j].children[0].dataset.name;
            
              // Get value
              value = table.rows[i].cells[j].children[0].value;
    
            } else {

              // If it is not an input, try to dig deeper to find input inside other tags
              if (table.rows[i].cells[j].children[0].children[0] != undefined) {


              // Get the attribute
              field = table.rows[i].cells[j].children[0].children[0].dataset.name;
            
              // Get value
              value = table.rows[i].cells[j].children[0].children[0].value;
              }
            }

            

            // Assign into an array for later use
            cellData[field] = value;


          }

        
        // Check if employee ID is assigned
        if (cellData['employee_work_id'] != undefined) {

          console.log(cellData['employee_work_id'])
          // Check if employee id has value
          if (cellData['employee_work_id'] != "") tableData[i] = cellData;  
        }

        
    }
    return tableData;
  }

  this.calculateTotalHours = function(raw_timein_am, raw_timeout_am, raw_timein_pm, raw_timeout_pm, shift) {


      var np_10_03 = 0,
          np_03_06 = 0;
          var overtime = 0;
      // GET AM Time in & OUT
      time_in_am = __parseTime(raw_timein_am);
      time_out_am = __parseTime(raw_timeout_am);


      // GET PM Time in & OUT
      time_in_pm = __parseTime(raw_timein_pm);
      time_out_pm = __parseTime(raw_timeout_pm);

      var am_in = new Date(2000, 0, 1, time_in_am.hh , time_in_am.mm); // 9:00 AM,
      var am_out = new Date(2000, 0, 1, time_out_am.hh , time_out_am.mm);

      var pm_in = new Date(2000, 0, 1, time_in_pm.hh , time_in_pm.mm); // 9:00 AM,
      var pm_out = new Date(2000, 0, 1, time_out_pm.hh , time_out_pm.mm);

      var am_time = __getHour(am_out - am_in);
      var pm_time = __getHour(pm_out - pm_in);

      if (shift == 'ns') {
        np_10_03 =  getNightPemium_10_03(raw_timein_pm, raw_timeout_pm, raw_timein_am, raw_timeout_am);
      }

      total = pm_time + am_time;  

     if (total > 8) {
        overtime = total - 8;
     }

      return {'total': total,
                'np_10_03': np_10_03,
                'np_03_06': np_03_06,
                'overtime': overtime};  
    }

      this.getNightPemium_10_03 = function(timein_pm, timeout_pm, time_in_am, time_out_am){

            var set_1 = 0,
                set_2 = 0,
                pm_diff_deduct = 0;

                // start at 10PM
                var t1_pm = moment('22:00', 'HH:mm');
                var t2_pm = moment(timeout_pm, 'HH:mm');

                var pm_diff =  t2_pm.diff(t1_pm);

              // End at 3 AM

              var t1_am = moment(time_in_am, 'HH:mm');
              var t2_am_def = moment('03:00', 'HH:mm');
              var t2_am = moment(time_out_am, 'HH:mm');

              if (__parseTime(time_out_am).hh < 3) {
                var am_diff = t2_am.diff(t1_am);
              } else {
                var am_diff = t2_am_def.diff(t1_am);
              }
              
            return __getHour(pm_diff) + __getHour(am_diff);

        }


  // For swapping out DTR elements
  this.changeShift = function(shift, tableID, show_full_dtr) {
          console.log(show_full_dtr);
          console.log('from Module')
              if (shift == 'ds') {
                console.log('Day shift');
                // Set default value for select       
                $('#def_timeout_am').val('11:00');        
                $('._am').text('Time out AM');

                $('#def_timein_pm').val('12:00');
                $('._pm').text('Time in PM');

                  $(tableID + ' tr').each(function() {
                    
                    var time_in_am = $(this).find('input[name="time_in_am"]');
                    var time_out_am = $(this).find('input[name="time_out_am"]');
                    var time_in_pm = $(this).find('input[name="time_in_pm"]');
                    var time_out_pm = $(this).find('input[name="time_out_pm"]');
                 
                    time_in_am_clone = time_in_am.clone(true);
                    time_out_am_clone = time_out_am.clone(true);
                    time_in_pm_clone = time_in_pm.clone(true);
                    time_out_pm_clone = time_out_pm.clone(true);

                    //  // Replace  Time IN PM with Tine IN AM
                    time_in_pm.replaceWith( time_in_am_clone );
                   
                    // // Replace  Time IN AM with Tine IN PM
                    time_in_am.replaceWith( time_in_pm_clone );

                     
                    // // Replace  Time IN AM with Tine IN PM
                    time_out_am.replaceWith( time_out_pm_clone );

                    // // Replace  Time IN PM with Tine IN AM
                    time_out_pm.replaceWith( time_out_am_clone );
                   

                });

                $('._amth').html('AM');
                $('._pmth').html('PM');
                
               
                // if (show_full_dtr == false) return false; // Still not working, fix this bug

                // Show time in AM and Time out PM
                // $('input[name="time_out_am"]').parent().parent().fadeOut();
                // $('input[name="time_in_pm"]').parent().parent().fadeOut();

                // $('input[name="time_out_pm"]').parent().parent().fadeIn();
                // $('input[name="time_in_am"]').parent().parent().fadeIn();


              } else if (shift == 'ns' ) {
                  console.log('Night shift');
                // Set default value for select
                $('#def_timeout_am').val('00:00');
                $('._am').text('Time in AM');

                // Set default value for select
                $('#def_timein_pm').val('23:00');
                $('._pm').text('Time out PM');

                //Time in (am): hide
                //time out (pm): hide

                $(tableID + ' tr').each(function() {
                    
                  var time_in_am = $(this).find('input[name="time_in_am"]');
                  var time_out_am = $(this).find('input[name="time_out_am"]');
                  var time_in_pm = $(this).find('input[name="time_in_pm"]');
                  var time_out_pm = $(this).find('input[name="time_out_pm"]');
               
                  time_in_am_clone = time_in_am.clone(true);
                  time_out_am_clone = time_out_am.clone(true);
                  time_in_pm_clone = time_in_pm.clone(true);
                  time_out_pm_clone = time_out_pm.clone(true);

                  //  // Replace  Time IN PM with Tine IN AM
                  time_in_pm.replaceWith( time_in_am_clone );
                 
                  // // Replace  Time IN AM with Tine IN PM
                  time_in_am.replaceWith( time_in_pm_clone );

                   
                  // // Replace  Time IN AM with Tine IN PM
                  time_out_am.replaceWith( time_out_pm_clone );

                  // // Replace  Time IN PM with Tine IN AM
                  time_out_pm.replaceWith( time_out_am_clone );
                 

                });

                // // Trigger select change method
                // $('#def_timeout_am').trigger('change');
                // $('#def_timein_pm').trigger('change');

                $('._amth').html('PM');
                $('._pmth').html('AM');

                // if (show_full_dtr == false) return false;
                // // Show time in PM and time out AM
                // $('input[name="time_out_am"]').parent().parent().fadeIn();
                // $('input[name="time_in_pm"]').parent().parent().fadeIn();

                // $('input[name="time_out_pm"]').parent().parent().fadeOut();
                // $('input[name="time_in_am"]').parent().parent().fadeOut();
              }
        }

  this.initializer = function(obj) {

    $('#department_id').val(obj.oldDepartment); 
    
    if (obj.oldDepartment != 0) {
      
      hrApp.getSelectOptions(_globalObj._baseURL + '/positions/positionsByDepartment', obj.oldDepartment, 'position_id', obj.oldPosition);
       
        if (obj.oldShift == 'ns') {
          _dtrModule.changeShift( obj.oldShift );
        }
        
    }

    

  }

  this.handlers = function() {

      // Toggle shift selection
      $('.shift_label').on('click', function() {
        var shift_opt = $('#shift').parent();

        if ( shift_opt.is(":visible") ) {
          shift_opt.hide();       
        } else {
          shift_opt.show();
        }
      });

      // Show positions based on the selected department
     $('#department_id').change(function(e, old) {
        var department_id = $(this).find(":selected").val();
        var oldPosition = null;

        $('#position_id').parent().parent().show();
               hrApp.getSelectOptions(_globalObj._baseURL + '/positions/positionsByDepartment', department_id, 'position_id', oldPosition);
     });

     // Change shifts
      $('#shift').on('change', function() {

        var shift = $(this).val();
        var shiftName = "";
        
        _dtrModule.changeShift(shift, '#medical_examination_information_table');
      
        if (shift == 'ds') shiftName = '<span class="label label-warning">Day shift</span>';
        else shiftName = '<span class="label label-info">Night shift</span>';
          $('.shift_label').html(shiftName);
      });

      // set default timeout
      $('#def_timeout_am').on('change', function() {
        var shift = $('#shift').val();
        
        // For dayshift
        if (shift == 'ds') {
          var timeout_am = $('input[name="time_out_am"]');
          var default_timeout_am = $(this).val();

          $.each(timeout_am, function(key,value) {
            $(this).val(default_timeout_am);
          }); 
        } else if (shift =='ns') {
        // For night shift
          var timeout_am = $('input[name="time_in_am"]');
          var default_timeout_am = $(this).val();

          $.each(timeout_am, function(key,value) {
            $(this).val(default_timeout_am);
          });
        }
        
      });

      // Set default time in
      $('#def_timein_pm').on('change', function() {
        
        var shift = $('#shift').val();

        if (shift == 'ds') {
          var timeout_am = $('input[name="time_in_pm"]');
          var default_timeout_am = $(this).val();

          $.each(timeout_am, function(key,value) {
            $(this).val(default_timeout_am);
          }); 
        } else if (shift == 'ns') {
          var timeout_pm = $('input[name="time_out_pm"]');
          var default_timeout_am = $(this).val();

          $.each(timeout_pm, function(key,value) {
            $(this).val(default_timeout_am);
          });
        }
        
      });

      // show full dtr
      $('input[name="show_full_dtr"]').on('change', function() {


          // Get all time out am
          var timeout_am = $('input[name="time_out_am"]');

          // get all time
          var timein_pm = $('input[name="time_in_pm"]');

          var timein_am = $('input[name="time_in_am"]');

          var timeout_pm  = $('input[name="time_out_pm"]');
        
        // Show all time fields
        if ($(this).prop('checked') == true) {
          
          show_full_dtr = true;

          // Show  all timeout AM
          $.each(timeout_am, function(key, value) {
            $(this).parent().parent().fadeIn();
          });

          //  Show all Time IN PM
          $.each(timein_pm, function(key, value) {

            $(this).parent().parent().fadeIn();
          }); 

          // Show all im in am
          $.each(timein_am, function(key, value) {
            $(this).parent().parent().fadeIn();
          });       

          // Show all time out pm
          $.each(timeout_pm, function(key, value) {
            $(this).parent().parent().fadeIn();
          }); 

          // Show hidden column headers
          $('#header_timeout_am').fadeIn(250);
          $('#header_timein_pm').fadeIn(250);

          // Show AM/PM labels
          $('.timelabel').fadeIn();

        } else {
          
          show_full_dtr = false;
          var shift = $('#shift').val();

          // For dayshift
          if (shift == 'ds') {

            // Hide column headers
            $('#header_timeout_am').fadeOut(250);
            $('#header_timein_pm').fadeOut(250);


            // Hide AM/PM labels
            $('.timelabel').fadeOut();

              // Get all time out AM and hide it
              $.each(timeout_am, function(key, value) {
                var _tipm = $(this);
                var _tiam_val = _tipm.parent().parent().parent().find('input[name="time_in_pm"]').val();
                var _toam_val = _tipm.parent().parent().parent().find('input[name="time_out_pm"]').val();

                console.log(_toam_val);

                if (_tiam_val == '00:00' && _toam_val == '00:00') {
                  _tipm.parent().parent().parent().find('input[name="time_out_pm"]').parent().parent().fadeOut();
                } else {
                  _tipm.parent().parent().fadeOut();  
                }

              });
              // Get all time in PM and hide it
              $.each(timein_pm, function(key, value) {
                var _tipm = $(this);
                var _tiam_val = _tipm.parent().parent().parent().find('input[name="time_in_am"]').val();
                var _toam_val = _tipm.parent().parent().parent().find('input[name="time_out_am"]').val();

                console.log(_toam_val);

                if (_tiam_val == '00:00' && _toam_val == '00:00') {
                  _tipm.parent().parent().parent().find('input[name="time_in_am"]').parent().parent().fadeOut();
                } else {
                  _tipm.parent().parent().fadeOut();  
                }
                
              });
          } else if (shift == 'ns') {

              // Hide column headers
              $('#header_timeout_am').fadeOut(250);
              $('#header_timein_pm').fadeOut(250);

              // Hide AM/PM labels
              $('.timelabel').fadeOut();

              // Hide all time out PM
              $.each(timeout_pm, function(key, value) {
                var _tipm = $(this);

                _tipm.parent().parent().fadeOut();
              });

              // Hie all time in am
              $.each(timein_am, function(key, value) {
                var _tiam = $(this);

                _tiam.parent().parent().fadeOut();
              });

          }
          
        }
      });



  }

};

// Build AJAX MODAL

$('.ajax-modal').on('click', function(e) {
     var href = $(this).attr('href');
     var title = $(this).data('title');
     var data = $(this).data();

     $('#ajax-modal-form #ajax-modal-save').data('href', href);

     // Load the contents from the server to the client
     $.ajax({
        type: 'GET',
        url: href,
        data: data,
        beforeSend: function() {
          $('#ajax-modal-form #ajax-modal-save').html('Fetching View...')
                                                .prop('disabled', true);

        },
        success: function(data) {

          $('#ajax-modal-form #ajax-modal-save').html('Accept')
                                                .prop('disabled', false);
          $('#ajax-modal-form .modal-title').html(title);
          $('#ajax-modal-form .modal-body').html(data);

        }
     });

     // Show modal
     $('#ajax-modal-form').modal('show');

     e.preventDefault();
});

$('#ajax-modal-form #ajax-modal-save').on('click', function() {

            var submit = $('#ajax-modal-form #ajax-modal-save');

                submit.html('Processing...')
                       .prop('disabled', true);

            var href = $(this).data('href');
            var inputArr = {};
            var inputs = $('#ajax-modal-form .modal-body input');
            // var url = $('#ajax-modal-url').val();


            $.each(inputs, function(i) {
                
                if ( $(this).attr('type') == 'checkbox' ) {
                   inputArr[$(this).attr('name')] =  this.checked;
                } else {
                  inputArr[$(this).attr('name')] =  $(this).val();  
                }

            });

            console.log(inputArr);

            $.ajax({
              type: 'POST',
              data: inputArr,
              url: href,
              beforeSend: function() {
              },
              success: function(data) {

                var json = JSON.parse(data);

                if (json.request_type != undefined) {
                 $('#ajax-modal-form .modal-body').html('File is downloading. If download does not start, please try again. <br><br> If file does not download at all after trying several times, please contact the web developer.'); 
                  

                  submit.html('Preparing...');
 
                  setTimeout(function(){
                    location.href = json.path;

                  submit.html('Downloading...')
                        .prop('disabled', true); 
 
                  }, 1800);
                
                

                } else {
                   $('#ajax-modal-form .modal-body').html(data); 
                }
                
              },
              error: function(err) {
                $('#ajax-modal-form .modal-body').html('Something went wrong. Please re-run this modal.');

                    submit.html('Accept')
                        .prop('disabled', true);                
              }
            });

          });

function OpenInNewTab(url) {
  var win = window.open(url, '_blank');
}
// Extension
// Disable function
jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            this.disabled = state;
        });
    }
});

;!(function ($) {
    $.fn.classes = function (callback) {
        var classes = [];
        $.each(this, function (i, v) {
            var splitClassName = v.className.split(/\s+/);
            for (var j in splitClassName) {
                var className = splitClassName[j];
                if (-1 === classes.indexOf(className)) {
                    classes.push(className);
                }
            }
        });
        if ('function' === typeof callback) {
            for (var i in classes) {
                callback(classes[i]);
            }
        }
        return classes;
    };
})(jQuery);
