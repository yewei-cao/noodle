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
		if(!$shop->printer){
			return false;
		}
		$orderInfo = '';
		$orderInfo .= 'Welcome to Noodle Canteen Taradale<BR>';
		$orderInfo .= '<C>GST: No# 104-299-733</C><BR>';
		$orderInfo .= '<C>Tax Invoice</C><BR>';
		$orderInfo .= '<CB>Your Order Numbers is '.$order->id.'</CB><BR>';
		$orderInfo .= '<C>Ph: '.$shop->phone.'</C><BR>';
		$orderInfo .= '--------------------------------<BR>';
		$orderInfo .= 'Order Details <BR>';
		$orderInfo .= 'Name:               '.$order->name.'<BR>';
		$orderInfo .= 'Phone number:<B>'.$order->phonenumber.'</B><BR>';
		
		if($order->paymentflag==2){
			$orderInfo .= 'Due Time:  '.$order->paymenttime().'<BR>';
		}
		
		$orderInfo .= 'Order Type:           '.$order->ordertype.'<BR>';
		$orderInfo .= 'Order Payment:  <B>'.$order->payment().'</B><BR>';
		$orderInfo .= 'Pay by:                '.$order->paymentmethod().'<BR>';
		$orderInfo .= 'Shipping Time:<B>'.$order->shiptimeformat().'</B><BR>';
		$orderInfo .= '--------------------------------<BR>';
		$orderInfo .= 'Dishes:                    Total<BR>';
		
		foreach($order->orderitems as $item){
			$itemstring = $item->amount.'X'.$item->dishes->number.' '.$item->dishes->name;
			$orderInfo .= $itemstring;
			if(strlen($itemstring)>24){
				$orderInfo .= '<BR><RIGHT>'.$item->total.'</RIGHT><BR>';
			}else{
				$length_itemstring = 31-strlen($itemstring)-strlen($item->total);
				for($i=0;$i<$length_itemstring;$i++){
					$orderInfo .=' ';
				}
				$orderInfo .=$item->total.'<BR>';
			}
// 			$orderInfo .= $item->amount.'X'.$item->dishes->number.' '.$item->dishes->name.'        '.$item->total.'<BR>';
			if($item->flavour){
				$orderInfo .= " ******".$item->flavour.'<BR>';
			}
			
			if($item->selectspecial){
				$orderInfo .= " ******".$item->selectedname().'<BR>';
			}
			foreach($item->takeout as $material){
				$orderInfo .= ' ------no  '.$material->name.'<BR>';
			}
			foreach($item->extra as $material){
				$orderInfo .= ' ++++++extra  '.$material->name.'   $'.$material->price.'<BR>';
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
			$orderInfo .= ' <B>'.$order->address->address.' '.$order->address->suburb.' '.$order->address->city.'</B><BR>';
		}
		
		$orderInfo .='Thank you for choosing Noodle <BR>';
		$orderInfo .='Dishes. We believe you will be <BR>';
		$orderInfo .='satisfied by our services.<BR>';
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
	 *  鏂规硶1
	 鎷煎噾璁㈠崟鍐呭鏃跺彲鍙傝�冨涓嬫牸寮�
	 鏍规嵁鎵撳嵃绾稿紶鐨勫搴︼紝鑷璋冩暣鍐呭鐨勬牸寮忥紝鍙弬鑰冧笅闈㈢殑鏍蜂緥鏍煎紡
	 */
	public function wp_print($orderInfo){
	
		$content = array(
				'user'=>$this->user,
				'stime'=>$this->stime,
				'sig'=>$this->sig,
				'apiname'=>'Open_printMsg',
	
				'sn'=>$this->printer_sn,
				'content'=>$orderInfo,
				'times'=>1//鎵撳嵃娆℃暟
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
	 *  鏂规硶2
	 鏍规嵁璁㈠崟绱㈠紩,鍘绘煡璇㈣鍗曟槸鍚︽墦鍗版垚鍔�,璁㈠崟绱㈠紩鐢辨柟娉�1杩斿洖
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
	 *  鏂规硶4
	 鏌ヨ鎵撳嵃鏈虹殑鐘舵��
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