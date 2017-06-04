<div class="order-layout-right order-details"  >
	<div class="panel-width basket" id="basket-panel" >
      <div class="mobile-close-button">x</div>
         <div class="basket-top"></div>
            	
         <div class="basket-header">
         	@if($coupon=='')
	            <div class="basket-input voucher ">
	            @else
	             <div class="basket-input voucher hide">
	        @endif
	                <div class="row">
	                    <div class="col-11">
	                        <label for="voucher_code">Enter voucher code here</label>
	                    </div>
	                </div>
	
	                <div class="row">
	                    <div class="col-8">
	                        <input id="voucher_code" class="form-control" type="text" spellcheck="false" placeholder="Voucher code">
	                    </div>
	                    <div class="col-4">
	                        <button id="apply_voucher" class="btn btn-primary" >Apply</button>
	                        <span id="loading-indicator" class="loaded">
	                            <img class="image-loading" src="/images/home/ajax-loader.gif" alt="Please wait while loading">
	                        </span>
	                    </div>
	                </div>
	            </div>
	     	 
         </div>
         
    			<div id="basket" class="basket-body">
       				<h3 id="order-cart-heading">Order Details</h3>
		       		<div id="basket_rows" class="body-content">
		           
		           @if(Cart::count()==0)
		           		
		           		<div class="empty-order">{{ trans("front_home.empty_order") }}</div>
		           		
		           	@else
		           		
		           		<div class="empty-order" style="display: none;">{{ trans("front_home.empty_order") }}</div>
						
					@endif
		           
		           		<div class="basket_order">
		           		
		           		@foreach($cart as $item)
							<div class="basket-product product">
			                
			                <div class="row">
			                    <div class="col-9">
			                        <span class="description">
			                                    {{ $item->qty }} x {{ $item->name }}
			                        </span>
			                    </div>
			                        <div class="col-3"><span class="price at-product-price">{{ $item->price }}</span></div>
			                </div>
			                
			                @if($item->flavour)
			                	<div class="row">
				                	 <div class="col-9">
				                	 	<span class="description">
				                	 	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$item->flavour}}
				                	 	</span>
				                	 </div>
				                
				                </div>
			                @endif
			                
		                	@if($item->takeout)
		                		@foreach($item->takeout as $material)
				                <div class="row">
				                	 <div class="col-9">
				                	 	<span class="description">
				                	 	&nbsp;&nbsp;&nbsp;&nbsp;no  {{ $material['name'] }}
				                	 	</span>
				                	 </div>
				                
				                </div>
				                @endforeach	
			                @endif
			                
			                @if($item->extra)
		                		@foreach($item->extra as $material)
				                <div class="row">
				                	 <div class="col-9">
				                	 	<span class="description">
				                	 	&nbsp;&nbsp;&nbsp;&nbsp;extra  {{ $material['name'] }} ${{$material['price']}}
				                	 	
				                	 	</span>
				                	 </div>
				                
				                </div>
				                @endforeach	
			                @endif
			
			                <div class="row actions">
		                        <button class="btn add-product add-to-basket" type="button" item-code="{{ $item->__raw_id }}" >Add one</button>
		                		<button class="btn btn remove-product remove-to-basket" type="button" item-code="{{ $item->__raw_id }}" >Remove</button>
			                </div>
			                
			            	</div>
			            	
			            @endforeach	
					   
					   </div> 
					   
						@if(!is_null($deliveryfee))
								<div class="row deliveryfee-container">
									<span class="deliveryfee">Delivery Fee</span>
								    <span class="price at-product-price">${{ $deliveryfee }}</span>
								</div>
						@endif
						
						
						@if(!$coupon)
				            <div class="row  voucheritem hide">
					            <div class= "voucheritem_list">
									<div class="voucheritem_text">Voucher code: <span id="voucher_mycode"></span></div>
								</div>
								<div class= "voucheritem_list">
								    <div class="voucheritem_text">worth: <span id="voucher_value"></span></div>
								</div>    
							     <div class="row actions">
			                		<button class="btn btn remove-product remove_voucher" type="button" >Remove Voucher</button>
				                </div>
							</div>
				            
				         @else
				             <div class="row  voucheritem">
					        	<div class= "voucheritem_list">
									<div class="voucheritem_text">Voucher code: <span id="voucher_mycode">{{ $coupon->code }}</span></div>
								</div>
								<div class= "voucheritem_list">
								    <div class="voucheritem_text">worth: <span id="voucher_value">${{ $coupon->value }}</span></div>
								</div>    
							     <div class="row actions">
			                		<button class="btn btn remove-product remove_voucher" type="button" >Remove Voucher</button>
				                </div>
							</div>
					    @endif
						<div class="row total-container">
						    <span class="total">Total</span>
						    <span class="total-amount">${{ $totalprice }}</span>
						</div>
						
					</div>
				</div>
   			
   			<div class="basket-footer">
   			
            	<div class="basket_row basket-navigation">
            		@if($orderroute['prev'])
            		<a class="btn btn-lg prev" href="{{ $orderroute['prev'] }}">{{ trans("front_home.back") }}</a>
                	@endif
                	@if($orderroute['next'])
                	<a id="basket-next" class="btn redbtn next btn-lg float-right" href="{{ $orderroute['next'] }}">{{ trans("front_home.next") }}</a>
            		@endif
            	</div>
            	
		        <div class="basket_row">
					<div id="selected-service-method">
		    			<div class="from-store">PICK UP FROM:</div>
		   				<div>Taradale Store</div>
		    			<div>06 844 3588</div>
		   				<div>Shop 8 &amp; 269 Gloucester Street Taradale</div>
		    			<div>Napier, NZ</div>    
					</div>        
				</div>

   			</div>
				
			<div class="basket-bottom"></div>
				
	</div>
</div>