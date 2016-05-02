
<div class="form-group">
{!! Form::label('material_type_id','Type',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
	<div class="col-sm-2 no-padding-left">
		{!! Form::select('material_type_id',$type, null,['id'=>'material_type_id','class'=>'form-control ']) !!}
	</div>
	</div>
	
</div>

<div class="form-group">
{!! Form::label('name','Name',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		{!! Form::text('name', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Name']) !!}
	</div>
</div>


<div class="form-group">

	{!! Form::label('valid','Material Valid',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">	
		<label>
			{!! Form::checkbox('valid', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
			<span class="lbl"></span>
		</label>
	</div>
	
</div>


<div class="form-group">

{!! Form::label('price','Material Price',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('price', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
	</div>

</div>


<div class="form-group">
	{!! Form::label('description','Description',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
			{!! Form::textarea('description', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Description']) !!}
	</div>
</div>



<div class="form-group">
	{!! Form::label('photo','Photo',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		<div class="col-sm-5 no-padding-left">
			<div id="dropz" width="100px" height="100px" class="dropzone"></div>  
		</div>
	</div>
</div>	


<div class="form-group">

	{!! Form::label('exhibition','Exhibition',['class'=>'col-sm-3 control-label no-padding-right']) !!}

	@if($submitButtonText =="Update Material")
	
		{!! Form::hidden('photo_name', $material->photo_name, array('id' => 'photo_name' )) !!}
		<div class="col-sm-9">
			@if($material->photo_thumbnail_path)
			<div class="col-sm-5 no-padding-left">
				<img width="100" id="photo_thumbnail" src="/{{ $material->photo_thumbnail_path }}" class="img-responsive img-thumbnail" alt="">
			</div>
			@endif
		</div>

	@else
	<div class="col-sm-9">
		{!! Form::hidden('photo_name', '', array('id' => 'photo_name')) !!}
		<div class="col-sm-5 no-padding-left">
			<img width="100" id="photo_thumbnail" src="" alt="" class="img-responsive img-thumbnail">
		</div>
	</div>
	@endif
	
</div>


<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		{!! Form::submit($submitButtonText,['class'=>'btn btn-primary']) !!}
	</div>
</div>


@section('backend.scripts.footer')
<script src="/js/dropzone.js"></script>
<script type="text/javascript">
Dropzone.autoDiscover = false;
// Dropzone.options.addPhotosForm={
// 	url: '{{ action('Backend\Menu\DishController@create') }}',
// 	paramName: 'photo',	
// 	maxFilesize: 3,
// 	maxFiles: 1,
// 	acceptedFiles: '.jpg, .jpeg, .png, .bmp'
// };

$("#dropz").dropzone({  
    url: '{{ action('Backend\Element\MaterialController@uploadphoto') }}',  
    paramName: 'photo',
    addRemoveLinks: true,  
    dictRemoveLinks: "Remove File",  
    dictCancelUpload: "Cancel Upload",  
    maxFiles: 1,  
    maxFilesize: 3,  
    autoProcessQueue: true, 
    headers: {'X-CSRF-Token': "{{ csrf_token() }}"},
    acceptedFiles: '.jpg, .jpeg, .png, .bmp',
    init: function() {  
        this.on("success", function(file) {  
            console.log("File " + file.name + "uploaded");  
        });  
        this.on("removedfile", function(file) {  
            console.log("File " + file.name + "removed");
            $('#photo_name').val('');
        });  
    },
    success: function(file,response){
        $('#photo_name').val(response);
        $("#photo_thumbnail").attr("src","/images/cache_image/"+response);
    }
});  


$(document).ready(function () {
	$("#price").blur(function(){
		var $input = $(this);
      	var value = $input.val();
		var regularexpression = /^\d+\.?\d*$/;
    	if (!value.match(regularexpression) || value==""){
    		$("#price").val("");
    		$("#price").focus();
    	}
    });

});

</script>

@endsection
 
@section('backend.css')
<link href="/css/dropzone.css" rel="stylesheet" type= "text/css" />
@endsection
