/**
 * mymenu js
 */
(function($) {
	
	$.extend({
	    StandardPost:function(url,args){
	        var form = $("<form method='post'><input type='hidden' name='_token' value='"+$('meta[name="_token"]').attr('content')+"'></form>"),
	            input;
	        form.attr({"action":url});
	        $.each(args,function(key,value){
	            input = $("<input type='hidden'>");
	            input.attr({"name":key});
	            input.val(value);
	            form.append(input);
	        });
	        form.submit();
	    }
	});

	
	$(window).setBreakpoints({
		distinct:!0,breakpoints:[0,414,768,992,1200,1480]
	});

	$(window).on({"enterBreakpoint768 enterBreakpoint992 enterBreakpoint1200 enterBreakpoint1480":function(){
		$("#basket-panel").stick_in_parent({
			parent:".main-container",offset_top: 10,recalc_every:50
		});
	},"enterBreakpoint0 enterBreakpoint414":function(){
		$("#basket-panel").trigger("sticky_kit:detach")
		}
	});


	$('#open-basket, .mobile-close-button, .basket-shadow').on('click',function(e){
		$( "#open-basket, .basket" ).toggleClass( "open");
// 		$( ".basket" ).toggleClass( "open");
		$( ".container" ).toggleClass( "basket-open");
	});
	
	$(document).on("click", "#apply_voucher" , function() {
		
		$("#apply_voucher").addClass('hide');
		$("#loading-indicator").removeClass('loaded');
		var code = $("#voucher_code").val();
//		$.post('/home/menu/removetoorder',{id:code});
 		$.ajax({
 			headers: {  'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
 		      url: '/home/menu/voucherapply',
 		      type: 'POST',
 		      data: {'code':code},
 		      success: function(result) {
 		    	$("#apply_voucher").removeClass('hide');
 				$("#loading-indicator").addClass('loaded');
// 				alert(result);
 				if(!result.type){
 					swal({   title: result.title,   
 						text: result.message,
 						type: "error",
 						confirmButtonText: 'Close'
 						});
 				}else{
 					swal({
						title: result.title,
						text: result.message,
						type: "success",
						showCancelButton: true,
						closeOnConfirm: false,
						showLoaderOnConfirm: true,
 						},
 						function(){
 							
 							$.ajax({
 								  headers: {  'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
 								  url: '/home/menu/usevoucher',
 							      type: 'POST',
 							      data: {'code':code},
 							      success: function(respon) {
 							    	 if(!respon.type){
 					 					swal({   title: respon.title,   
 					 						text: respon.message,
 					 						type: "error",
 					 						confirmButtonText: 'Close'
 					 						});
 							    	 }else{
 							    		 //run css somethings here
 							    		$(".voucher").addClass('hide');
 							    		$(".voucheritem").removeClass('hide');
 							    		basket(respon.data);
 							    	 }
 					            },
 					            error: function(respon) {
 					                alert("Data not found");
 					            }
 							 });
 							
 						  setTimeout(function(){
 							  
 							 swal({   title: "Success",   
 		 						text: "Voucher worth $"+ result.price +" is used" ,
 		 						type: "success",
 		 						confirmButtonText: 'Okay',
 		 						});
 						  }, 0);
 					});
 					
 				}
 				
 				
             },
             error: function(result) {
                 alert("Data not found");
             }
 		      });
	});
	
	$(document).on("click", ".remove_voucher" , function() {
		$.ajax({
			  headers: {  'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
		      url: '/home/menu/removevoucher',
		      type: 'POST',
		      data: {'code':'remove'},
		      success: function(result) {
	    	  $(".voucher").removeClass('hide');
	    	  $(".voucheritem").addClass('hide');
	    	  basket(result);
		    	  swal({   title: "Success",   
						text: "Voucher voucher remove success" ,
						type: "success",
						confirmButtonText: 'Okay',
						});
          },
          error: function(result) {
              alert("Voucher remove fail");
          }
		 });
	});
	
	$(document).on("click", ".add-to-basket" , function() {
		var code = $(this).attr("item-code");
		$.ajax({
			  headers: {  'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
		      url: '/home/menu/addtoorder',
		      type: 'POST',
		      data: {'id':code},
		      success: function(result) {
		    	  basket(result);
            },
            error: function(result) {
                alert("Data not found");
            }
		 });
		
	});

	$(document).on("click", ".remove-to-basket" , function() {
		var code = $(this).attr("item-code");
//		$.post('/home/menu/removetoorder',{id:code});
 		$.ajax({
 			headers: {  'X-CSRF-Token': $('meta[name="_token"]').attr('content')},
 		      url: '/home/menu/removetoorder',
 		      type: 'POST',
 		      data: {'id':code},
 		      success: function(result) {
 		    	 basket(result);
             },
             error: function(result) {
                 alert("Data not found");
             }
 		      });
	});
	
	$(document).on("click", ".material_rm" , function() {
		var code = $(this).attr("item-code");
		var takeout = $("*[name='takeout']").val();
		if($(this).hasClass('choicebtn')){
			takeout = takeout +code+ ',';
			$("*[name='takeout']").val(takeout);
			$(this).removeClass('choicebtn');
			$(this).addClass('unchoicebtn');
		}else{
			takeout = takeout.replace(code+',','');
			$("*[name='takeout']").val(takeout);
			$(this).removeClass('unchoicebtn');
			$(this).addClass('choicebtn');
		}
	});

	$(document).on("click", ".material_ad" , function() {
		var code = $(this).attr("item-code");
		var extra = $("*[name='extra']").val();
		if($(this).hasClass('unchoicebtn')){
			extra = extra +code+ ',';
			$("*[name='extra']").val(extra);
			var price = parseFloat($("#dish_price").html()) + parseFloat($(this).attr("price"));
			$("#dish_price").html(price);
			$(this).removeClass('unchoicebtn');
			$(this).addClass('choicebtn');
		}else{
			extra = extra.replace(code+',','');
			$("*[name='extra']").val(extra);
			var price = parseFloat($("#dish_price").html()) - parseFloat($(this).attr("price"));
			$("#dish_price").html(price);
			$(this).removeClass('choicebtn');
			$(this).addClass('unchoicebtn');
		}
			
	});
	
	//plugin bootstrap minus and plus
	//http://jsfiddle.net/laelitenetwork/puJ6G/
	$('.btn-number').click(function(e){
	  e.preventDefault();
	  
	  fieldName = $(this).attr('data-field');
	  type      = $(this).attr('data-type');
	  var input = $("input[name='"+fieldName+"']");
	  var currentVal = parseInt(input.val());
	  if (!isNaN(currentVal)) {
	      if(type == 'minus') {
	          
	          if(currentVal > input.attr('min')) {
	              input.val(currentVal - 1).change();
	          } 
	          if(parseInt(input.val()) == input.attr('min')) {
	              $(this).attr('disabled', true);
	          }

	      } else if(type == 'plus') {

	          if(currentVal < input.attr('max')) {
	              input.val(currentVal + 1).change();
	          }
	          if(parseInt(input.val()) == input.attr('max')) {
	              $(this).attr('disabled', true);
	          }

	      }
	  } else {
	      input.val(0);
	  }
	});
	$('.input-number').focusin(function(){
	 $(this).data('oldValue', $(this).val());
	});
	$('.input-number').change(function() {
	  
	  minValue =  parseInt($(this).attr('min'));
	  maxValue =  parseInt($(this).attr('max'));
	  valueCurrent = parseInt($(this).val());
	  
	  name = $(this).attr('name');
	  if(valueCurrent >= minValue) {
	      $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
	  } else {
	      alert('Sorry, the minimum value was reached');
	      $(this).val($(this).data('oldValue'));
	  }
	  if(valueCurrent <= maxValue) {
	      $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
	  } else {
	      alert('Sorry, the maximum value was reached');
	      $(this).val($(this).data('oldValue'));
	  }
	  
	});
	$(".input-number").keydown(function (e) {
	      // Allow: backspace, delete, tab, escape, enter and .
	      if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
	           // Allow: Ctrl+A
	          (e.keyCode == 65 && e.ctrlKey === true) || 
	           // Allow: home, end, left, right
	          (e.keyCode >= 35 && e.keyCode <= 39)) {
	               // let it happen, don't do anything
	               return;
	      }
	      // Ensure that it is a number and stop the keypress
	      if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
	          e.preventDefault();
	      }
	  });

	basket=function(result){
		
		 var html= "";
		 var totalqty=0;

		 if(Object.keys(result).length == 1){
			 $(".empty-order").show();
		 }
		 else{
			 $(".empty-order").hide();
			  for(var i in result){
				  if(i != "total"&& i != 'deliveryfee'&&i != 'coupon'){
				  totalqty+=result[i]['qty'];
				  html += '<div class=\"basket-product product\"> '
		                
		                +' <div class=\"row\">'
		                +'    <div class=\"col-9\">'
		                +'      <span class=\"description\">'
		                + result[i]['qty'] +' x '+ result[i]['name']
		                +'      </span>'
		                +'    </div>'
		                +'       <div class="col-3"><span class="price at-product-price">$'+ result[i]['price'] +'</span></div>'
		                +' </div>';
		                
				 if(!$.isEmptyObject(result[i]['flavour'])){
						 html +=' <div class=\"row\">'
			                +'    <div class=\"col-9\">'
			                +'      <span class=\"description\">'
			                +'&nbsp;&nbsp;&nbsp;&nbsp;'+result[i]['flavour']
			                +'      </span>'
			                +'    </div>'
			                +' </div>';
				 }
				 
				 if(!$.isEmptyObject(result[i]['takeout'])){
					 for(var j in result[i]['takeout']){
						 
						 html +=' <div class=\"row\">'
			                +'    <div class=\"col-9\">'
			                +'      <span class=\"description\">'
			                +'&nbsp;&nbsp;&nbsp;&nbsp;no '+result[i]['takeout'][j]['name']
			                +'      </span>'
			                +'    </div>'
			                +' </div>';
					 }
				 }
				 
				 if(!$.isEmptyObject(result[i]['extra'])){
					 for(var k in result[i]['extra']){
						 
						 html +=' <div class=\"row\">'
			                +'    <div class=\"col-9\">'
			                +'      <span class=\"description\">'
			                +'&nbsp;&nbsp;&nbsp;&nbsp;extra '+result[i]['extra'][k]['name']+' $'+result[i]['extra'][k]['price']
			                +'      </span>'
			                +'    </div>'
			                +' </div>';
					 }
				 }
		                
				  html +='   <div class="row actions">'
		                +'       <button class="btn add-product add-to-basket" item-code="'+ result[i]['__raw_id'] +'">Add one</button>'
		                +'           <button class="btn remove-product remove-to-basket" item-code="'+ result[i]['__raw_id'] +'">Remove</button>'
		                +'  </div> '
		                +' </div>';
			  }
			  }
		 }
		 
		 $('.at-product-price').text('$'+ result['deliveryfee']);
//		 if(result['deliveryfee'] == 0){
//			 $(".deliveryfee-container").hide();
//		 }else{
//			 $(".deliveryfee-container").show();
//		}
		 if(result['total']<=result['coupon']['value'] || result['coupon']['value'] == null){
			 var total = result['total'] +result['deliveryfee'];
		 }else{
			 var total = result['total'] +result['deliveryfee']-result['coupon']['value'];
		 }
		 
		 $('#voucher_mycode').text(result['coupon']['code']);
		 $('#voucher_value').text('$'+result['coupon']['value']);
		 
		 $('.total-amount').text('$'+total);
		 $('.number-of-items').text(totalqty);
		 $(".basket_order").html(html);
	}
	
	// set up 3 seconds of submit disable time for ordering.
	$(document).on("click", "#submit_order" , function() {
		var submitId=document.getElementById('submit_order');
		 submitId.disabled=true;
		 $("#pay_submit").submit();
		 setTimeout("submitId.disabled=false;",3000); //Set up 3 seconds.
	});
	
	$(".addtext").click(function(){
        $('#message').append($(this).text()+', ');
    });

}(jQuery));

//# sourceMappingURL=mymenu.js.map
