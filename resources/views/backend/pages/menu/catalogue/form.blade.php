<div class="form-group">
	

{!! Form::label('type_id','Type',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
	<div class="col-sm-2 no-padding-left">
		{!! Form::select('type_id',$type, null,['id'=>'type_list','class'=>'form-control ']) !!}
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
	{!! Form::label('description','Description',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
			{!! Form::text('description', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Description']) !!}
	</div>
</div>


<div class="form-group">

{!! Form::label('ranking','Rank Number',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('ranking', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Number']) !!}
	</div>

</div>

<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		{!! Form::submit($submitButtonText,['class'=>'btn btn-primary']) !!}
	</div>
</div>