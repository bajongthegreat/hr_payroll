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
                 $('#' + element).html(options).trigger('change');
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

$(document).ready(function() {
  


   $('#_applicants_date_hired, #_applicants_birthdate, #birthdate, #date_conducted, .text-date').datetimepicker({
                    pickTime: false
    });

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


function changeShift(shift, tableID, show_full_dtr) {
  console.log(show_full_dtr);
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
        $('#def_timeout_am').trigger('change');
        $('#def_timein_pm').trigger('change');

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