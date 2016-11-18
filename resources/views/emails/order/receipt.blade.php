<table class="body-wrap">
	<tr>
		<td></td>
		<td class="container" width="600">
			<div class="content">
				<table class="main" width="100%" cellpadding="0" cellspacing="0">
					<tr>
						<td class="content-wrap aligncenter">
							<table width="100%" cellpadding="0" cellspacing="0">
								<tr>
									<td>Dear {{ $order->name}}:</td>
									<td></td>
								</tr>
								<tr>
									<td>This is the receipt of your order at {{$order->created_at}}.</td>
								</tr>
								<tr>
									<td class="content-block aligncenter">
										<table class="invoice">
											<tr>
												<td>Invoice #{{$order->ordernumber}}</td>
											</tr>
											
											<tr>
												<td>Amount Due: {{$order->total}}</td>
											</tr>
											
											<tr>
												<td>Due Date {{$order->created_at}}</td>
											</tr>

												<td>Lee Munroe<br>Invoice #12345<br>June 01 2014</td>
											</tr>
											<tr>
												<td>
													<table class="invoice-items" cellpadding="0" cellspacing="0">
														@foreach($order->dishes as $dish)
															<tr>
																<td>{{  $dish->number }}</td>
							
																<td>{{  $dish->name }}</td>
																<td>{{  $dish->pivot->amount }}</td>
																<td>{{  $dish->pivot->total }}</td>
															</tr>
														@endforeach
														
														<tr class="total">
															<td class="alignright" width="80%">Total</td>
															<td class="alignright">${{ $order->total }}</td>
														</tr>
													</table>
												</td>
											</tr>
											<tr>
												<td>
													Message:
												</td>
											</tr>
											<tr>
												<td>
													{{ $order->message}}
												</td>
											</tr>
										</table>
									</td>
								</tr>
								
								<tr>
									<td class="content-block aligncenter">
										Thank you for choosing Noodle Dishes. We believe you will be satisfied by our services.
									</td>
								</tr>
								
								<tr>
									<td class="content-block aligncenter">
										<a href="{{ url('/home') }}">visit our website</a>
										<span>|</span>
										<a href="{{ url('/home') }}">sing in</a>
									</td>
								</tr>
								
							</table>
						</td>
					</tr>
				</table>
								
				</div>
		</td>
		<td></td>
	</tr>
</table>