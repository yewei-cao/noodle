@if ($errors->any())
    <div class="content_message">
    <div class="alert_message alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
    </div>
    
@elseif (Session::get('flash_warning'))
<div class="content_message">
    <div class="alert_message alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @if(is_array(json_decode(Session::get('flash_warning'),true)))
            {!! implode('', Session::get('flash_warning')->all(':message<br/>')) !!}
        @else
            {!! Session::get('flash_warning') !!}
        @endif
    </div>
    </div>

@elseif (Session::get('flash_danger'))
<div class="content_message">
    <div class="alert_message alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @if(is_array(json_decode(Session::get('flash_danger'),true)))
            {!! implode('', Session::get('flash_danger')->all(':message<br/>')) !!}
        @else
            {!! Session::get('flash_danger') !!}
        @endif
    </div>
    </div>
    
    
@elseif (Session::get('flash_success'))
<script type="text/javascript">

swal({   title: "Success",   
	text: "{{  Session::get('flash_success') }}",
	type: "info",
	timer: 1500,   
	showConfirmButton: false 
	});
</script>

@endif

@if (Session::has('flash_notification.message'))
<script type="text/javascript">

swal({   title: "{{ session('flash_notification.title') }}",   
	text: "{{ session('flash_notification.message') }}",
	type: "{{ session('flash_notification.type') }}",
	timer: 1500,   
	showConfirmButton: false 
	});
</script>
	
@endif


@if (Session::has('flash_notification_overlay.message'))
<script type="text/javascript">

swal({   title: "{{ session('flash_notification_overlay.title') }}",   
	text: "{{ session('flash_notification_overlay.message') }}",
	type: "{{ session('flash_notification_overlay.type') }}",
	confirmButtonText: 'Okay'
	});
</script>
	
@endif
