 @extends('backend.admin_master') 
 
 @section('backend.css')
 <link href="/css/backend/print.css" rel="stylesheet" type= "text/css" />
 @endsection
 
 @section('page-header')

 @section('page-header')
 <h1>
{{ trans('backend_order.order_data') }}
</h1>
@endsection
 
 @section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="hide">
			<div id="pos_printer">
				
			</div>
		</div>
		<div class="box">
			
			<div class="box-header form-inline">
			<div class="col-sm-9">
			<a class="btn btn-default all" href="/admin/order/data/today">{{ trans('backend_order.order_datas.today') }}</a>
			<a class="btn btn-default paid" href="/admin/order/data/yesterday">{{ trans('backend_order.order_datas.yesterday') }}</a>
			<a class="btn btn-default cash" href="/admin/order/data/week">{{ trans('backend_order.order_datas.week') }}</a>
			<a class="btn btn-default cash" href="/admin/order/data/lastweek">{{ trans('backend_order.order_datas.lastweek') }}</a>
			</div>
			
			</div>
			
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover text-center">
					<tbody>
						<tr>
							<th>{{ trans('backend_order.datas.totalorder') }}</th>				
							<th>{{ trans('backend_order.datas.totaldeal') }}</th>
							<th>{{ trans('backend_order.datas.totalmeals') }}</th>
							<th>{{ trans('backend_order.datas.deliverynum') }}</th>
							<th>{{ trans('backend_order.datas.deliveryfee') }}</th>
							<th>{{ trans('backend_order.datas.pickup') }}</th>
						</tr>
						
						
						<tr >
							<td>{{ $total['orders'] }}</td>
							<td>{{ $total['deal'] }}</td>
							<td>{{ $total['meals'] }}</td>
							<td>{{ $total['delivery'] }}</td>
							<td>{{ $total['deliveryfee'] }}</td>
							<td>{{ $total['pickup'] }}</td>
						</tr>
							
					</tbody>
				</table>
			</div>
			
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection

@section('backend.scripts.footer')
<!-- <script src="/js/socket/socket.io.min.js"></script> -->
<script src="/js/printer/jquery.print.js"></script>
<script src="/js/printer/jquery-migrate-1.1.0.js"></script>
<script src="/js/printer/jquery.jqprint-0.3.js"></script>
<script src="/js/ace/ace-extra.min.js"></script>

@endsection
