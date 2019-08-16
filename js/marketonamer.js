/* Author:

*/
$(function() {
	$('#submit-program').click(function() {
		var dateconvention = $('#dateconvention').val();
		var programid = $('#programid').val();
		var workspace = $('#workspace').val();
		var subunit = $('#subunit').val().replace(/-/g,'');
		var programtype = $('#programtype').val().toUpperCase();
		var description = $('#description').val().replace(/-/g,' ');
		var display = workspace + "-" + dateconvention + "-" + subunit + "-" + programtype + "-" + programid + "-" + description;
		$('.link-url').html("<p>" + display + "</p>");
	});
})(jQuery)