// (function ($) {

// 	$.fn.jTable = function ( options ) {

// 		// Table defaults
// 		var defaults = {
// 			url: "#",
// 			type: 'GET',
// 			data: {},
// 			allowedFields: [],
// 			outputContainer: '#tbody'
// 		};

// 		var settings = $.extend( {}, defaults, options );



// 		console.log('jTable initalized');


// 		$.ajax({
// 			type: settings.type,
// 			url: settings.url,
// 			data: settings.data,
// 			success: function(obj) {
// 				console.log('success!' + obj.data);

// 				var output = "";

// 				// Loop through each value inside the specified object
// 				$.each(obj, function(key, value) {


// 					// If the value is also an object, loop through that object again
// 					// to get the data we need
// 					// Since laravel pagination generates another object
// 					$.each(value, function(insideK, insideV) {

// 							console.log(insideV);
						
					
// 					});

// 				});

// 				$(settings.outputContainer).html(output);
// 			}

// 		});



		
// 	};

// })(jQuery);



(function( $ ) {




	// Hide the Search result div
	$('#main_search_result').hide();

	// Trigger AJAX request while triggering any keyboard key
	$('#header_search').keyup(function (e) {

		var searchKey = $(this).val();
		
		// Triggered Enter
		if (e.which == 13) {}
	
	// Show and Hide Results DIV	
	if (searchKey.length > 0) {
		$('#main_search_result').fadeIn('fast');
	} else {
		$('#main_search_result').fadeOut('fast');
	}

	console.log(employeeLink);
	

	$.ajax({
		type: 'GET',
		url: employeeLink,
		data: { searchTerm: searchKey, output: 'json'},
		beforeSend: function() {
			$('#main_search_result').html('Searching for ' + searchKey + '..');
		},
		success: function (data) {


			if (data.length > 0) {

				// Search Item container
				var display = '';

				for (var i = data.length - 1; i >= 0; i--) {
					display += ' <div class="searchResultItem"><a href="' + employeeLink  +  data[i]['employee_work_id'] +'">' + data[i]['employee_work_id'] + ' - ' +  data[i]['lastname'] +  '</a></div>';
				};

				setTimeout( function() {
					$('#main_search_result').html(display);
				}, 250);
				
			} else {
				$('#main_search_result').html('No employees found.');
			}

	
		} // End of Success Request

	}); // End of AJAX request

	
	
	
		// console.log('searching.. ' + searchKey.length  + e.which );

	}); // --> End of Key-up event


	  // For clickable <tr> table rows
	  $(".clickableRow").click(function() {
	  	console.log('wa');
            window.document.location = $(this).attr("href");
      });


})(jQuery);