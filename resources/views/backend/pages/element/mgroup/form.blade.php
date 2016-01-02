
	
<div class="form-group">

{!! Form::label('name','Group Name',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('name', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Name']) !!}
	</div>

</div>

<div class="form-group">
	{!! Form::label('description','Description',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
			{!! Form::textarea('description', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Description']) !!}
	</div>
</div>



<div class="form-group">
	{!! Form::label('materials','Materials',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
			
			  @if (count($materials))
             	 @foreach ($materials as $perm)
                 	<div class="col-lg-3">
                 		<ul style="margin:0;padding:0;list-style:none;">
                 			 @foreach ($perm as $p)
                 			 
                 			 @if($submitButtonText == "Add Group")
                 			 	<li><input type="checkbox" value="{{$p['id']}}" name="materials[]"  id="material-{{$p['id']}}" /> <label for="material-{{$p['id']}}">
                 			 	
							 @else
							 	<li><input type="checkbox" value="{{$p['id']}}" name="materials[]"  {{in_array($p['id'], $mgroup_materials) ? 'checked' : ""}} id="material-{{$p['id']}}" /> <label for="material-{{$p['id']}}">
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