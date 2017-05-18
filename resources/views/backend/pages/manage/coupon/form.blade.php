
<div class="form-group">

{!! Form::label('order','Order',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	
	<div class="col-sm-9">
		{!! Form::text('order', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Order number']) !!}
	</div>

</div>


<div class="form-group">
{!! Form::label('code','Code',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		{!! Form::text('code', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Code']) !!}
	</div>
</div>

<div class="form-group">
{!! Form::label('title','Title',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		{!! Form::text('title', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Title']) !!}
	</div>
</div>


<div class="form-group">
	{!! Form::label('value','Value',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		{!! Form::text('value', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
	</div>
</div>

<div class="form-group">
{!! Form::label('email','Email',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		{!! Form::text('email', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Email']) !!}
	</div>
</div>

<div class="form-group">
	{!! Form::label('used','Used',['class'=>'col-sm-3 control-label no-padding-right']) !!}
	<div class="col-sm-9">
		<label>
			{!! Form::checkbox('used', '1', false,['class'=>'ace ace-switch ace-switch-2']) !!}
			<span class="lbl"></span>
		</label>
	</div>
</div>



<div class="clearfix form-actions">
	<div class="col-md-offset-3 col-md-9">
		{!! Form::submit($submitButtonText,['class'=>'btn btn-primary']) !!}
	</div>
</div>

