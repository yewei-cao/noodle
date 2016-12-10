<nav class="navbar navbar-red">
		<div class= "container">
				<div class="container-redfluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle Navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bfar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-redbrand" href="/">
							<img alt="Noodle Canteen@Taradale" src="{{url()}}/images/home/home_nav.jpg" >
						</a>
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
						
							
                  
                  
						</ul>
					</div>
				</div>
			
		</div>
	</nav>