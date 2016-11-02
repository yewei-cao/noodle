@extends('frontend.master')

@section('css.style')

<link href="/css/printtest.css" rel="stylesheet"type="text/css" media="print"/>

@endsection

@section('content')


<div class="mydiv">
<p>
something fro print.
</p>

<div class="widget-toolbar hidden-480">
	<a href="#"> 
	 <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
	</a>
</div>


</div>

@endsection

@section('scripts.footer')
<script src="/js/printer/jquery-migrate-1.1.0.js"></script>
<script src="/js/printer/jquery.jqprint-0.3.js"></script>
<script language="javascript">

$(document).on("click", ".glyphicon-print" , function() {
	 $(".mydiv").jqprint({debug: false,importCSS: true,printContainer: true,operaSupport: true});
});

</script>


@endsection 
