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
  
	{!! Form::model($mgroup,['method'=>'PATCH','action'=>['Backend\Element\MgroupController@update',$mgroup->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.element.mgroup.form',['submitButtonText'=>'Update Group'])
			
	{!! Form::close() !!}

  
@endsection