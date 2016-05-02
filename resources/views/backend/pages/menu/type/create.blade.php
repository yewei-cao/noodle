 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_type_list') }}
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::open(['method'=>'POST','action'=>'Backend\Menu\TypeController@store','class'=>'form-horizontal']) !!}
		
		@include('backend.pages.menu.type.form',['submitButtonText'=>'Add Type'])
			
	{!! Form::close() !!}
  
  
  
@endsection