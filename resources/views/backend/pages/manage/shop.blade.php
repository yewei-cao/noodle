 @extends('backend.admin_master') 
 
 @section('page-header')
<div class="page-header">

 <h1>
{{ trans('menus.manage.shop') }}
Edit
</h1>
</div>
 
@endsection

 @section('breadcrumbs')
 
  <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.manage.index', trans('menus.manage.shop')) !!}</li>
 
@endsection
 
@section('content')
  
	{!! Form::model($shop,['method'=>'PATCH','action'=>['Backend\Manage\ManageController@update',$shop->id],'class'=>'form-horizontal']) !!}
		<div class="form-group">
			{!! Form::label('title', trans('menu_backend.manage_edit.title'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('title', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Title']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('meta', trans('menu_backend.manage_edit.meta'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::textarea('meta', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Meta']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('cash','Cash Valid',['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('cash', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('credit','Credit Valid',['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('credit', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('poli','Poli Valid',['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('poli', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('starttime', trans('menu_backend.manage_edit.starttime'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('starttime', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Start Time']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('closetime', trans('menu_backend.manage_edit.closetime'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('closetime', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Close Time']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('dayoff', trans('menu_backend.manage_edit.dayoff'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('dayoff', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Day Off']) !!}
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
		
			
	{!! Form::close() !!}
  
@endsection