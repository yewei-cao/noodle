<div class="order-layout-right order-details"  >
            <div class="panel-width basket" id="basket-panel" >
            
            	<div class="mobile-close-button">x</div>
            	<div class="basket-top"></div>
            	
            	<div class="basket-header">

    			</div>
    			
    			<div id="basket" class="basket-body">
       				<h3 id="order-cart-heading">Order Details</h3>
		       		<div id="basket_rows" class="body-content">
		           
		           @if(Cart::count()==0)
		           		
		           		<div class="empty-order">Your order is currently empty.</div>
		           		
		           		@else
		           		
		           		<div class="empty-order" style="display: none;">Your order is currently empty.</div>
						
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
			                
			
			                <div class="row actions">
			                        <button class="btn add-product add-to-order" item-code="{{ $item->id }}" >Add one</button>
			                			<button class="btn btn remove-product remove-to-order" item-code="{{ $item->__raw_id }}" class="btn remove-product">Remove</button>
			                </div>
			                
			            	</div>
			            	
			            @endforeach	
					   
					   </div> 
					    
						<div class="row total-container">
						    <span class="total">Total</span>
						    <span class="total-amount">${{ $totalprice }}</span>
						</div>
					</div>
				</div>
				
   			
   			<div class="basket-footer">
            	<div class="basket_row basket-navigation">
                 <a id="basket-next" class="btn next medium btn-lg" href="{{ route('home.payment.paymentmethod') }}">Next</a>
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