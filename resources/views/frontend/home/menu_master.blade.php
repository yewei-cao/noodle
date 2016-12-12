@extends('frontend.primary')

@section('css.style')
<style type="text/css">
#wrap {
margin:0;
}
</style>
@endsection

@section('jscript')
<script src="/js/breakpoints.js"></script>
<script src="/js/sticky-kit.js"></script>
@endsection

@section('content')

<div class="basket-shadow"></div>

<div class="main-container">

	<div class="row order-body">
	
		<div class="content order-layout" id="order_main">
			@yield('order-layout')
	
			@include('frontend.includes.order_details')

    	</div><!-- /.content -->
    
	</div><!-- /.row -->

</div><!-- /.main-container -->


<div class="fixed-footer hide-for-small-up">
    <div class="row">
        <div class="col-6">
            <a class="btn next" id="place_order_fixed" href="#">
                <span id="add-to-order">Place Order</span>
            </a>
        </div>
        <div class="col-6">
            <a class="btn open-basket" id="open-basket">
                <span class="number-of-items">{{ $totalnumber }}</span>
                <span class="total-text">Total</span>
                <span class="total ">${{ $totalprice }}</span>
            </a>
        </div>
    </div>
</div>


@endsection

@section('scripts.footer')
<script type="text/javascript">
(function($) {

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
	
// 	$('.add-to-order').on('click',function(e){
	$(document).on("click", ".add-to-order" , function() {
		var code = $(this).attr("item-code");
		$.ajax({
			  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
		      url: '/home/menu/addtoorder',
		      type: 'POST',
		      data: {'id':code},
		      success: function(result) {
				  add_basket(result);
              },
              error: function(result) {
                  alert("Data not found");
              }
		 });
	});

	$(document).on("click", ".remove-to-order" , function() {
		var code = $(this).attr("item-code");
		$.ajax({
			  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
		      url: '/home/menu/removetoorder',
		      type: 'POST',
		      data: {'id':code},
		      success: function(result) {
				  add_basket(result);
            },
            error: function(result) {
                alert("Data not found");
            }
		      });
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
				  if(i != "total"){
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
		  $('.total-amount').text('$'+result['total']);
		  $('.number-of-items').text(totalqty);
		  $(".basket_order").html(html);
	}

}(jQuery));

</script>

@endsection