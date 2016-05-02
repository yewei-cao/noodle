 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_material_list') }}
Edit
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::model($material,['method'=>'PATCH','action'=>['Backend\Element\MaterialController@update',$material->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.element.material.form',['submitButtonText'=>'Update Material'])
			
	{!! Form::close() !!}

  
@endsection