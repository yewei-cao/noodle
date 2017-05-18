 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_blacklist_list') }}
Edit
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::model($coupon,['method'=>'PATCH','action'=>['Backend\Manage\CouponConroller@update',$coupon->id],'class'=>'form-horizontal']) !!}
		
		@include('backend.pages.manage.coupon.form',['submitButtonText'=>'Update Coupon'])
			
	{!! Form::close() !!}

  
@endsection