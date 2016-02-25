@extends('frontend.master')

@section('css.style')
<style type="text/css">
body .container{
width:100%;
padding:0px;
}

.product-container .product{
	text-align: center;
}

.product-container .product .caption{
	height:184px;
}

.product-container .product .name-container{
    float: left;
    width: 100%;
    height: 38px;
    text-transform: uppercase;
    font-weight: bold;
    position: relative;
}

.product-container .product .name-container span {
    position: relative;
    top: 50%;
    -ms-transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    display: block;
    line-height: 1;
    text-overflow: ellipsis;
    overflow: hidden;
    width: 100%;
}

.product-container .product .pricing-row .price{
vertical-align: middle;
    font-size: 30px;
    color: #c40000;
}

.product-container .product .pricing-row .dollar{
    vertical-align: middle;
    color: #c40000;
    font-size: 18px;
}
.product-container .product .description-row{
height:104px
}
.product-container .product .description-row span.description{
	display: block;
    min-width: 100%;
    margin-bottom: .4em;
    padding: 5px;
    vertical-align: middle;
    overflow: hidden;
}

.product-container .product .form-container .add-to-basket {
    width: 100%;
}

.product-container .product .form-container{
    width: 100%;
    float: none;
    margin-top: 0;
}


@media (min-width: 375px){

.product-container .product .form-container .add-to-basket {
    padding: 5px;
}
}


.basket .basket-body>.body-content>.basket_order {
    margin: 0 10px 5px;
}
.basket-appearance .basket-body .product {
    font: normal normal normal 12px/14px "droid_sans",sans-serif;
    font-size: .75em;
    display: block;
    padding: 7px 0 10px 0;
    border-bottom: 1px dotted #a6a6a6;
}


.row .col-9 {
    float: left;
    padding: 0 2px 0 3px;
    width: 75%;
}

.row .col-3 {
    float: left;
    padding: 0 2px 0 3px;
    width: 25%;
}

.basket-body .product {
    font: normal normal normal 12px/14px "droid_sans",sans-serif;
    font-size: .75em;
    display: block;
    padding: 7px 0 10px 0;
    border-bottom: 1px dotted #a6a6a6;
}

 .basket-body .product .row .description {
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    font: normal normal normal 12px/14px "droid_sans",sans-serif;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 12px;
    line-height: 1.2em;
    letter-spacing: .05em;
    line-height: 1.3;
    color: #000;
}

.basket-body .product .row .description a {
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
    color: #000;
}

.basket .basket-body .product .row .price {
    float: right;
    font-weight: bold;
}

.basket .basket-body .add-product{
    padding: 1px 6px;
    margin-right: 6px;
    color: #fff;
    background-color: #333;
    border-color: #333;
    border-radius: 1px;
    font: normal normal normal 12px/14px "droid_sans",sans-serif;
    font-size: .75em;
    font-size: 11px;
}
.basket .basket-body .remove-product{
    padding: 1px 6px;
    margin-right: 6px;
    color: #fff;
    background-color: #006991;
    border-color: #006991;
    border-radius: 1px;
    font: normal normal normal 12px/14px "droid_sans",sans-serif;
    font-size: .75em;
    font-size: 11px;
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
		                +'       <div class="col-3"><span class="price at-product-price">'+ result[i]['price'] +'</span></div>'
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
		  $('.total').text('$'+result['total']);
		  $(".basket_order").html(html);
	}

}(jQuery));

</script>

@endsection