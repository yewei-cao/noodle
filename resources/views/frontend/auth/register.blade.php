@extends('frontend.master')

@section('content')
<div class="detail-container">

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
			<div class="detail-container pager">
				<button class="redbtn btn-lg longbutton text-center"  type="submit">
						{{ trans('front_home.register') }}
				</button>
			</div>
			
			<div class="detail-container pager">
				<div class="previousbtn btn-lg longbutton text-center" >
					<a href="{{ URL::previous() }}" >
							{{ trans('front_home.cancel') }}
					</a>
				</div>
			</div>
		</div>

	</form>
</div>
@endsection


@section('scripts.footer')
<script src="/js/validate.js"></script>

@endsection
