 @extends('backend.admin_master')
 @section('content')

 <div class="row">
<div class="col-lg-3 col-xs-6">
	<!-- small box -->
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3 id="created">{{ $created }}</h3>
			<p>New Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="small-box-footer" href="/admin/order/created">{{ trans('backend_order.order_list_tab.created') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
	
</div>
	
<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3 id="printed">{{ $printed }}</h3>
			<p>Printed Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="small-box-footer" href="/admin/order/printed">{{ trans('backend_order.order_list_tab.printed') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>

<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3 id="cooked">{{ $cooked }}</h3>
			<p>Printed Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="small-box-footer" href="/admin/order/cooked">{{ trans('backend_order.order_list_tab.cooked') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
	
<div class="col-lg-3 col-xs-6">
	<div class="small-box bg-aqua">
		<div class="inner">
			<h3 id="finished">{{ $finished }}</h3>
			<p>Printed Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="small-box-footer" href="/admin/order/finished">{{ trans('backend_order.order_list_tab.finished') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>

</div>

@endsection

@section('backend.scripts.footer')
<script src="/js/socket/socket.io.min.js"></script>

<script type="text/javascript">
(function($) {

	var socket=io('{{$_SERVER['SERVER_ADDR']}}:3000');

// 	socket.on('dash_order-channel:App\\Events\\DashOrder',function(data){
// 		$("#created").text(data.created);
// 		$("#printed").text(data.printed);
// 		$("#cooked").text(data.cooked);
// 		$("#finished").text(data.finished);
// 	});
// 	socket.on('order_receipt-channel:App\\Events\\OrderReceipt',function(data){


	socket.on('dashboard_order-channel:App\\Events\\DashboardOrder',function(data){
		$("#created").text(data.created);
		$("#printed").text(data.printed);
		$("#cooked").text(data.cooked);
		$("#finished").text(data.finished);
	});



// 	socket.on('order_receipt-channel:App\\Events\\OrderReceipt',function(data){
// 		$("#created").text(data.created);
// 		$("#printed").text(data.printed);
// 		$("#cooked").text(data.cooked);
// 		$("#finished").text(data.finished);
		
		
// 	});

}(jQuery));			
</script>
@endsection
