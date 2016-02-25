@extends('frontend.master')

@section('css.style')
<style type="text/css">

.float_left{
float:left;
}


.order-layout {
    padding: 0;
    overflow: hidden;
    position: relative;
}


@media (min-width: 768px){

.container {
    width: 100%;
    margin: 0 auto;
    padding: 0 10px;
    overflow: visible;
}
}

@media (min-width: 1200px){

.container {
    width: 95%;
    padding: 0;
}
}


.basket-top {
    background-color: transparent!important;
    background: url("../images/Home/basket-top.png") top center repeat-x;
    height: 10px;
    width: 100%;
    position: relative;
    top: 5px;
    border-left: 1px solid #c5c5c5;
    border-right: 1px solid #c5c5c5;
    -webkit-print-color-adjust: exact;
}
.basket-header {
    background: #dedede;
    padding: 10px 20px 10px;
    border-left: 1px solid #c5c5c5;
    border-right: 1px solid #c5c5c5;
}

.basket .basket-body {
    overflow: hidden;
}
 .basket-body {
    background: white;
    padding: 10px 10px 0 10px;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
}

.basket-body h3{
	margin:0px;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 1.5em;
    padding: 0 10px;
    color: #000;
    line-height: 1.2em;
}

.basket .empty-order {
    margin: 1em 0 3em;
    padding: 10px;
    text-align: left;
    font-weight: normal;
    font-size: .75em;
    color: gray;
}

.basket .basket-body .total-container {
    text-transform: uppercase;
    font-weight: bold;
    font-size: 1.3em;
    color: #333;
    padding: 10px 0;
    margin: 0 10px;
    width: auto;
    border-bottom: 1px dotted #a6a6a6;
}
.basket .basket-body .total-container .total-amount {
    float: right;
    color: #006991;
}

.basket .basket-footer {
    background: white;
    padding: 0 10px 10px;
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    color: #333;
}

.basket .basket-footer .basket-navigation {
    padding: 10px;
}

.btn.next {
    color: white;
    background-color: #e41837;
    border-color: #e41837;
    padding-right: 18px;
    position: relative;
    padding-right: 18px;
    display:block;
}

.basket .basket-footer #selected-service-method {
    border-top: 1px dotted #a6a6a6;
    padding: 10px;
    font-size: .75em;
    line-height: 1.4;
}

.basket_row {
    position: relative;
    width: 100%;
}

.basket .basket-bottom {
    background: url("../images/Home/basket-bottom.png") bottom center repeat-x;
    height: 10px;
    width: 100%;
    position: relative;
    border-left: 1px solid #c5c5c5;
    border-right: 1px solid #c5c5c5;
}


.panel_mobile{
left:10px;
right:10px;
    z-index: 1000;
    bottom: 50px;
    overflow-y: auto;
    max-height: 100%;
}


.product-container {
    display: block;
    float: left;
    position: relative;
    width: 100%;
    padding: 2px;
    margin-bottom: 5px;
}

.basket { 
     -webkit-transition: -webkit-transform 300ms ease;
     -moz-transition: -moz-transform 300ms ease;
     -o-transition: -o-transform 300ms ease;
     transition: transform 300ms ease;
     display: none;
     position: fixed;
     bottom: 0;
     z-index: 1000;
     padding-bottom: 62px;
     overflow-y: auto;
     max-height: 100%;
     pointer-events: auto;
     left: 10px;
     right: 10px; 
} 

.col-md-3{
float: left;
width: 100%;
}


@media (min-width: 375px){

.product-container {
    width: 50%;
    height: 300px;
    margin-bottom: 1em;
}
}

@media (min-width: 768px){

.order-layout {
    max-width: 1024px;
    margin: 0 auto;
    padding: 0 10px;
    overflow: visible;
}
 .basket {
     display: block;
     position: relative;
     top: initial;
     bottom: initial;
     left: auto;
     right: auto;
     height: auto;
     overflow: hidden;
     clear: none;
     max-height: none;
 } 
.product-container {
    width: 33.33333%;
}

.panel-width{
width:252px;
top:10px;
}

.col-md-9 {
    width: 70%;
   padding-left: 5px;
   padding-right: 0px;
}
.col-md-12{
padding:0px;
}

.col-md-3{
width: 30%;
padding:0px;
}

}


@media (min-width: 992px){

.col-md-9 {
    width: 75%;
     padding-left: 15px;
}
.col-md-3{
width: 25%;
 padding-left: 15px;
}

.basket .basket-bottom {
    display: block;
}
.product-container {
    width: 25%;
}

.panel-width{
width:262px;
}

}


@media (min-width: 1200px){
.order-layout {
    max-width: 1440px;
    padding: 0;
}
}


@media (min-width: 1480px){
.product-container {
    width: 16.66667%;
}
}





</style>

@endsection

@section('jscript')
<script src="/js/breakpoints.js"></script>
<script src="/js/jquery.sticky-kit.js"></script>
<script type="text/javascript">

