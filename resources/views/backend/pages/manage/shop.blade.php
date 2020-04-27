 @extends('backend.admin_master') 
 
@section('backend.css')
<link href="{{ asset('weekline/cleanslate.css') }}" rel="stylesheet" type= "text/css" />
<link href="{{ asset('weekline/jquery.weekLine-dark.css') }}" rel="stylesheet" type= "text/css" />
@endsection

@section('backend.js')
<script src="{{ asset('weekline/jquery.weekLine.min.js') }}" type="text/javascript"></script>
@endsection

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
			{!! Form::label('address', trans('menu_backend.manage_edit.address'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('address', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Address']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('phone', trans('menu_backend.manage_edit.phone'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('phone', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Phone']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('distancefee',trans('menu_backend.manage_edit.distancefee'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('distancefee', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('maxfree',trans('menu_backend.manage_edit.maxfree'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('maxfree', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
			</div>
		</div>
		
		
		<div class="form-group">
			{!! Form::label('freedelivery',trans('menu_backend.manage_edit.freedelivery'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('freedelivery', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('googleapi',trans('menu_backend.manage_edit.googleapi'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('googleapi', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'GOOGLE Map API']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('meta', trans('menu_backend.manage_edit.meta'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::textarea('meta', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Meta']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('openhours', trans('menu_backend.manage_edit.openhours'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::textarea('openhours', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Open Hours']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('showtext', trans('menu_backend.manage_edit.showtext'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::textarea('showtext', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Head Text']) !!}
			</div>
		</div>
		
		
		<div class="form-group">
			{!! Form::label('popup',trans('menu_backend.manage_edit.popup'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('popup', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('popuptext', trans('menu_backend.manage_edit.popuptext'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::textarea('popuptext', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Popup Text']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('printer',trans('menu_backend.manage_edit.printer'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('printer', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
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
			{!! Form::label('poliapi',trans('menu_backend.manage_edit.poliapi'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('poliapi', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'POLi API']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('coupon',trans('menu_backend.manage_edit.coupon'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('coupon', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('email_coupon',trans('menu_backend.manage_edit.email_coupon'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				<label>
					{!! Form::checkbox('email_coupon', '1', true,['class'=>'ace ace-switch ace-switch-2']) !!}
					<span class="lbl"></span>
				</label>
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('coupon_value',trans('menu_backend.manage_edit.coupon_value'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('coupon_value', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('coupon_condition',trans('menu_backend.manage_edit.coupon_condition'),['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('coupon_condition', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'$$$']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('coupon_maxamount','Max coupon amount',['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('coupon_maxamount', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Number']) !!}
			</div>
		</div>
		
		<div class="form-group">
			{!! Form::label('coupon_maxvalue','Max coupon value',['class'=>'col-sm-3 control-label no-padding-right']) !!}
			<div class="col-sm-9">
				{!! Form::text('coupon_maxvalue', null,['class'=>'col-xs-10 col-sm-5','placeholder'=>'Number']) !!}
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
				<span id="weekCal" class="weekDays"></span>
				{!! Form::hidden('dayoff', null,['class'=>'col-xs-10 col-sm-5','id'=>'selectedDays','placeholder'=>'Day Off']) !!}
			</div>
		</div>
		
		<div class="clearfix form-actions">
			<div class="col-md-offset-3 col-md-9">
				{!! Form::submit('Submit',['class'=>'btn btn-primary']) !!}
			</div>
		</div>
			
	{!! Form::close() !!}
  
@endsection

@section('backend.scripts.footer')
<script type="text/javascript">
(function($) {
	 
	 var weekCal = $("#weekCal").weekLine({
	        onChange: function () {
	                $("#selectedDays").val(
	                        $(this).weekLine('getSelected', 'indexes')
	                );
	        }
	 });

	 weekCal.weekLine("setSelected", '{{ $shop->dayoff}}'); 

}(jQuery));
</script>
@endsection