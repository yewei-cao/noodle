 <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="/lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p>{{ Auth::user()->name }}</p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..." />
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">HEADER</li>
            
                       
			<li class="active treeview">
              <a href="{!!url('admin')!!}">
                <i class="fa fa-dashboard"></i> <span>{{ trans('menus.dashboard') }}</span> </i>
              </a>
            </li>
            
             <li class="active treeview">
              <a href="#">
                <i class="glyphicon glyphicon-cog"></i> <span>{{ trans('menus.managetitle') }}</span> 
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
               <ul class="treeview-menu" style="display: none; {{ Active::pattern('admin/manage*', 'display: block;') }}">
					
					<li>
					<a href="{{ route('admin.manage.index') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.manage.shop') }}
					</a>
					</li>
					
					<li>
					<a href="{{ route('admin.manage.index') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.manage.email') }}
					</a>
					</li>
					
					<li>
					<a href="{{ route('admin.manage.index') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.manage.notice') }}
					</a>
					</li>
					
					<li>
					<a href="{{ route('admin.manage.blacklist.index') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.manage.blacklist') }}
					</a>
					</li>
					
				</ul>	
				
			 </li>
            
             <li class="active treeview">
              <a href="#">
                <i class="fa fa-th"></i> <span>{{ trans('menus.element') }}</span> 
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
              
               <ul class="treeview-menu" style="display: none; {{ Active::pattern('admin/element*', 'display: block;') }}">
					
					<li>
					<a href="{{ url('/admin/element/type') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.element_manage.material_type') }}
					</a>
					</li>
					
					<li>
					<a href="{{ url('/admin/element/material') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.element_manage.material') }}
					</a>
					</li>
					
					<li>
					<a href="{{ url('/admin/element/material') }}">
					<i class="fa fa-table"></i>
						{{ trans('menus.element_manage.material') }}
					</a>
					</li>
					
					<li>
					<a href="{{ url('/admin/element/mgroup') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.element_manage.group') }}
					</a>
					</li>
					
				</ul>	
				
			 </li>
            
           <li class="active treeview">
              <a href="{!!url('admin')!!}">
                <i class="fa fa-coffee"></i> <span>{{ trans('menus.menu') }}</span> 
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
	           <ul class="treeview-menu" style="display: none; {{ Active::pattern('admin/menu*', 'display: block;') }}">
					<li>
					<a href="{{ url('/admin/menu/type') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.menu_manage.type') }}
					</a>
					</li>
					<li>
					<a href="{{ url('/admin/menu/catalogue') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.menu_manage.catalogue') }}
					</a>
					</li>
					
					<li>
					<a href="{{ url('/admin/menu/dish') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.menu_manage.dish') }}
					</a>
					</li>
					
					<li>
					<a href="../../index.html">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.menu_manage.tag') }}
					</a>
					</li>
				</ul>
              
            </li>
            
              
           <li class="active treeview">
              <a href="{!!url('admin')!!}">
                <i class="fa fa-table"></i> <span>{{ trans('menus.order') }}</span> 
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              
	           <ul class="treeview-menu" style="display: none; {{ Active::pattern('admin/order*', 'display: block;') }}">

					<li>
					<a href="{{ route('admin.order.index') }}">
					<i class="fa fa-circle-o"></i>
						{{ trans('menus.order_manage.order_list') }}
					</a>
					</li>
				</ul>
              
            </li>
            
            
            
            
            
            <li class="{{ Active::pattern('test') }}"><a href="{!!url('admin/test')!!}"><span>Test</span></a></li>
          
                
            <li class="treeview">
              <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="#">Link in level 2</a></li>
                <li><a href="#">Link in level 2</a></li>
              </ul>
            </li>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>