/**
 * jmFileUpload.js
 * Version: 1
 * URL: http://github.com/bajongthegreat
 * Description: This lets javascript upload files with progressbar.
 * Requires: jQuery, xhr2
 * Author: James Mones
 * Copyright: Copyright 2014 James Mones
 */


;(function($, document, window, undefined) {
    // Optional, but considered best practice by some
    "use strict";

  

    $.fn.jmFileUpload = function(options) {

        // Default options for the plugin as a simple object
        var defaults = {
            allowedTypes: ['image/jpeg','image/png'],
            progressbarContainer: '.progress',
            progressbar: '.progress-bar',
            xhrReponseContainer: '.result',
            type: 'POST',
            url: '?a=upload',
            customData: {},
            infoContainer: '.upload-info',
            errorContainer: '.upload-error',
            responseContainer: '.upload-done',
            imageContainer: '.image',

        };

        // Get current element
        var element = this;

        // Merge the options given by the user with the defaults
        options = $.extend({}, defaults, options);

        $(options.progressbarContainer).hide();


        // Validates the file filetype
        function validate(fileType) {
            
            var doesExist = false;

            if ( in_array(fileType, options.allowedTypes) === true) {
                doesExist = true;
            }

            return doesExist;
        }

        function sendData(data) {

            // Show progressbar
            $(options.progressbarContainer).show();

            $(options.infoContainer).append('<div> <strong>[3]</strong> Uploading file... </div>');

             var xhr = new XMLHttpRequest();
                
            xhr.open(options.type, options.url);
            
            // Success
            xhr.onload = function () {

            if (xhr.status === 200) {
                console.log('all done: ' + xhr.status);
            } else {
                    console.log('Something went terribly wrong...');
             }

            };

            xhr.upload.onprogress = function (event) {

                
                // Checks if the file's length is computable
                 if (event.lengthComputable) {
                    var complete = (event.loaded / event.total * 100 | 0);

                    // Show the current progress on the specified progress bar element
                    $(options.progressbar).css('width', complete+'%').html(complete + "%");

                    if (complete == 100) {
                        setTimeout(function() {
                            $(options.progressbarContainer).hide();
                        }, 2000);
                         
                    }
                }
            };

            xhr.onload = function () {
             var result = xhr.response;

             if (!result) {
                $(options.errorContainer).html('Failed to process uploaded file.');
             }

             $(options.infoContainer).append('<div> <strong>[4]</strong> Fetched uploaded file data. </div>');

             // Parse as JSON result
             result = JSON.parse(result);

             $(options.responseContainer).val(result.file_path).change();

             $(options.imageContainer).attr("src", result.file_loc );

             };

             xhr.send(data);

        }


         // When the file element selects a file, trigger a change event
         this.on('change', function(e) {
            // Get the file type of the selected file
            var fileType = e.target.files[0].type;

            // Get the files attribute of the selected file
            var file = $(this).prop('files')[0];

            var formData = new FormData();

            $(options.infoContainer).html('<div><strong>[1]</strong> Validating file...</div>');
            // Terminate event if doesnt match the required file types
            if (validate(fileType) === false) {
                console.log(fileType);
                $(options.errorContainer).html('File does not pass from the required file types.');

                $(options.infoContainer).append('<br><span class="glyphicon glyphicon-remove"></span> File does not pass from the required file types.');
                return false;
            } else {
                // Reset progress bar values
                 $(options.progressbar).css('width', 0+'%').html(0 + "%");


                $(options.infoContainer).append('<strong>[2]</strong> Assigning variables...');
                // Append file to Formdata
                formData.append('file',file);
                
                // Add custom parameters to formData
                $.each(options.customData, function(key,value) {
                    formData.append(key, value);
                });



                // Make an AJAX request with the formData
                sendData(formData);    
            }

            

         });

        return this;

    };

    // Private function that is only called by the plugin
    // Emulate PHP in_array function in Javascript
            var in_array = function(type, allowedTypes) {
                var found = false;

                for (var i = allowedTypes.length - 1; i >= 0; i--) {
                    if (allowedTypes[i] == type) {
                        found = true;
                    }
                };

                return found;
            }


})(jQuery, document, window);