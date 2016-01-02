<div class="form-group">
{!! Form::label('catalogue_id','Catalogue',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
	<div class="col-sm-2 no-padding-left">
		{!! Form::select('catalogue_id',$catalogue, null,['id'=>'catalogue_list','class'=>'form-control ']) !!}
	</div>
	</div>
	
</div>


<div class="form-group">
{!! Form::label('mgroup_id','Materials Group',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
	<div class="col-sm-2 no-padding-left">
		{!! Form::select('mgroup_id',$group, null,['id'=>'group_list','class'=>'form-control ']) !!}
	</div>
	</div>
	
</div>
	
<div class="form-group">

{!! Form::label('name','Dish Name',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('name', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Name']) !!}
	</div>

</div>

<div class="form-group">

	{!! Form::label('valid','Dish Valid',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">	
		<label>
			{!! Form::checkbox('valid', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
			<span class="lbl"></span>
		</label>
	</div>
	
</div>

<div class="form-group">

{!! Form::label('price','Dish Price',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('price', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
	</div>

</div>

<div class="form-group">
{!! Form::label('description','Dish Description',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
			{!! Form::textarea('description', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Description']) !!}
	</div>
</div>


<div class="form-group">
{!! Form::label('consumptionpoint','Dish Consumption Point',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		{!! Form::text('consumptionpoint', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Point']) !!}
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

	@if($submitButtonText =="Update Dish")
	
		{!! Form::hidden('photo_name', $dish->photo_name, array('id' => 'photo_name' )) !!}
		<div class="col-sm-9">
			@if($dish->photo_thumbnail_path)
			<div class="col-sm-5 no-padding-left">
				<img width="100" id="photo_thumbnail" src="/{{ $dish->photo_thumbnail_path }}" class="img-responsive img-thumbnail" alt="">
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



<div class="form-group">
	{!! Form::label('materials','Materials',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
			
			  @if (count($materials))
             	 @foreach ($materials as $perm)
                 	<div class="col-lg-3">
                 		<ul style="margin:0;padding:0;list-style:none;">
                 			 @foreach ($perm as $p)
                 			 
                 			 @if($submitButtonText == "Add Dish")
                 			 	<li><input type="checkbox" value="{{$p['id']}}" name="materials[]"  id="material-{{$p['id']}}" /> <label for="material-{{$p['id']}}">
                 			 	
							 @else
							 	<li><input type="checkbox" value="{{$p['id']}}" name="materials[]"  {{in_array($p['id'], $dish_materials) ? 'checked' : ""}} id="material-{{$p['id']}}" /> <label for="material-{{$p['id']}}">
							 @endif
                                 	<a style="color:black;text-decoration:none;" data-toggle="tooltip" data-html="true" title="<strong>Discription:</strong> {!!  $p['description'] !!}">{!! $p['name'] !!} <small></small></a>
                  			@endforeach
                          </ul>
                    </div>             
                        
                        
             	@endforeach
                         
              @else
                       No any materials
              @endif
			
			
	</div>
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
    url: '{{ action('Backend\Menu\DishController@uploadphoto') }}',  
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
