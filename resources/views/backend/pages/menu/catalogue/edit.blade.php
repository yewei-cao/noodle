 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_catalogue_list') }}
Edit
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::model($catalogue,['method'=>'PATCH','action'=>['Backend\Menu\CataloguesController@update',$catalogue->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.menu.catalogue.form',['submitButtonText'=>'Update Catalogue'])
			
	{!! Form::close() !!}

  
@endsection