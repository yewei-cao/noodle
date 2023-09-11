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
				  
				    <td colspan="2" style="padding-left: 10px; padding-top: 10px;">
				    Hi {{$user->name}},
				    <br><br>
				    We received a request to reset your Trade Me password. If you want to reset your password, click the link below:
				    
				    <br><br>
				    {{ url('password/reset/'.$token) }}
				    
				    <br><br>
				    This link takes you to a page where you can choose a new password. For tips on choosing a strong password.
				    <br><br>
				    Please ignore this message if you don't want to change your password. Your password will not be reset.
				    <br><br>
				    
				    </td>
			
      			</tr>
				
				<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
								<tr>
									<td style="text-align: center;">
										Copyright © Noodle Taradale Enterprises Ltd 2017.
									</td>
								</tr>
								
								<tr>
									<td style="text-align: center;">
										269 Gloucester St, Taradale. Phone number:844 3588
									</td>
								</tr>
								
								<tr>
									<td style="text-align: center;">
										<a href="{{url()}}">Our website</a>
										<span> &nbsp; 鈥� &nbsp; </span>
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


