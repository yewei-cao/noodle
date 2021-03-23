define(["jquery","orderTimeUrls","common/validation","validationRules","isResponsive","bootstrap","jqueryVal"
,"common/jquery.inlineError"],function(e,t,n,r,i){"use strict";function s(n,r){e.ajax({type:"POST",url
:t.GetOrderTimes+"?storeId="+n+"&orderDate="+r,success:function(t){o(t.Times),e("#order_time_select")
.valid()}})}function o(t){var n=e("#order_time_select");
n.empty(),e.each(t,function(t,r){
	var i=e("<option></option>").attr("value",r.Value).text(r.Text);
	n.append(i)})
	}function a(t,n){e(t).siblings(".inline-error").remove
(),e(t).inlineError(n)}e("#order_date_select").change(function(){e("#order_date_select").valid(),s(e("#store_number"
).val(),e(this).val())});
var u=e("#order_form").validate({errorClass:"error",validClass:"validated",rules
:{orderDate:{required:r.order_date.required},orderTime:{required:r.order_time.required}},highlight:function(
t,n,r){e(t).parents(".field-container").addClass(n).removeClass(r)},unhighlight:function(t,n,r){e(t).
parents(".field-container").addClass(r).removeClass(n)},errorPlacement:function(e,t){return!0}});
return e
("#order_time_select").change(function(){e("#order_time_select").valid()}),e("#start-order-button").click
(function(){
	if(i===!0)
	e("#order_time_select").valid()==0&&a("#order_time_select",r.order_time.message
),e("#order_date_select").valid()==0&&a("#order_date_select",r.order_date.message);
else{var t=[];
e("#order_time_select"
).valid()==0&&t.push(r.order_time.message),e("#order_date_select").valid()==0&&t.push(r.order_date.message
),t.length>0&&n.showValidationDialog(t)}e(".lt-ie8").length>0&&e("#order_form").submit()}),e("#order_form"
).valid(),{init:function(){t.ThuisbezorgdUrl!=""&&(e("#thuisbezorg-dialog").modal({show:!0,backdrop:"static"
,keyboard:!0}),e("#thuisbezorg-dialog").on("shown shown.bs.modal",function(){e("#thuisbezorg-dialog")
.focus()}),e("#continue-link").click(function(){e("#thuisbezorg-dialog").modal("hide")}))}}})
//# sourceMappingURL=ordertime.js.map
