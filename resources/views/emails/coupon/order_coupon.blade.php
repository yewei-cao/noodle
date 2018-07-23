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
				<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td style="color: #153643; font-family: Arial, sans-serif; font-size: 24px;">
								<b>Hi {{$order->name}}</b>
							</td>
						</tr>
						
						<tr>
							<td style="padding: 25px 0 5px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
								Thank you for buy our dishes. According to your consumption on the Internet of our shop.
							</td>
						</tr>
						
						<tr>
							<td style="padding: 25px 0 5px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
								You have received a voucher worth ${{$coupon->value}}. The Code is <span style="color: #f78f1e">{{$coupon->code }}</span>.
								 You can use the voucher in <a href="www.noodletaradale.co.nz">our website</a> 
								 before {{ $coupon->expiretime() }}.
							</td>
						</tr>
						
						<tr>
							<td style="padding: 25px 0 5px 0; color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 20px;">
								Usage: Type up the voucher code in order basket panel and apply. Like the image below.
							</td>
						</tr>
						
						<td align="center" bgcolor="#70bbd9" style="font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
							<img src="{{url()}}/images/home/coupon_example.PNG" alt="Creating Email Magic" width="327" height="583" style="display: block;" />
						</td>
						
					</table>
				</td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#70bbd9" style="font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;">
					<img src="{{url()}}/{{$coupon->photo_path}}" alt="Creating Email Magic" width="600" height="211" style="display: block;" />
				</td>
			</tr>
			
			<tr>
				<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
					<table border="0" cellpadding="0" cellspacing="0" width="100%">
						<tr>
							<td style="text-align: center;">
								Copyright Noodle Canteen Taradale Enterprises Ltd 2016.
							</td>
						</tr>
						
						<tr>
							<td style="text-align: center;">
								269 Gloucester St, Taradale. Phone number:844 3588
							</td>
						</tr>
						
						<tr>
							<td style="text-align: center;">
									<a href="#">Our website</a>
									<span> &nbsp; &nbsp; </span>
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