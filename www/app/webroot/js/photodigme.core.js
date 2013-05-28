function addError(text){
	$('#error-panel').html(
		'<div class="alert alert-error">'+
			'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			'<h4>Error!</h4>'+text+
		 '</div>'
	);
}