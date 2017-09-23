	
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
	{!! Form::label('address','Address',['class'=>'control-label']) !!}
	{!! Form::input('address','address', null,['class'=>'form-control','id'=>'address','placeholder'=>'Address','data-error'=>'The address is invalid','required']) !!}
	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	<div class="help-block with-errors"></div>
</div>


<div class="form-group has-feedback">
	{!! Form::label('suburb','Suburb / Town',['class'=>'control-label']) !!}
	{!! Form::input('suburb','suburb', null,['class'=>'form-control','id'=>'suburb','placeholder'=>'Suburb','data-error'=>'The suburb is invalid','required']) !!}
	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	<div class="help-block with-errors"></div>
</div>

<div class="form-group has-feedback">
	{!! Form::label('city','City',['class'=>'control-label']) !!}
	{!! Form::input('city','city', 'Napier',['class'=>'form-control','readonly'=>'readonly','id'=>'city','data-error'=>'The city is invalid']) !!}
	<span class="glyphicon form-control-feedback" aria-hidden="true"></span>
	<div class="help-block with-errors"></div>
</div>
		
<div class="form-group">

	<div class="detail-container pager">
		<button class="redbtn btn-lg longbutton text-center"  type="submit">
				{{ trans('front_home.next') }}
		</button>
	</div>
	
	<div class="detail-container pager">
		<div class="previousbtn btn-lg longbutton text-center" >
			<a href="{{ URL::previous() }}" >
					{{ trans('front_home.previous') }}
			</a>
		</div>
	</div>
	
   
 </div>
