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
            errorContainer: '.upload-error',
            reponseContainer: '.upload-done',
            imageContainer: '.image'

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

             // Parse as JSON result
             result = JSON.parse(result);

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

            // Terminate event if doesnt match the required file types
            if (validate(fileType) === false) {
                $(options.upload-error).html('File does not pass to the required file type.');
                return false;
            }

            // Reset progress bar values
             $(options.progressbar).css('width', 0+'%').html(0 + "%");

            // Append file to Formdata
            formData.append('file',file);
            
            // Add custom parameters to formData
            $.each(options.customData, function(key,value) {
                formData.append(key, value);
            });


            // Make an AJAX request with the formData
            sendData(formData);

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