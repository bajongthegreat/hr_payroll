var __accumulatedURIPermission = {};
var __deletedURI = [];


$('.form-field-error').hide();

	if (oldURIdata.length > 0) {

		var parsedJSON = JSON.parse(oldURIdata);
		__accumulatedURIPermission = parsedJSON;

		$.each(parsedJSON, function(allowedURI, allowedActions) {

			if ($.isArray(allowedActions) === false ) {
				allowedActions = allowedActions.split('|');
			}
			// Alert content
			text = '<span data-uri="' + allowedURI +'"> <strong>' + allowedURI + '</strong></span>' + '  -  ' + allowedActions.join(',');
			
			// Alert container
			var container= '<div class="alert alert-success alert-dismissable">' +  '<button type="button" class="close remove-uri" data-dismiss="alert" aria-hidden="true">&times;</button>' + text +'</div>';

			// Append the alert into div
			$('.addedURIContainer').append('<div class="col-sm-7">' + container +'</div>');
		});
		
	}

	
	

		$('._checkboxButton').on('click', function() {
				var currentValue = $(this).html();
				var chkVal = $(this).find('.chkbox').val();

				if ($(this).find('span').length >= 1) {
					$(this).children("span").remove();
				} else {
					$(this).html(currentValue + '  <span class="glyphicon glyphicon-ok"></span>');
				}
					
			})

		
		// Remove JSON object when a close button in alert is clicked
		$(document).on('click', '.remove-uri' ,function() {
			var removeURI = $(this).parent().find('span').data('uri');
			delete __accumulatedURIPermission[removeURI];

			// Push deleted data into a global array 
			__deletedURI.push(removeURI);

			// console.log(__deletedURI);

			
			$('#__deletedURI').val(JSON.stringify(__deletedURI));
			$('#formHiddenData').val(JSON.stringify(__accumulatedURIPermission));
		});

		$('#_roles_add_uri').on('click', function(e) {

			var allowedActions = [];
			var allowedURI = $('#uri').val();
			var collection = {};

			

 			$('.chkbox:checked').each(function(key,val) {
				allowedActions.push($(this).data('value'));
			});

			// Checks if URI was stated
			if ( __accumulatedURIPermission.hasOwnProperty(allowedURI) || allowedURI == '' ) {

				var message = (allowedURI == "") ? 'Please fill a valid URI' : 'URI already exists.';


				$('#uri').closest('div[class^="form-group"]').addClass('has-warning').focus();
				$('#uri').closest('div[class^="form-group"]').find('.form-field-error').html(message).fadeIn(250);
				return false;
			} 

			// Checks if permissions were selected for that URI
			 if (allowedActions.length == 0) {
				$('#uri').closest('div[class^="form-group"]').addClass('has-warning').focus();
				$('#__act_permission').closest('div[class^="form-group"]').find('.form-field-error').html('No permissions specified.').fadeIn(250);
				return false;
			} 

			// If no errors found, clean it
			$('#uri').closest('div[class^="form-group"]').removeClass('has-warning');
			$('.form-field-error').fadeOut(250);
			
			



			// Add All accumulated URI with user selected permissions
			__accumulatedURIPermission[allowedURI] = allowedActions;

			// console.log(__deletedURI);
			// console.log(__accumulatedURIPermission);
			 // Alert content
			text = '<span data-uri="' + allowedURI +'"> <strong>' + allowedURI + '</strong></span>' + '  -  ' + allowedActions.join(',');
			
			// Alert container
			var container= '<div class="alert alert-success alert-dismissable">' +  '<button type="button" class="close remove-uri" data-dismiss="alert" aria-hidden="true">&times;</button>' + text +'</div>';

			// Append the alert into div
			$('.addedURIContainer').append('<div class="col-sm-7">' + container +'</div>');


			// Put the data into a hidden field for later processing
			$('#formHiddenData').val(JSON.stringify(__accumulatedURIPermission));
		});