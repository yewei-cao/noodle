/**
 * 
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

	$(document).on("click", ".add-to-order" , function() {
		var code = $(this).attr("item-code");

		$.StandardPost('/home/menu/addtoorder',{id:code});
		
	});

	$(document).on("click", ".remove-to-order" , function() {
		var code = $(this).attr("item-code");
		$.StandardPost('/home/menu/removetoorder',{id:code});
// 		$.ajax({
// 			  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
// 		      url: '/home/menu/removetoorder',
// 		      type: 'POST',
// 		      data: {'id':code},
// 		      success: function(result) {
// 				  add_basket(result);
//             },
//             error: function(result) {
//                 alert("Data not found");
//             }
// 		      });
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

	add_basket=function(result){
		 var html= "";
		 var totalqty=0;

		 if(Object.keys(result).length == 1){
			 $(".empty-order").show();
		 }
		 else{
			 $(".empty-order").hide();
			  for(var i in result){
				  if(i != "total"&& i != 'deliveryfee'){
				  totalqty+=result[i]['qty'];
				  html += '<div class=\"basket-product product\"> '
		                
		                +' <div class=\"row\">'
		                +'    <div class=\"col-9\">'
		                +'      <span class=\"description\">'
		                + result[i]['qty'] +' x '+ result[i]['name']
		                +'          </span>'
		                +'      </div>'
		                +'       <div class="col-3"><span class="price at-product-price">$'+ result[i]['price'] +'</span></div>'
		                +' </div>'
		                +'   <div class="row actions">'
		                +'       <button class="btn add-product add-to-order" item-code="'+ result[i]['id'] +'">Add one</button>'
		                +'           <button class="btn remove-product remove-to-order" item-code="'+ result[i]['__raw_id'] +'">Remove</button>'
		                +'  </div> '
		                +' </div>';
			  }
			  }
		 }
		 if(result['deliveryfee'] == 0){
			 $(".deliveryfee-container").hide();
		 }else{
			 $(".deliveryfee-container").show();
		}
		 var total = result['total'] +result['deliveryfee'];
		  $('.total-amount').text('$'+total);
		  $('.number-of-items').text(totalqty);
		  $(".basket_order").html(html);
	}

}(jQuery));

//# sourceMappingURL=mymenu.js.map
