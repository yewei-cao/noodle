<?php
namespace App\Repositories\Prints;

use App\Models\Order\Orders;
use App\Models\Shop\Shops;

class Printer{
	
	protected $user;
	protected $ukey;
	protected $ip;
	protected $port;
	protected $hostname;
	protected $stime;
	protected $sig;
	protected $printer_sn;
	
	public function __construct(){
		$this->user = 'yeweicao@gmail.com';
		$this->ukey = 'MrZFP3XDVsuwFvqT';
		$this->printer_sn = '716500460';
		$this->ip = 'api.feieyun.cn';
		$this->port = 80;
		$this->hostname = '/Api/Open/';
		$this->stime = time();
		$this->sig = sha1($this->user.$this->ukey.$this->stime);
	}
	
	public function print_order(Orders $order,Shops $shop){
		$orderInfo = '';
		$orderInfo .= 'Welcome to Noodle Canteen Taradale<BR>';
		$orderInfo .= '<C>GST: No# 104-299-733</C><BR>';
		$orderInfo .= '<C>Tax Invoice</C><BR>';
		$orderInfo = '<CB>Your Order Numbers is '.$order->id.'</CB><BR>';
		$orderInfo .= '<C>Ph: '.$shop->phone.'</C><BR>';
		$orderInfo .= '--------------------------------<BR>';
		$orderInfo .= 'Order Details <BR>';
		$orderInfo .= 'Name:               '.$order->name.'<BR>';
		
		if($order->paymentflag==2){
			$orderInfo .= 'Due Time:  '.$order->paymenttime().'<BR>';
		}
		
		$orderInfo .= 'Order Type:           '.$order->ordertype.'<BR>';
		$orderInfo .= 'Order Payment:         '.$order->payment().'<BR>';
		$orderInfo .= 'Pay by:                '.$order->paymentmethod().'<BR>';
		$orderInfo .= 'Shipping Time:  '.$order->shiptimeformat().'<BR>';
		$orderInfo .= '--------------------------------<BR>';
		$orderInfo .= 'Dishes:                    Total<BR>';
		
		foreach($order->orderitems as $item){
			$orderInfo .= $item->amount.'X'.$item->dishes->number.' '.$item->dishes->name.'           '.$item->total.'<BR>';
			if($item->flavour){
				$orderInfo .= " ".$item->flavour.'<BR>';
			}
			foreach($item->takeout as $material){
				$orderInfo .= ' no  '.$material->name.'<BR>';
			}
			foreach($item->extra as $material){
				$orderInfo .= ' extra  '.$material->name.'                   $'.$material->price.'<BR>';
			}
		}
		
		if($order->address()->count()){
			$orderInfo .= '--------------------------------<BR>';
			
			$orderInfo .= 'Delivery Fee:     $'.$order->address->fee.'<BR>';
		}
		$orderInfo .= '--------------------------------<BR>';
		
		$orderInfo .= '<RIGHT>Total amount :$'.$order->totaldue.'</RIGHT><BR>';
		
		$orderInfo .= '--------------------------------<BR>';
		$orderInfo .= 'Message: <BR>';
		$orderInfo .= '         '.$order->message.'<BR>';
		
		$orderInfo .= '--------------------------------<BR>';
		if($order->address()->count()){
			$orderInfo .= 'Address: <BR>';
			$orderInfo .= '   '.$order->address->address.' '.$order->address->suburb.' '.$order->address->city.'<BR>';
		}
		
		$orderInfo .='<C>Thank you for choosing Noodle Dishes. We believe you will be satisfied by our services.</C><BR>';
// 		$orderInfo .= '--------------------------------<BR>';
// 		$orderInfo .= '<QR>http://www.noodletaradale.co.nz</QR>';
		
		$result =  json_decode($this->wp_print($orderInfo), true);
		
// 		return $result;
		if($result['msg'] =='ok'){
			if ($order->status ==1){
				$order->status =2;
				$order->save();
			}
			return true;
		}
		return false;
	}
	
	/*
	 *  方法1
	 拼凑订单内容时可参考如下格式
	 根据打印纸张的宽度，自行调整内容的格式，可参考下面的样例格式
	 */
	public function wp_print($orderInfo){
	
		$content = array(
				'user'=>$this->user,
				'stime'=>$this->stime,
				'sig'=>$this->sig,
				'apiname'=>'Open_printMsg',
	
				'sn'=>$this->printer_sn,
				'content'=>$orderInfo,
				'times'=>1//打印次数
		);
	
		$client = new HttpClient($this->ip,$this->port);
		if(!$client->post($this->hostname,$content)){
			return 'error';
		}
		else{
			return $client->getContent();
		}
	
	}
	
	/*
	 *  方法2
	 根据订单索引,去查询订单是否打印成功,订单索引由方法1返回
	 */
	public function queryOrderState($index){
		$msgInfo = array(
				'user'=>$this->user,
				'stime'=>$this->stime,
				'sig'=>$this->sig,
				'apiname'=>'Open_queryOrderState',
					
				'orderid'=>$index
		);
	
		$client = new HttpClient($this->ip,$this->port);
		if(!$client->post($this->hostname,$msgInfo)){
			return 'error';
		}
		else{
			return $client->getContent();
		}
	
	}
	
	
	/*
	 *  方法4
	 查询打印机的状态
	 */
	public function queryPrinterStatus(){
	
// 		return $this->ip;
		$msgInfo = array(
				'user'=>$this->user,
				'stime'=>$this->stime,
				'sig'=>$this->sig,
				'debug'=>'nojson',
				'apiname'=>'Open_queryPrinterStatus',
					
				'sn'=>$this->printer_sn
		);
	
		$client = new HttpClient($this->ip,$this->port);
// 		return $client;
		if(!$client->post($this->hostname,$msgInfo)){
			return 'error';
		}
		else{
			return $client->getContent();
		}
	}
	
}