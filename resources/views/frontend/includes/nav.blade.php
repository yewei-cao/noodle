<nav class="navbar navbar-default">
		<div class= "container">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bfar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="/">Noodle Canteen</a>
					</div>
		
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		
						<ul class="nav navbar-nav navbar-right">
						
						 <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ trans('menus.language-picker.language') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li>{!! link_to('lang/en', trans('menus.language-picker.langs.en')) !!}</li>
                      <li>{!! link_to('lang/cn', trans('menus.language-picker.langs.cn')) !!}</li>
                    </ul>
                  </li>
						
							@if (Auth::guest())
								<li><a href="{{ url('/auth/login') }}">Login</a></li>
								<li><a href="{{ url('/auth/register') }}">Register</a></li>
							@else
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
									<ul class="dropdown-menu" role="menu">
									
										@can('manage_backend')
											<li>{!! link_to_route('backend.dashboard', trans('navs.administration')) !!}</li>
										@endcan
										
										<li>{!! link_to('auth/password/change', "Change Password") !!}</li>
										<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</div>
			
		</div>
	</nav>