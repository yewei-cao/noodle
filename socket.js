var server = require('http').Server();

var io = require('socket.io')(server);

var Redis = require('ioredis');

var redis = new Redis();

redis.subscribe('order_printer-channel');

redis.subscribe('order_receipt-channel');

redis.subscribe('dashboard_order-channel');

redis.subscribe('order_process-channel');

redis.on('message', function(channel, message) {

	message = JSON.parse(message);

	console.log(channel, message);
//	console.log(message);
	io.emit(channel + ':' + message.event, message.data);
});

server.listen(3000);
