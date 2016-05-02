 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_catalogue_list') }}
<small></small>

</h1>
 @endsection
 
 @section('content')
  
	{!! Form::open(['method'=>'POST','action'=>'Backend\Menu\CataloguesController@store','class'=>'form-horizontal']) !!}
		
		@include('backend.pages.menu.catalogue.form',['submitButtonText'=>'Add Catalogue'])
			
	{!! Form::close() !!}
  
  
@endsection
 
 