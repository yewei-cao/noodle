 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_printer') }}
</h1>
 
 @endsection
 
 
 @section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			
			{{$printer }}
		</div>
		<!-- /.box -->
	</div>
</div>


@endsection
