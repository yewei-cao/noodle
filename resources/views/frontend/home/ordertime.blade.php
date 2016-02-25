@extends('frontend.master')

@section('css.style')
<style type="text/css">

</style>

@endsection

@section('jscript')

@endsection

@section('content')


<div id="ordertime-container">

{!! Form::open(['method'=>'GET','action'=>'Frontend\Home\Pickup\pickupController@details','id'=>'myform','data-toggle'=>'validator'])!!}
	
	
<div class="starter text-center">
<h4>{{ trans('front_home.when_to_order') }}</h4>
<p>{{ trans('front_home.currently_close') }}</p>


<button class="btn-primary btn-lg aspn" id="asap" type="button">
{{ trans('front_home.asap') }}
</button>

<h2>OR</h2>

</div>

<div class="form-group has-feedback">
{!! Form::label('orderdate','Order Date',['class'=>'control-label panel-title','for'=>'inputdate']) !!}

{!! Form::select('orderdate',$date, null,['class'=>'form-control aspntime','id'=>'date','required','data-error'=>'Order date not selected']) !!}
 <span class="glyphicon form-control-feedback form-control-feedback_select" aria-hidden="true" ></span>
	<div class="help-block with-errors"></div>
</div>

<div class="form-group has-feedback">
{!! Form::label('ordertime','Order Time',['class'=>'control-label panel-title','for'=>'inputtime']) !!}

{!! Form::select('ordertime',$time, null,['class'=>'form-control aspntime','id'=>'ordertime','required','data-error'=>'Order times not selected']) !!}
 <span class="glyphicon form-control-feedback form-control-feedback_select" aria-hidden="true"></span>
	<div class="help-block with-errors"></div>
	{!! Form::hidden('nowtimestamp', $nowtimestamp, array('id' => 'nowtime' )) !!}
</div>

<!-- Previous/Next buttons -->
<div class="form-group">
<!-- Previous/Next buttons -->
  <ul class="pager wizard">
  	<li class="previous"><a href="{{ url('home/pickup') }}">{{ trans('front_home.previous') }}</a></li>
  	<li class="next">
	<a id="nextpage" href="{{ url('home/menu') }}" >{{ trans('front_home.next') }}</a>
  	<!-- {{ url('home/menu') }} -->
  	</li>
  </ul>
   
  </div>
  
  {!! Form::close() !!}
  
  </div>

@endsection


@section('scripts.footer')

<script src="/js/validate.js"></script>

<script type="text/javascript">
(function($) {

	$("#date").change(function() {
    var date = $(this).find(":selected").val();
    var request = $.ajax({
    	headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
        type: 'POST',
        url: '/home/pickup/saveordertime',
        data: {'date':date}
    });
    request.done(function(data){
        $("#ordertime").empty();
        
        $("#ordertime").append(
                $("<option></option>").attr(
                    "value", "").text("--- Select Time ---")
            );  
        
        for( var i in data) {
        	 $("#ordertime").append(
                     $("<option></option>").attr(
                         "value", data[i][0]).text(data[i][1])
                 );  
        }
    });
});

$('#asap').click(function(){
	$.ajax({
		  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
	      url: '/home/pickup/saveordertime',
	      type: 'POST',
	      data: {'ordertime':$('input[name=nowtimestamp]').val()
	    },
	      success: function(result) {
	    	  window.location.href="{{ url('home/menu') }}";
		  },
		  error: function(result) {
		      alert("Data not found");
		  }
	    });
// 	window.location.href="{{ url('home/menu') }}";
// 	window.location.href="{{ url('home/productmenu') }}";
});

$('#nextpage').on('click',function(e){
	$('#myform').trigger('check');
})

$('#myform').validator().on('check', function (e) {
		  if (e.isDefaultPrevented()) {
			  window.event.returnValue=false;
		    // handle the invalid form...
		  } else {
		    // everything looks good!
			   window.event.returnValue=true;
			   $.ajax({
					  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
				      url: '/home/pickup/saveordertime',
				      type: 'POST',
				      data: {'orderdate':$('select[name=orderdate]').val(),'ordertime':$('select[name=ordertime]').val()
				    },
				      success: function(result) {
				    	  window.location.href="{{ url('home/menu') }}";
					  },
					  error: function(result) {
					      alert("Data not found");
					  }
					  });
		  }
})

}(jQuery));

</script>

@endsection