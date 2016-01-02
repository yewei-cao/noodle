 @extends('backend.admin_master') 
 
 @section('page-header')
<div class="page-header">
 <h1>
{{ trans('menu_backend.nemu_dish_create') }}
<small></small>

</h1>
</div>
 @endsection
 
  @section('breadcrumbs')
 
  <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.menu.dish.index', trans('menus.menu_manage.dish')) !!}</li>
    <li>{!! link_to_route('admin.menu.dish.create', trans('menu_backend.nemu_dish_create')) !!}</li>
 
 @endsection
 
 @section('content')
  

	{!! Form::open(['method'=>'POST','action'=>'Backend\Menu\DishController@store','class'=>'form-horizontal']) !!}
		
		@include('backend.pages.menu.dish.form',['submitButtonText'=>'Add Dish'])
			
	{!! Form::close() !!}
  

	
  
@endsection





 