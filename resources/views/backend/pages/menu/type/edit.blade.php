 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_type_list') }}
Edit
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::model($type,['method'=>'PATCH','action'=>['Backend\Menu\TypeController@update',$type->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.menu.type.form',['submitButtonText'=>'Update Type'])
			
	{!! Form::close() !!}

  
@endsection