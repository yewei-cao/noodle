 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_blacklist_list') }}
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::open(['method'=>'POST','action'=>'Backend\Manage\BlacklistController@store','class'=>'form-horizontal']) !!}
		
		@include('backend.pages.manage.blacklist.form',['submitButtonText'=>'Add Blacklist'])
			
	{!! Form::close() !!}
  
  
  
@endsection