</script>

@endsection

@section('content')

<div class="row">

	<div class="col-md-12" id="order_main">

	
			<div class="col-md-12">
				<h2>Popular Meal</h2>
				<hr/>

	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>

	            
			</div>
			
			
			<div class="col-md-12">
				<h2>Popular Meal222</h2>
				<hr/>

	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>

	            
			</div>
			
			
			<div class="col-md-12">
				<h2>Popular Meal3333</h2>
				<hr/>

	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>

	            
			</div>
			
			
			<div class="col-md-12">
				<h2>Popular Meal444</h2>
				<hr/>

	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>

	            
			</div>
			
			
			
			<div class="col-md-12">
				<h2>Popular Meal555</h2>
				<hr/>

	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	            
	             <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>
	
	            <div class="product-container" style="height: 275px;">
	                <div class="product">
	                    <img src="http://placehold.it/800x500" alt="">
	                    <div class="caption">
	                        <h3>Feature Label</h3>
	                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	                        <p>
	                            <a href="#" class="btn btn-primary">Buy Now!</a> 
	                        </p>
	                    </div>
	                </div>
	            </div>

	            
			</div>
	
	
	</div><!-- /.col-md-12 -->
	
		<div class="col-md-3 "  >
            <div class="panel panel-width basket" id="basket-panel" >
            
            	<div class="basket-top"></div>
            	
            	<div class="basket-header">
<!--         <form id="voucher_form" class="voucher-code"> -->
<!--             <div class="input-group"> -->
<!--                 <label for="voucher_code">Enter voucher code here</label> -->
<!--                 <div class="row"> -->
<!--                     <div class="col-8"> -->
<!--                         <input id="voucher_code" class="form-control" type="text" spellcheck="false" placeholder="Voucher code"> -->
<!--                     </div> -->
<!--                     <div class="col-4"> -->
<!--                         <button id="apply_voucher" class="btn btn-primary" type="submit">Apply</button> -->
<!--                         <span id="loading-indicator" class="loaded"> -->
<!--                             <img class="image-loading" src="/eStore/Resources/Images/ajax-loader.gif" alt=""> -->
<!--                         </span> -->
<!--                     </div> -->
<!--                 </div> -->
<!--             </div> -->
<!--         </form> -->
    			</div>
    			
    			<div id="basket" class="basket-body">
       				<h3 id="order-cart-heading">Order Details</h3>
		       		<div id="basket_rows" class="body-content">
		           
					    <div class="empty-order">Your order is currently empty.</div>
						<div class="row total-container">
						    <span class="total">Total</span>
						    <span class="total-amount">$0.00</span>
						    <input type="hidden" name="at-total-value" value="0">
						</div>
					</div>
				</div>
				
				
			
   			
   			
   			
   			<div class="basket-footer">
            	<div class="basket_row basket-navigation">
                 <a id="basket-next" class="btn next medium btn-lg" href="/eStore/en/ProductMenu?menuCode=Menu.Side">Next</a>
            	</div>


		        <div class="basket_row">
					<div id="selected-service-method">
		    			<div class="from-store">PICK UP FROM:</div>
		   				<div>GREENMEADOWS STORE</div>
		    			<div>06 845 9700</div>
		   				<div>Shop 8 &amp; 917 Gloucester Street Green Meadows</div>
		    			<div>Napier, NZ</div>    
					</div>        
				</div>

   			</div>
   			
   			
   			
   			<div class="basket-footer">
            	<div class="basket_row basket-navigation">
                 <a id="basket-next" class="btn next medium btn-lg" href="/eStore/en/ProductMenu?menuCode=Menu.Side">Next</a>
            	</div>


		        <div class="basket_row">
					<div id="selected-service-method">
		    			<div class="from-store">PICK UP FROM:</div>
		   				<div>GREENMEADOWS STORE</div>
		    			<div>06 845 9700</div>
		   				<div>Shop 8 &amp; 917 Gloucester Street Green Meadows</div>
		    			<div>Napier, NZ</div>    
					</div>        
				</div>

   			</div>
				
				
				<div class="basket-bottom"></div>
				
                
            </div>
            
            
        </div><!-- col-md-3 -->


	
</div><!-- /.row -->




@endsection

@section('scripts.footer')
<script type="text/javascript">
(function($) {

	$(window).setBreakpoints({
		distinct:!0,breakpoints:[0,414,768,992,1200,1480]
	});

	$(window).on({"enterBreakpoint768 enterBreakpoint992 enterBreakpoint1200 enterBreakpoint1480":function(){
		$("#basket-panel").stick_in_parent({
			parent:"#order_main",offset_top: 10,recalc_every:50
		});
	},"enterBreakpoint0 enterBreakpoint414":function(){
		$("#basket-panel").trigger("sticky_kit:detach")
		}
	});



	
}(jQuery));


</script>


@endsection

