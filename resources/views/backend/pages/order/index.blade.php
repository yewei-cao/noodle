 @extends('backend.admin_master') 
 
 
 @section('backend.css')
 <link href="/css/backend/print.css" rel="stylesheet" type= "text/css" />
 @endsection
 
 @section('page-header')

 <h1>
{{ trans('backend_order.order_list') }}
<small><a href="{{ action('Backend\Order\OrderController@create') }}"><button class="btn btn-danger" type="button">{{ trans('element_backend.create') }}</button></a></small>

</h1>
@endsection

@section('breadcrumbs')
	<li style="width: 200px;">
	{!! Form::label('printer','Printer',['class'=>'col-sm-5 control-label no-padding-right']) !!}
	<label>
		{!! Form::checkbox('printer', '1', false,['class'=>'ace ace-switch ace-switch-2','id'=>'printer']) !!}
		<span class="lbl"></span>
	</label>
	</li>
 @endsection
 
 @section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			
			<div class="box-header form-inline">
			<div class="col-sm-9">
			<a class="btn btn-default all" href="/admin/order">{{ trans('backend_order.order_list_tab.all') }}</a>
			<a class="btn btn-default paid" href="/admin/order/paid">{{ trans('backend_order.order_list_tab.paid') }}</a>
			<a class="btn btn-default cash" href="/admin/order/cash">{{ trans('backend_order.order_list_tab.cash') }}</a>
			<a class="btn btn-default created" href="/admin/order/created">{{ trans('backend_order.order_list_tab.created') }}</a>
			<a class="btn btn-default printed" href="/admin/order/printed">{{ trans('backend_order.order_list_tab.printed') }}</a>
			<a class="btn btn-default cooked" href="/admin/order/cooked">{{ trans('backend_order.order_list_tab.cooked') }}</a>
			<a class="btn btn-default finished" href="/admin/order/finished">{{ trans('backend_order.order_list_tab.finished') }}</a>
			<a class="btn btn-default cancel" href="/admin/order/cancel">{{ trans('backend_order.order_list_tab.cancel') }}</a>
			</div>
<!-- 				<div class="col-sm-6"> -->
<!-- 					<div class="dataTables_length" > -->
<!--						<form style="display: table;" name="" method="GET" action="{{ route('admin.order.index') }}"> -->
<!-- 							<label>Show  -->
<!-- 								<select id="paginate" name="paginate" class="form-control input-sm" onchange="document.all.item('submit');"> -->
<!-- 								<option value="10" >10</option> -->
<!-- 								<option value="25">25</option> -->
<!-- 								<option value="50">50</option> -->
<!-- 								<option value="100">100</option> -->
<!-- 								</select> entries -->
<!-- 								</label> -->
<!-- 								{{ csrf_field() }} -->
<!-- 							</form> -->
<!-- 					</div> -->
<!-- 				</div> -->
			<div class="col-sm-3">
					<div class="search_tool">
						<div class="input-group" style="width: 200px;">
						
						<form style="display: table;" name="search" method="POST" action="{{ route('admin.order.search') }}">
							<input class="form-control input-sm pull-right" type="text" placeholder="Search" name="table_search">
							<div class="input-group-btn">
									<button class="btn btn-sm btn-default">
									<i class="fa fa-search"></i>
									</button>
								</div>
							{{ csrf_field() }}
						</form>
						
						</div>
					</div>
			</div>
			</div>
			
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tbody>
						<tr>
							<th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" aria-label=" " style="width: 20px;">
								<label>		<input id="allclick" type="checkbox" class="ace"><span class="lbl"></span>	</label>
							</th>
							<th>{{ trans('backend_order.order.id') }}</th>
							<th>{{ trans('backend_order.order.ordernumber') }}</th>				
							<th>{{ trans('backend_order.order.name') }}</th>
							<th>{{ trans('backend_order.order.status') }}</th>
							<th>{{ trans('backend_order.order.payment') }}</th>
							<th>{{ trans('backend_order.order.paymentmethod') }}</th>
							<th>{{ trans('backend_order.order.shipmethod') }}</th>
							<th>{{ trans('backend_order.order.total') }}</th>
							<th>{{ trans('backend_order.order.phone') }}</th>
							<th>{{ trans('backend_order.order.email') }}</th>
							<th>{{ trans('backend_order.order.message') }}</th>
							<th>{{ trans('backend_order.order.created') }}</th>
							<th>{{ trans('backend_order.order.paymenttime') }}</th>
							<th>{{ trans('menus.action') }}</th>
							
						</tr>
						@foreach($orders as $order)
						<tr>
							<td class="center  sorting_1">
								<label><input name="chkItem" type="checkbox" class="ace" value="{{ $order->id }}"><span class="lbl"></span></label>
							</td>
							<td>{{ $order->id }}</td>
							<td>{{ $order->ordernumber }}</td>
							<td>{{ $order->name }}</td>
							<td>{!! $order->status() !!}</td>
							<td>{{ $order->payment() }}</td>
							<td>{{ $order->paymentmethod() }}</td>
							<td>{{ $order->total }}</td>
							<td>{{ $order->shipmethod }}</td>
							<td>{{ $order->phonenumber }}</td>
							<td>{{ $order->email }}</td>
							<td>{{ $order->message }}</td>
							<td>{!! $order->created_at->diffForHumans() !!}</td>
							<td>{!! $order->paymenttime !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.order.edit', $order->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.order.destroy', $order->id) }}">
									<input type="hidden" value="delete" name="_method">
									{{ csrf_field() }}
									</form>
								</a>
							</td>
							
						</tr>
							@foreach($order->dishes as $dish)
								<tr>
									<td></td>
									<td></td>
									<td>Dish Name:</td>
									<td>{{ $dish->name }}</td>
									<td>Qty</td>
									<td>{{ $dish->pivot->amount }}</td>
									<td>Total</td>
									<td>{{ $dish->pivot->total }}</td>
								</tr>
							@endforeach
						
						@endforeach
						
					</tbody>
				</table>
			</div>
			
			
			<div class="box-footer clearfix">
			
			<div class="col-sm-9">
			<button id="print" class="btn btn-default all">print</button>
			
			<button id="cook" class="btn btn-default all">cook</button>
			
			<button id="finish" class="btn btn-default all">Finish</button>
			
			</div>
			
				{!! $orders->render() !!}
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection


