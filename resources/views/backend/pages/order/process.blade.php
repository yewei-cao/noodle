 @extends('backend.admin_master')
 
@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
@endsection
 
 @section('backend.css')
 <style type="text/css">
 .row .col-3, .row .col-9 {
    float: left;
    padding: 0 2px 0 3px;
}
 .row .col-9 {
    width: 75%;
    float: left;
}
.row .col-3 {
    width: 25%;
    float: left;
}
.row .col-6{
	width: 50%;
	float: left;
}

.row .col-4{
	width: 33%;
	float: left;
}

.basket .basket-body .add-product, .basket-body .row .description {
    font: normal normal normal 12px/14px droid_sans,sans-serif;
}

.basket-body .row .description {
    font-weight: 700;
    font-size: 12px;
    letter-spacing: .05em;
    line-height: 1.3;
}

.box-body.box-warning {
  border: 1px solid #f39c12;
}

.box hr {
  margin: 0px;
}
.box-triger .box-collapse{
display: none;
}
 </style>
@endsection


@section('content')

 <div class="row" id="order_boxs">

<div id="ordres">
 	<div  v-repeat="order:orders" class="col-md-4"> -->
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">
					<u>
						<a href="/admin/order/show/{{order.ordernumber}}">
						@{{order.ordernumber}}
						</a>
					</u>
				@{{order.name}}
				-
				</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool order_process" order_code="@{{order.id}}" >
						Process
					</button>
				</div>
				<!-- /.box-tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body ">
				
				<div class="box-body box-warning box-triger collapsed-box">
					<div class="box-header with-border ">
					
						<div class="col-3">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
				            </button>
			            </div>  
		                
						<div class="col-3">
							<span class="description">
								@{{order.ordertype}}
							</span>
						</div>
						<div class="col-3">
							<span class="description">
								@{{order.paymentflag}}
							</span>
						</div>
						<div class="col-3">
							<span class="description">
								@{{order.shipmethod}}
							</span>
						</div>
					</div>
					
					<div class="box-solid box-collapse" >
						<div class="box-body">
							<div class="col-6">
								<span class="description">
									Phone number:
								</span>
							</div>
							<div class="col-6">
								<span class="description">@{{order.phonenumber}}</span>
							</div>
						</div>
						<hr>
						<div class="box-body">
							<div class="col-6">
								<span class="description">
									Due Time:
								</span>
							</div>
							<div class="col-6">
								<span class="description">@{{order.paymenttime}}</span>
							</div>
						</div>
						<hr>
						<div class="box-body">
							<div class="col-6">
								<span class="description">
									Order Type:
								</span>
							</div>
							<div class="col-6">
								<span class="description">@{{order.ordertype}}</span>
							</div>
						</div>
						<hr>
						<div class="box-body">
							<div class="col-6">
								<span class="description">
									Order Payment:
								</span>
							</div>
							<div class="col-6">
								<span class="description">@{{order.paymentmethod_id}}</span>
							</div>
						</div>
						<hr>
						<div class="box-body">
							<div class="col-6">
								<span class="description">
									Pay by:
								</span>
							</div>
							<div class="col-6">
								<span class="description">@{{order.paymentmethod_id}}</span>
							</div>
						</div>
						<hr>
						<div class="box-body">
							<div class="col-6">
								<span class="description">
									Shipping Time:
								</span>
							</div>
							<div class="col-6">
								<span class="description">@{{order.ordertype}}</span>
							</div>
						</div>
					</div>
			</div>
			<hr>
			
				<div v-for="(item,index) in order.orderitems class="box-body">
				
						<div class="col-9">
			                <span class="description">
								@{{item.amount}} x
							</span>
						</div>
						<div class="col-3">
							 <span class="text-red">$@{{ item.total }}</span>
						</div>
			
						
				</div>
				<hr>
			
				
				
				
				<div class="box-body">
					<div class="col-12">
						<span class="description">
						Message:
						@{{ order.message }}
						</span>
					</div>
				</div>
				
				<hr>
						
				
				<div class="box-body">
					<div class="col-9">
						<span class="description">
							Total amount
						</span>
					</div>
					<div class="col-3">
						<span class="text-red">$@{{order.totaldue}}</span>
					</div>
				</div>
				
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	
	
	
	 <tr v-for="(order,index) in orders" class="goods-list">
                <td>{{order.id}}</td>
                <td>{{order.name}}</td>
            </tr>
	
</div>	

</div>

@endsection

@section('backend.scripts.footer')
<script src="/js/vue/vue.min.js"></script>
<script src="/js/socket/socket.io.min.js"></script>

<script type="text/javascript">

var socket=io('{{$_SERVER['SERVER_ADDR']}}:3000');

//vue
new Vue({
  el: '#order_boxs',
  data: {
    orders: []
  },
  ready: function(){
	  socket.on('order_process-channel:App\\Events\\OrdersProcess',function(data){
// 		  console.log(data);
// 		  window.location.reload()
			this.orders.push(data.orders);
// 			var i = 0;
// 			$("#printed").text(data.printed);
  }.bind(this));
  }
});




	
	

	
</script>
@endsection
