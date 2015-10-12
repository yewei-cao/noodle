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



