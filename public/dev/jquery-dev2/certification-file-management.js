/** For Certification File Managment
*/
(function() {

	console.log('Sub-script loaded.');
			
		$(document).on('click', '#system_default',function() {

			$('#name').prop('disabled', this.checked);

			$('#date_hired').prop('disabled', this.checked );

			$('#department_id').prop('disabled', this.checked);

			$('#position_id').prop("disabled", this.checked);
		});
		

})();