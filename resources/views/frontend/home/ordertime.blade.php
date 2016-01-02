@extends('frontend.master')

@section('css.style')
<style type="text/css">

.aspn{
width:100%;
}

</style>

@endsection

@section('jscript')

@endsection

@section('content')


<div id="ordertime-container">

<div class="starter text-center">
<h4>{{ trans('front_home.when_to_order') }}</h4>
<p>{{ trans('front_home.currently_close') }}</p>
<p><a class="btn btn-primary btn-lg aspn" href="#" role="button">{{ trans('front_home.asap') }}</a></p>

<button class="btn btn-primary btn-lg aspn" type="button">
{{ trans('front_home.asap') }}
</button>

<p>Order Date</p>

{!! Form::select('date',$date, null,['class'=>'form-control aspn']) !!}


<p>Order Time</p>
{!! Form::select('ordertime',$time, null,['class'=>'form-control aspn']) !!}


<!-- Previous/Next buttons -->
<div class="form-group">
<!-- Previous/Next buttons -->
  <ul class="pager wizard">
  	<li class="previous"><a href="/">Previous</a></li>
  	<li class="next">
  	<!--  <button type="submit" class="btn-link">Next</button>  -->
	<a id="nextpage" href="#">Next</a>
  	
  	</li>
  </ul>
   
  </div>



@endsection


@section('scripts.footer')

<!-- <script src="/js/ordertime.js"></script> -->

<!-- <script src="/js/gtm.js"></script> -->

<script type="text/javascript">
$("#date").change(function() {
    var date = $(this).find(":selected").val();
    var request = $.ajax({
    	headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
        type: 'POST',
        url: '/home/pickup/ordertime',
        data: {'date':date}
    });
    request.done(function(data){
//         var option = ["", "--- Select Time ---"];
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
</script>

@endsection