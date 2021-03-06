@extends('frontend.primary')

@section('title')
{{ trans('front_title.ordertime').trans('front_title.title') }}
@endsection

@section('css.style')
<style type="text/css">
</style>
@endsection

@section('content')

<div class="detail-container row-bordered text-center"> 
	<h1 id="page_title">{{ trans('front_home.ordertime') }}</h1>
</div>

<div id="ordertime-container">

{!! Form::open(['method'=>'GET','action'=>'Frontend\Home\Pickup\pickupController@saveordertime','id'=>'myform','data-toggle'=>'validator'])!!}	

<div class="starter text-center">
<h2>{{ trans('front_home.when_to_order') }}</h2>

@if($aspn)
<button class="redbtn next btn-lg aspn" id="asap" type="button">
{{ trans('front_home.asap') }}
</button>
<h2>OR</h2>

@else
<h4>{{ trans('front_home.currently_close') }}</h4>

@endif

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
        url: '/home/pickup/ordertime',
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
	      url: '/home/ordertime/save_asap',
	      type: 'POST',
	      data: {'ordertime':'ASAP'
	    },
	      success: function(result) {
	    	  window.location.href="{{ url('home/menu/noodles') }}";
		  },
		  error: function(result) {
		      alert("Data not found");
		  }
	    });
// 	window.location.href="{{ url('home/menu') }}";
// 	window.location.href="{{ url('home/productmenu') }}";
});


}(jQuery));

</script>

@endsection