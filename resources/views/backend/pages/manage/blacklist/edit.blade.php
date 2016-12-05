 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_blacklist_list') }}
Edit
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::model($blacklist,['method'=>'PATCH','action'=>['Backend\Manage\BlacklistController@update',$blacklist->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.manage.blacklist.form',['submitButtonText'=>'Update Blacklist'])
			
	{!! Form::close() !!}

  
@endsection