	
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
	{!! Form::input('email','email', null,['class'=>'form-control','id'=>'inputEmail','placeholder'=>'Email','id'=>'inputEmail','data-error'=>'The email address is invalid','required']) !!}
	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	<div class="help-block with-errors"></div>
</div>
		
<div class="form-group">
	<label>
		{!! Form::checkbox('remember', '1', false,['class'=>'ace ace-switch ace-switch-2']) !!}
		<span class="lbl">REMEMBER MY PICKUP DETAILS</span>
	</label>
</div>

<div class="form-group">

	<ul class="pager wizard">
	  	<li class="previous"><a href="/">{{ trans('front_home.previous') }}</a></li>
	  	<li class="next">
	  	<!--  <button type="submit" class="btn-link">Next</button>   -->
		<!-- 	<a id="nextpage" href="{{ url('home/pickup/details') }}">{{ trans('front_home.next') }}</a> -->
		
		<button class="redbtn next" type="submit" >{{ trans('front_home.next') }}</button>
		
	  	</li>
	</ul>
   
  </div>
