@extends('frontend.master') @section('css.style')
<link href="/css/ace.min.css" rel="stylesheet" type= "text/css" />

<style type="text/css">

</style>

@endsection 


@section('content')

<div class="invoice">
<div class="row">
	<div class="col-sm-10 col-sm-offset-1">
		<div class="widget-box transparent">
			<div class="widget-header widget-header-large">
				<h3 class="widget-title grey lighter">Customer Invoice</h3>

				<div class="widget-toolbar no-border invoice-info">
					<span class="invoice-info-label">Order number:</span> <span class="red_span">{{ $order->ordernumber}}</span>

					<br> <span class="invoice-info-label">Date:</span> <span
						class="blue">{{ $order->created_at->format('Y-m-d') }}</span>
				</div>

				<div class="widget-toolbar hidden-480">
					<a href="#"> 
					 <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
					</a>
				</div>
			</div>

			<div class="widget-body">
				<div class="widget-main padding-24">
					<div class="row">
						<div class="col-sm-6">
							<div class="row">
								<div
									class="col-xs-11 label label-lg label-info arrowed-in arrowed-right">
									<b>Company Info</b>
								</div>
							</div>

							<div>
								<ul class="list-unstyled spaced">
									<li> <span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Shop 8 &amp; 269 Gloucester Street Taradale</li>

									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Zip Code 4112</li>

									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Hawkes Bay, New Zealand</li>

									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Phone: <b
										class="red_span">06-844-3588</b></li>

									<li class="divider"></li>

									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Paymant
										Info</li>
								</ul>
							</div>
						</div>
						<!-- /.col -->

						<div class="col-sm-6">
							<div class="row">
								<div
									class="col-xs-11 label label-lg label-success arrowed-in arrowed-right">
									<b>Customer Info</b>
								</div>
							</div>

							<div>
								<ul class="list-unstyled  spaced">
									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Name: {{ $order->name }}</li>

									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Phone: {{ $order->phonenumber }}</li>

									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Email: {{ $order->email }}</li>

									@if($order->address()->count())
										<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Address: {{ $order->address->address }}</li>
										
										<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>Suburb: {{ $order->address->suburb }}</li>
										
										<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span>City: {{ $order->address->city }}</li>
										
									@endif
									<li class="divider"></li>

<!-- 									<li><span class="glyphicon glyphicon-triangle-right" aria-hidden="true"></span> Contact Info</li> -->
								</ul>
							</div>
						</div>
						<!-- /.col -->
					</div>
					<!-- /.row -->

					<div class="space"></div>

					<div>
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th class="center">Number</th>
									<th>Dish</th>
									<th class="hidden-xs">Description</th>
									<th class="hidden-480">Qty</th>
									<th>Total</th>
								</tr>
							</thead>

							<tbody>
							
							
							@foreach($order->dishes as $dish)
								<tr>
									<td class="center">{{  $dish->number }}</td>

									<td><a href="#">{{  $dish->name }}</a></td>
									<td class="hidden-xs">{{  $dish->description }}</td>
									<td class="hidden-480">{{  $dish->pivot->amount }}</td>
									<td>{{  $dish->pivot->total }}</td>
								</tr>
								
								@endforeach	
								
							</tbody>
						</table>
					</div>

					<div class="hr"></div>

					<div class="row">
						<div class="col-sm-5 pull-right">
							<h4 class="pull-right">
								Total amount : <span class="red_span">${{ $order->total }}</span>
							</h4>
						</div>
					</div>
					
					
					<div class="row">
					<div class="col-sm-7 pull-left">Message</div>
					</div>
					
					<div class="row border_bottom">
					<div class="well">{{ $order->message}}</div>
					</div>
					
					<div class="row border_bottom">
					<div class="pull-left ">Thank you for choosing Noodle Dishes. We believe you will be satisfied by our services.</div>
					</div>
					
					
					<div class="row">
					<h3 class="lighter smaller"><a href="{{ url('/home') }}">Home Page</a></h3>
					</div>
					
					
				</div>
			</div>
		</div>
	</div>
</div>

</div>

@endsection

@section('scripts.footer')
<script src="/js/printer/jquery-migrate-1.1.0.js"></script>
<script src="/js/printer/jquery.jqprint-0.3.js"></script>
<script language="javascript">

$(document).on("click", ".glyphicon-print" , function() {
	 $(".invoice").jqprint();
});

</script>


@endsection 

