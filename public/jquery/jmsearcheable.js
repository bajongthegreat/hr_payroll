
//! jmsearcheable.js
//! version : 1
//! author : James Norman Mones Jr.

// TODO: Count result data to determine if there's a result or not
//       If there's no result, put some text to remind the viewer that the plugin didn't acquire any data from the server

(function( $ ) {

	// Debugging
	// console.log('Plugin loaded');


	// Must be a JSON object
	// Format: [ [ 'key' => 'value' ] , [ 'key' => 'value']    ]


	$.fn.jmSearcheable = function(options) {

		var self = $(this);
		var result;

		// Debugging
		// console.log('Plugin initialized.');

		settings = $.extend({
		  url: '#',
          urlWithID: false,
          idSeparator: '?',
          idField: 'id',
          delay: 50,
          format: '',
          containerWrapper: '#searchResultContainer',
          fadeIn: 'fast',
          fadeOut: 'fast',
          keyEvent: 'keyup',
          fields: [''],
          fieldTag: 'div'
		}, options);

		$(settings.containerWrapper).hide();

		
		beginSearch = function () {

			// console.log(settings.fields);

			// console.log('beginSearch function called');
			$.ajax({
				url: settings.url,
				type: 'GET',
				data: { src: self.val(), output: 'json' },
				beforeSend: function () {

					// Show/Hide result container
					toggleContainer();

					$(settings.containerWrapper).html('Searching..');
				},
				success: function (data)
				{
					setTimeout(function() {

						displayContent(data);

					}, settings.delay);

					
					
				}
			});
		};

		// Toggles a specified container wrapper based on the length of entered value in this form
		toggleContainer = function () {


			if (self.val().length > 0) {
				$(settings.containerWrapper).fadeIn(settings.fadeIn);
			} else {
				$(settings.containerWrapper).fadeOut(settings.fadeOut);
			}

			return true;
		};

		// Displays the content into the containerWrapper
		displayContent = function(data) {
			var finalText= "";
			if (typeof data === 'object') {

						// Display data to container
						$.each(data, function(key, value) {
							
							// Check if value is an object or not
							if (typeof value === 'object') {

								if (settings.format.length > 0 ) {

									// Format output text
									finalText += doFormat(value);
									
								}
								
							} else {
								console.log('Not an object');
								console.log(value);

								// Not formatted yet
								finalText += value;
							}
							
						});

						// Display the processed content 
						$(settings.containerWrapper).html(finalText);

					} else {

						// Output the html directly if not a JSON object
						$(settings.containerWrapper).html(data);
					}
		}

		// Formats the string based on the specified format
		doFormat = function (data) {

			var toType = function(obj) {
				  return ({}).toString.call(obj).match(/\s([a-zA-Z]+)/)[1].toLowerCase()
				}


			var output = "",
				openTag= "<" + settings.fieldTag + " class=\"searchItem\">",
				closeTag= "<" + settings.fieldTag + "/>";

		

				var format = settings.format,
				    colonCount = format.split(':').length-1;



				// Replace all occurences of :
				for (var i = colonCount; i >= 0; i--) {
					format = format.replace(':', ' ');
				};

				// Replace all specified keys in the format strings with the actual values
				var reg = new RegExp(Object.keys(data).join("|"),"gi");
				 
				 format = format.replace(reg, function(matched){
				  return data[matched];

				});


				
				 

				 // Check if the output would include an id
				 if (settings.urlWithID === true) {

	

				 	// Construct a link
				 	var open_link = '<a href="' + settings.url + getURI(data)  +'">',
				 	    close_link = '</a>';

				 		// The final product with a field tag and an anchor tag
				 		// <tag><a>Label</a></tag>
				 	 output +=openTag + open_link +  format  + close_link + closeTag;


				 	
				 } else {

				 	// No anchor tag
				 	 output += openTag + format + closeTag;
				 }
				

			
				
			

			return output;
			
		}
		
		getURI = function(data) {

			var extended_uri;


			if (data[settings.idField] === undefined) {
				console.log('The data doesn\'t exists. ');
			}


			if (settings.idSeparator == '?' || settings.idSeparator == '&') {
				 extended_uri = settings.idSeparator + settings.idField + "=" + data[settings.idField];
			} 

			if (settings.idSeparator == '/') {
				 extended_uri = settings.idSeparator + data[settings.idField];
			}
			
			return extended_uri;

		}

		// ----------------> This is where everything is triggered <------------------------

		// Whenever field has value, trigger the specified keyEvent in settings
		self.on(settings.keyEvent, function(e) {
			
			
			// Begin search
			beginSearch(); 
		});






	};



})(jQuery);