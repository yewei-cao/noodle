 @extends('backend.admin_master') 
 
 @section('page-header')
<div class="page-header">

 <h1>
{{ trans('menu_backend.nemu_dish_edit') }}
Edit
</h1>
</div>
 
@endsection

 @section('breadcrumbs')
 
  <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.menu.dish.index', trans('menus.menu_manage.dish')) !!}</li>
    <li>{!! link_to_route('admin.menu.dish.edit', trans('menu_backend.nemu_dish_edit')) !!}</li>
 
 @endsection
 
@section('content')
  
	{!! Form::model($dish,['method'=>'PATCH','action'=>['Backend\Menu\DishController@update',$dish->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.menu.dish.form',['submitButtonText'=>'Update Dish'])
			
	{!! Form::close() !!}
  
@endsection