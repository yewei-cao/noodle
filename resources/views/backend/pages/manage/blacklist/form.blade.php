
<div class="form-group">

{!! Form::label('ip','IP',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('ip', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'IP']) !!}
	</div>

</div>

<div class="form-group">

{!! Form::label('reason','Reason',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::textarea('reason', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Reason']) !!}
	</div>

</div>


<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		{!! Form::submit($submitButtonText,['class'=>'btn btn-primary']) !!}
	</div>
</div>

