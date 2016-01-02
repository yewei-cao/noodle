(function(){
	
	var submitAjaxRequest = function(e){
		var form= $(this);
		var method = form.find('input[name="_method"]').val() || 'POST';
		
		$.ajax({
			type: method,
			url: form.prop('action'),
			data: form.serialize(),
			success: function(){
				$.publish('form.submitted',form);
			}
		});
		
		e.preventDefault();
	};
	
	
	//Forms marked with the "data-remote" attribute will submit, via AJAX.
	
	$('form[data-remote]').on('submit',submitAjaxRequest);
	
	//The "data-click-submits-from" attribute immediately submits the form on change.
//	$('*[data-click-submits-form]').on('change',function(){
//		$(this).closest('form').submit();
//	});
//	
	
	/*
    Generic are you sure dialog
    */
//   $('form[name=delete_item]').submit(function(){
//       return confirm("Are you sure you want to delete this item?");
//   });
	
	
})();



