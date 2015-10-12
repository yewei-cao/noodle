@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
    
@elseif (Session::get('flash_warning'))
    <div class="alert alert-warning">
        @if(is_array(json_decode(Session::get('flash_warning'),true)))
            {!! implode('', Session::get('flash_warning')->all(':message<br/>')) !!}
        @else
            {!! Session::get('flash_warning') !!}
        @endif
    </div>

@elseif (Session::get('flash_danger'))
    <div class="alert alert-danger">
        @if(is_array(json_decode(Session::get('flash_danger'),true)))
            {!! implode('', Session::get('flash_danger')->all(':message<br/>')) !!}
        @else
            {!! Session::get('flash_danger') !!}
        @endif
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
