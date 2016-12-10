@extends('frontend.master')

@section('css.style')
<style type="text/css">

</style>

@endsection

@section('jscript')
<script type="text/javascript">

</script>
@endsection

@section('content')


<div id="detail-container">

<button class="redbtn next btn-lg aspn" id="asap" type="button">
{{ trans('front_home.asap') }}
</button>

{!! Form::open(['method'=>'GET','action'=>'Frontend\Home\Pickup\pickupController@details','id'=>'myform','data-toggle'=>'validator'])!!}
	
<div class="form-group has-error">

	{!! Form::label('name','Name',['class'=>'control-label','for'=>'inputName']) !!}
	{!! Form::text('name', null,['class'=>'form-control','placeholder'=>'Name','data-error'=>'Please enter your name','required']) !!}
	<div class="help-block with-errors"></div>
</div>

<div class="form-group has-feedback">
	{!! Form::label('phone','Phone',['class'=>'control-label']) !!}
	{!! Form::text('phone', null,['class'=>'form-control','placeholder'=>'Phone','pattern'=>'^(?!64)\d{9,11}$','maxlength'=>'11','data-error'=>'The phone number is invalid','required']) !!}
	<div class="help-block with-errors"></div>
	
</div>	

<div class="form-group">
	{!! Form::label('email','Email',['class'=>'control-label']) !!}
	{!! Form::input('email','email', null,['class'=>'form-control','id'=>'inputEmail','placeholder'=>'Email','id'=>'inputEmail','data-error'=>'The email address is invalid','required']) !!}
	<div class="help-block with-errors"></div>
</div>
		
<div class="form-group">
	<label>
		{!! Form::checkbox('remember', '0', false,['class'=>'ace ace-switch ace-switch-2']) !!}
		<span class="lbl">REMEMBER MY PICKUP DETAILS</span>
	</label>
</div>

<div class="form-group">
<!-- Previous/Next buttons -->
  <ul class="pager wizard">
  	<li class="previous"><a href="/">{{ trans("front_home.previous") }}</a></li>
  	<li class="next">
  	<!--  <button type="submit" class="btn-link">Next</button>  -->
	<a class="redbtn next" id="nextpage" href="pickup/details">{{ trans("front_home.next") }}</a>
  	
  	</li>
  </ul>
   
  </div>


{!! Form::close() !!}

</div>

@endsection


@section('scripts.footer')
<script src="/js/validate.js"></script>

<script type="text/javascript">

// $(document).ready(function() {
	
// 	   $('#nextpage').click(function () {
// 	    alert('jQuery.click()');
// 	    return true;
// 	   });
// });

(function($) {

	$('#nextpage').validator().on('click', function (e) {
		if (e.isDefaultPrevented()) {
		    // handle the invalid form...
		  } else {
		    // everything looks good!

		  $.ajax({
			  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
		      url: '/home/pickup/pickup_details',
		      type: "POST",
		      data: {'name':$('input[name=name]').val(),'phone':$('input[name=phone]').val(), 'email':$('input[name=email]').val(),'remember':$('input[name=remember]').prop('checked')
		    }});
			    
		  }


	})

	
}(jQuery));
	  
// $('#myform').validator().on('submit', function (e) {
// 	  if (e.isDefaultPrevented()) {
// 	    // handle the invalid form...
// 	  } else {
// 	    // everything looks good!
// 	  }
// 	})
</script>

@endsection
