/* jQuery Tiny Pub/Sub - v0.7 - 10/27/2011
 * http://benalman.com/
 * Copyright (c) 2011 "Cowboy" Ben Alman; Licensed MIT, GPL */

(function($) {

  var o = $({});

  $.subscribe = function() {
    o.on.apply(o, arguments);
  };

  $.unsubscribe = function() {
    o.off.apply(o, arguments);
  };

  $.publish = function() {
    o.trigger.apply(o, arguments);
  };

}(jQuery));
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
})();


(function(){
	$.subscribe('form.submitted',function(){
		$('.flash').fadeIn(500).delay(1000).fadeOut(500);
	});
})();
//# sourceMappingURL=app.js.map