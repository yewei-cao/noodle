 @extends('backend.admin_master')
 
@section('meta')
<meta name="_token" content="{{ csrf_token() }}">
@endsection
 
 @section('backend.css')
 <style type="text/css">
 .row .col-3, .row .col-9 {
    float: left;
    padding: 0 2px 0 3px;
}
 .row .col-9 {
    width: 75%;
    float: left;
}
.row .col-3 {
    width: 25%;
    float: left;
}
.row .col-6{
	width: 50%;
	float: left;
}

.row .col-4{
	width: 33%;
	float: left;
}

.basket .basket-body .add-product, .basket-body .row .description {
    font: normal normal normal 12px/14px droid_sans,sans-serif;
}

.basket-body .row .description {
    font-weight: 700;
    font-size: 12px;
    letter-spacing: .05em;
    line-height: 1.3;
}

.box-body.box-warning {
  border: 1px solid #f39c12;
}

.box hr {
  margin: 0px;
}
.box-triger .box-collapse{
display: none;
}
 </style>
@endsection


@section('content')

 <div class="row" id="order_boxs">

<div id="ordres">
 	
	
	
	
	 <tr v-for="(order,index) in orders" class="goods-list">
                <td>{{order.id}}</td>
                <td>{{order.name}}</td>
            </tr>
	
</div>	

</div>

@endsection

@section('backend.scripts.footer')
<script src="/js/vue/vue.js"></script>
<script src="/js/socket/socket.io.min.js"></script>

<script type="text/javascript">

var socket=io('{{$_SERVER['SERVER_ADDR']}}:3000');

//vue
new Vue({
  el: '#order_boxs',
  data: {
    orders: []
  },
  ready: function(){
	  socket.on('order_process-channel:App\\Events\\OrdersProcess',function(data){
// 		  console.log(data);
// 		  window.location.reload()
			this.orders.push(data.orders);
// 			var i = 0;
// 			$("#printed").text(data.printed);
  }.bind(this));
  }
});




	
	

	
</script>
@endsection