@section('backend.scripts.footer')
<script src="/js/socket/socket.io.min.js"></script>
<script src="/js/printer/jquery-migrate-1.1.0.js"></script>
<script src="/js/printer/jquery.jqprint-0.3.js"></script>
<script src="/js/ace/ace-extra.min.js"></script>
<script type="text/javascript">
(function($) {
// 	$("#paginate").change(function(){
// 		$(this).parents('form').submit();
// 	});

	$('.{{ $tab }}').removeClass('btn-default');
	$('.{{ $tab }}').addClass('btn-primary');

	var socket=io('http://192.168.10.10:3000');

	socket.on('order_receipt-channel:App\\Events\\OrderReceipt',function(data){
		alert("Get New Orders, Please reflash you page");
		
	});

	$("#allclick").click(function(){
		$("input[name='chkItem']").each(function(){
		$(this).attr("checked",!this.checked);              
	})
	});



	
	$("#print").click(function(){
		
		$("input[name='chkItem']:checked").each(function () {
			$.ajax({
				  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
			      url: '{{ route('admin.order.print') }}',
			      type: 'POST',
			      data: {'orderid':this.value},
				  success: function(result) {
				  	if(result.message=="success"){
				  		window.location.reload();
				  }else{
						swal({   title: "Error!",
							text: result.message,
							type: "error",
							confirmButtonText: "OK"
							});
				  }
				  
		          },
		          error: function(result) {
		          	alert("Print fail, PLease print again");
		          }
			});
        });
           
	});

	$("#cook").click(function(){
			$("input[name='chkItem']:checked").each(function () {
				$.ajax({
					  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
				      url: '{{ route('admin.order.cook') }}',
				      type: 'POST',
				      data: {'orderid':this.value},
					  success: function(result) {
					  	if(result.message=="success"){
					  		window.location.reload();
					  }else{
						  swal({   title: "Error!",
								text: result.message,
								type: "error",
								confirmButtonText: "OK"
								});
					  }
					  
			          },
			          error: function(result) {
			        	  swal({   title: "Error!",
								text: "Cooked update fail, PLease do that again",
								type: "error",
								confirmButtonText: "OK"
								});
			          }
				});
	        });
	           
		});


	$("#finish").click(function(){
		$("input[name='chkItem']:checked").each(function () {
			$.ajax({
				  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
			      url: '{{ route('admin.order.finish') }}',
			      type: 'POST',
			      data: {'orderid':this.value},
				  success: function(result) {
				  	if(result.message=="success"){
				  		window.location.reload();
				  }else{
					  swal({   title: "Error!",
							text: result.message,
							type: "error",
							confirmButtonText: "OK"
							});
				  }
				  
		          },
		          error: function(result) {
		        	  swal({   title: "Error!",
							text: "Finished status update fail, PLease do that again",
							type: "error",
							confirmButtonText: "OK"
							});
		          }
			});
			
        //alert(this.value);
//	        $('#cook').append(this.value + "  ");
        });
           
	});

	
	$("#printer").bind("click", function () {
		if($('#printer').is(':checked')){
			
			$.ajax({
				  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
			      url: '{{ route('admin.order.orderprinter') }}',
			      type: 'POST'
			      });
			
			socket.on('order_printer-channel:App\\Events\\OrderPrinter',function(data){
				alert("ok");
				
				$('#pos_printer').jqprint();
				
			});
		}
	});
	
}(jQuery));			
</script>

@endsection
