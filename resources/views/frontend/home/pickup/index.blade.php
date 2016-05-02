@extends('frontend.master')

@section('css.style')

<style>


</style>

@endsection

@section('content')


<div id="detail-container">

{!! Form::open(['method'=>'GET','action'=>['Frontend\Home\Pickup\pickupController@pickup_details'],'id'=>'myform','data-toggle'=>'validator'])!!}

	@include('frontend.home.pickup.form')

{!! Form::close() !!}

</div>

@endsection


@section('scripts.footer')
<script src="/js/validate.js"></script>

<script type="text/javascript">

(function($) {
// 	$('#nextpage').on('click',function(e){
// 		$('#myform').trigger('check');
// 	})
	
// 	$('#myform').validator().on('check', function (e) {
// 	  if (e.isDefaultPrevented()) {
// 		  window.event.returnValue=false;
	    // handle the invalid form...
// 	  } else {
	    // everything looks good!
// 		   window.event.returnValue=true;
// 		   $.ajax({
// 				  headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
// 			      url: '/home/pickup/pickup_details',
// 			      type: "POST",
// 			      data: {'name':$('input[name=name]').val(),'phone':$('input[name=phone]').val(), 'email':$('input[name=email]').val(),'remember':$('input[name=remember]').prop('checked')
// 			    },
// 			      success: function(result) {
// 					  alert("Index Page: "+result);
// 	            },
// 	            error: function(result) {
// 	                alert("Data not found");
// 	            }
// 				    });
// 	  }
// 	})
	
}(jQuery));

</script>

@endsection
