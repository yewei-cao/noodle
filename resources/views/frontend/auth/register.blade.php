@extends('frontend.master')

@section('content')
<div id="detail-container">

	<form class="form-horizontal" role="form" method="POST" action="/auth/register" data-toggle="validator">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="form-group has-feedback">
			{!! Form::label('name','Name',['class'=>'control-label','for'=>'inputName']) !!}
			{!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Name','data-error'=>'Please enter your name','required']) !!}
			 <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
			
		<div class="form-group has-feedback">
			{!! Form::label('phone','Phone',['class'=>'control-label']) !!}
			{!! Form::text('phone', null,['class'=>'form-control','placeholder'=>'Phone','pattern'=>'^(?!64)\d{9,11}$','maxlength'=>'11','data-error'=>'The phone number is invalid','required']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>	
		
		<div class="form-group has-feedback">
			{!! Form::label('email','Email',['class'=>'control-label']) !!}
			{!! Form::input('email','email', null,['class'=>'form-control','id'=>'inputEmail','placeholder'=>'Email','data-error'=>'The email address is invalid','required']) !!}
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
		
		
		<div class="form-group has-feedback">
			{!! Form::label('password','Password',['class'=>'control-label','for'=>'inputName']) !!}
			{!! Form::password('password', ['class'=>'form-control','placeholder'=>'At least 8 characters','data-error'=>'Please enter your pasword','required']) !!} 
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
		
		<div class="form-group has-feedback">
			{!! Form::label('confirmpassword','Confirm Password',['class'=>'control-label','for'=>'inputName']) !!}
			{!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'At least 8 characters','data-error'=>'Please enter your confirm pasword','required']) !!} 
			<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
			<div class="help-block with-errors"></div>
		</div>
		
		
		<div class="form-group">

			<ul class="pager wizard">
			  	<li class="previous"><a href="/">{{ trans('front_home.cancel') }}</a></li>
			  	<li class="next">
				<button class="redbtn next" type="submit" >{{ trans('front_home.register') }}</button>
			  	</li>
			</ul>
		   
		</div>

<!-- 		<div class="form-group"> -->
<!-- 			<label class="col-md-4 control-label">Name</label> -->
<!-- 			<div class="col-md-6"> -->
<!-- 				<input type="text" class="form-control" name="name" value="{{ old('name') }}"> -->
<!-- 			</div> -->
<!-- 		</div> -->

<!-- 		<div class="form-group"> -->
<!-- 			<label class="col-md-4 control-label">E-Mail Address</label> -->
<!-- 			<div class="col-md-6"> -->
<!-- 				<input type="email" class="form-control" name="email" value="{{ old('email') }}"> -->
<!-- 			</div> -->
<!-- 		</div> -->

<!-- 		<div class="form-group"> -->
<!-- 			<label class="col-md-4 control-label">Password</label> -->
<!-- 			<div class="col-md-6"> -->
<!-- 				<input type="password" class="form-control" name="password"> -->
<!-- 			</div> -->
<!-- 		</div> -->

<!-- 		<div class="form-group"> -->
<!-- 			<label class="col-md-4 control-label">Confirm Password</label> -->
<!-- 			<div class="col-md-6"> -->
<!-- 				<input type="password" class="form-control" name="password_confirmation"> -->
<!-- 			</div> -->
<!-- 		</div> -->

<!-- 		<div class="form-group"> -->
<!-- 			<div class="col-md-6 col-md-offset-4"> -->
<!-- 				<button type="submit" class="btn btn-primary"> -->
<!-- 					Register -->
<!-- 				</button> -->
<!-- 			</div> -->
<!-- 		</div> -->
		
	</form>
</div>
@endsection


@section('scripts.footer')
<script src="/js/validate.js"></script>

@endsection
