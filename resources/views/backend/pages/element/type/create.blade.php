 @extends('backend.admin_master') 
 
@section('page-header')
<div class="page-header">
 <h1>
{{ trans('element_backend.create') }}
<small></small>

</h1>
</div>
 @endsection
 

 @section('breadcrumbs')
 
  <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.element.type.index', trans('menus.element_manage.material_type')) !!}</li>
    <li>{!! link_to_route('admin.element.type.create', trans('element_backend.create')) !!}</li>
 
 @endsection
 
 @section('content')
  
	{!! Form::open(['method'=>'POST','action'=>'Backend\Element\Material_typeController@store','class'=>'form-horizontal']) !!}
		
		@include('backend.pages.element.type.form',['submitButtonText'=>'Add Catalogue'])
			
	{!! Form::close() !!}
  
  
@endsection
 
 