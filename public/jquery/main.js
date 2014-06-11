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
