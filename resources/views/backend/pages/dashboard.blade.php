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

 <div class="row">

	@foreach($printed_orders as $order)
	<div class="col-md-4 order_box">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">
					<u>
						<a href="/admin/order/show/{{ $order->ordernumber }}">
						{{$order->customernumber() }}
						</a>
					</u>
				{{$order->name}}
				-
				{{ \Carbon\Carbon::parse($order->shiptime)->diffForHumans() }}
				</h3>
				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool order_process" order_code="{{$order->id}}" >
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
								{{$order->ordertype}}
							</span>
						</div>
						<div class="col-3">
							<span class="description">
								{{$order->payment()}}
							</span>
						</div>
						<div class="col-3">
							<span class="description">
								{{$order->shiptimeformat()}}
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
								<span class="description">{{$order->phonenumber}}</span>
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
								<span class="description">{{$order->paymenttime()}}</span>
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
								<span class="description">{{$order->ordertype}}</span>
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
								<span class="description">{{$order->payment()}}</span>
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
								<span class="description">{{$order->paymentmethod()}}</span>
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
								<span class="description">{{$order->shiptimeformat()}}</span>
							</div>
						</div>
					</div>
			</div>
			<hr>
			
			@foreach($order->orderitems as $item)
				<div class="box-body">
				
						<div class="col-9">
			                <span class="description">
								{{$item->amount}} x {{ $item->dishes->name }}
							</span>
						</div>
						<div class="col-3">
							 <span class="text-red">${{ $item->total }}</span>
						</div>
			
						<div class="col-12">
							@if($item->flavour) {{$item->flavour}} <br> @endif

								@foreach($item->takeout as $material) 
									no {{$material->name}}
									<br>
								@endforeach 
								 
								@foreach($item->extra as $material) 
									extra {{$material->name}} 
									<span class="text-red">${{$material->price}}</span>
									<br>
								@endforeach
						</div>
				</div>
				<hr>
				@endforeach 
				
				@if($order->address()->count())
				
				<div class="box-body">
					<div class="col-9">
						<span class="description">
							Delivery Fee:
						</span>
					</div>
					<div class="col-3">
						<span class="text-red">${{$order->address->fee}}</span>
					</div>
				</div>
				<hr>
				@endif
				
				
				
				<div class="box-body">
					<div class="col-12">
						<span class="description">
						Message:
						{{ $order->message }}
						</span>
					</div>
				</div>
				
				<hr>
						
				@if($order->address()->count())
				
				<div class="box-body">
					<div class="col-9">
						<span class="label label-sm label-primary">Address:</span>
						<span class="description">
							{{ $order->address->address }}
							{{ $order->address->suburb }}
							{{ $order->address->city }}
						</span>
					</div>
				</div>
				<hr>
				@endif
				
				
				<div class="box-body">
					<div class="col-9">
						<span class="description">
							Total amount
						</span>
					</div>
					<div class="col-3">
						<span class="text-red">${{$order->totaldue}}</span>
					</div>
				</div>
				
			</div>
			<!-- /.box-body -->
		</div>
	</div>
	@endforeach

	<div class="col-lg-3 col-xs-6">
	<!-- small box -->
	<div class="box-body bg-red">
		<div class="inner">
			<h3 id="created">{{ $created }}</h3>
			<p>New Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="box-body-footer" href="/admin/order/created">{{ trans('backend_order.order_list_tab.created') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
	
</div>
	
<div class="col-lg-3 col-xs-6">
	<div class="box-body bg-yellow">
		<div class="inner">
			<h3 id="printed">{{ $printed }}</h3>
			<p>Printed Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="box-body-footer" href="/admin/order/printed">{{ trans('backend_order.order_list_tab.printed') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>

<div class="col-lg-3 col-xs-6">
	<div class="box-body bg-teal">
		<div class="inner">
			<h3 id="cooked">{{ $cooked }}</h3>
			<p>Cooked Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="box-body-footer" href="/admin/order/cooked">{{ trans('backend_order.order_list_tab.cooked') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>
	
<div class="col-lg-3 col-xs-6">
	<div class="box-body bg-green">
		<div class="inner">
			<h3 id="finished">{{ $finished }}</h3>
			<p>Finished Orders</p>
		</div>
		<div class="icon">
			<i class="ion ion-bag"></i>
		</div>
		
		<a class="box-body-footer" href="/admin/order/finished">{{ trans('backend_order.order_list_tab.finished') }} 
		<i class="fa fa-arrow-circle-right"></i></a>
	</div>
</div>

</div>

@endsection

@section('backend.scripts.footer')
<script src="/js/vue/vue.min.js"></script>
<script src="/js/socket/socket.io.min.js"></script>

<script type="text/javascript">

(function($) {

	var socket=io('{{$_SERVER['SERVER_ADDR']}}:3000');
	socket.on('dashboard_order-channel:App\\Events\\DashboardOrder',function(data){
		console.log(data);
		$("#created").text(data.created);
		$("#printed").text(data.printed);
		$("#cooked").text(data.cooked);
		$("#finished").text(data.finished);
	});

}(jQuery));			
</script>
@endsection
