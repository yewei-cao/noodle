<table border="0" cellpadding="0" cellspacing="0" width="100%">	
	<tr>
		<td style="padding: 10px 0 30px 0;">
			<table align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="border: 1px solid #cccccc; border-collapse: collapse;">
				<tr>
					<td align="center" bgcolor="#70bbd9" style="font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
						<img src="{{url()}}/images/logo/noodle_head.jpg" alt="Creating Email Magic" width="600" height="100" style="display: block;" />
					</td>
				</tr>
				<tr>
					<td bgcolor="#ffffff" style="padding: 40px 0px 40px 0px;">
						<table border="0" cellpadding="0" cellspacing="0" width="100%">
																							
							<tr>
								<td style=" padding: 0px 40px 0px 40px; width: 80%; color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
									Dear {{ $order->name}}:
								</td>
							</tr>
							
							<tr>
								<td style="padding: 0px 40px 0px 40px; color: #153643; font-family: Arial, sans-serif; font-size: 12px; line-height: 18px;">
									<b>This is the receipt of your order at {{$order->createtime()}}</b>
								</td>
							</tr>
							
							
							<tr>
								<td style="padding: 0 0 20px; text-align: center;">
									<table style="text-align: left; margin: 40px auto; width: 80%;">
										<tr>
											<td style="padding: 5px 0;">Invoice #{{$order->ordernumber}}</td>
										</tr>
										
										<tr>
											<td style="padding: 5px 0;">Amount Due: ${{$order->total}}</td>
										</tr>
										
										@if($order->paymentflag==2)
										<tr>
											<td style="padding: 5px 0;">Due Time: {{$order->paymenttime()}}</td>
										</tr>
										@endif
										
										<tr>
											<td style="padding: 5px 0;">Order Type: {{$order->ordertype}}</td>
										</tr>
										
										<tr>
											<td style="padding: 5px 0;">Pickup or Delivery Time: {{$order->shiptime()}}</td>
										</tr>
										
										<tr>
											<td style="padding: 5px 0;">Payment Type: {{$order->payment()}}</td>
										</tr>
										
										<tr>
											<td style="padding: 5px 0;">Payment Method: {{$order->paymentmethod()}}</td>
										</tr>
										
										@if($order->address()->count())
										
										<tr>
											<td style="padding: 5px 0; color: #dd5a43; ">Delivery Fee: ${{$order->address->fee}}</td>
										</tr>
										@endif
										
										
										<tr>
											<td style="padding: 5px 0;">
												<table style="width: 100%;" cellpadding="0" cellspacing="0">
													<tr>
														<td style="padding: 5px 0; border-top: #eee 1px solid;  width="10%"">Nunber</td>
														<td style="padding: 5px 0; border-top: #eee 1px solid;  width="50%"">Dish Name</td>
														<td style="padding: 5px 0; border-top: #eee 1px solid;  width="20%"">Amount</td>
														<td style="padding: 5px 0; border-top: #eee 1px solid;  width="20%"">Total</td>
													</tr>		
													@foreach($order->dishes as $dish)
														<tr>
															<td style="padding: 5px 0; border-top: #eee 1px solid;  width="10%"">{{  $dish->number }}</td>
															<td style="padding: 5px 0; border-top: #eee 1px solid;  width="50%"">{{  $dish->name }}</td>
															<td style="padding: 5px 0; border-top: #eee 1px solid;  width="20%"">{{  $dish->pivot->amount }}</td>
															<td style="padding: 5px 0; border-top: #eee 1px solid;  width="20%"">{{  $dish->pivot->total }}</td>
														</tr>
													@endforeach
													
													
												</table>
											</td>
										</tr>
										
										<tr>
											<td style="padding: 5px 0;">
												<table style="width: 100%;" cellpadding="0" cellspacing="0">
													<tr>
														<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;" width="80%">Total amount :</td>
														<td style="border-top: 2px solid #333; border-bottom: 2px solid #333; font-weight: 700;">${{ $order->totaldue }}</td>
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
										
										@if($order->address()->count())
											<tr>
												<td>
													Address
												</td>
											</tr>
											
											<tr>
												<td>
													{{ $order->address->address}} &nbsp; &nbsp;{{ $order->address->suburb}}&nbsp; &nbsp;{{ $order->address->city}}
												</td>
											</tr>
										@endif
										
										
										<tr>
											<td style="padding: 40px 0 20px; text-align: center;">
												Thank you for choosing Noodle Dishes. We hope you enjoy your meals.
											</td>
										</tr>
										
									</table>
								</td>
							</tr>
							
						</table>
					</td>
				</tr>
				
				<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="text-align: center;">
										Copyright © Noodle Canteen Enterprises Ltd 2016.
									</td>
								</tr>
								
								<tr>
									<td style="text-align: center;">269 Gloucester St, Taradale.</td>
								</tr>
								
								<tr>
									<td style="text-align: center;">Phone number:844 3588</td>
								</tr>
								
								<tr>
									<td style="text-align: center;">
										<a href="{{url()}}">Our website</a>
										<span> &nbsp; • &nbsp; </span>
										<a href="#">Facebook</a>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				
				
			</table>
		</td>
	</tr>
</table>


