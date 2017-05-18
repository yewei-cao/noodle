 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_couponlist') }}
</h1>
 <hr/>
 
@endsection
 
@section('content')
  
	{!! Form::open(['method'=>'POST','action'=>'Backend\Manage\CouponConroller@store','class'=>'form-horizontal']) !!}
		
		@include('backend.pages.manage.coupon.form',['submitButtonText'=>'Add Coupon'])
			
	{!! Form::close() !!}
  
  
  
@endsection