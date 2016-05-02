 @extends('backend.admin_master') 
 
@section('page-header')
<div class="page-header">
 <h1>
{{ trans('element_backend.create') }}
<small></small>

</h1>
</div>
 @endsection
 
@section('content')
  
	{!! Form::model($type,['method'=>'PATCH','action'=>['Backend\Element\Material_typeController@update',$type->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.element.type.form',['submitButtonText'=>'Update Catalogue'])
			
	{!! Form::close() !!}

  
@endsection