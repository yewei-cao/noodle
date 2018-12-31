@if ($errors->any())
    <div class="content_message">
    <div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @foreach ($errors->all() as $error)
            {!! $error !!}<br/>
        @endforeach
    </div>
    </div>
    
@elseif (Session::get('top_success'))
<div class="content_message">
    <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        @if(is_array(json_decode(Session::get('top_success'),true)))
            {!! implode('', Session::get('top_success')->all(':message<br/>')) !!}
        @else
            {!! Session::get('top_success') !!}
        @endif
    </div>
</div>
    
@elseif (Session::get('flash_warning'))
<div class="content_message">
    <div class="alert alert-warning">
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
    <div class="alert alert-danger" role="alert">
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
	type: "success",
	timer: 2000,
	showConfirmButton: false
	});
</script>

@endif


@if(Session::has('flash_notification.message'))
<script type="text/javascript">
swal(
		title: "{{ session('flash_notification.title') }}",   
		text: "{{ session('flash_notification.message') }}",
		type: "Success",
)
</script>
@endif

@if (Session::has('flash_adv'))
<script type="text/javascript">

swal({   title: "{{ session('flash_adv.title') }}",   
	text: "{{ session('flash_adv.message') }}",
// 	imageUrl: "images/home/delivery_food.png",
	imageUrl: "images/home/2019.jpg",
	imageSize:"360x240",
	showConfirmButton: true 
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
