<?php

namespace App\Http\Controllers\Frontend\Home\Pickup;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Home\PickupDetailRequest;
use Carbon\Carbon;
use Illuminate\Http\Response;


class pickupController extends Controller
{
	private $starttime=11;
	private $closetime=21;
	
	private $dayoff = Carbon::MONDAY; //maybe a group, so set it up by group
	
	
	
	public function ordertime(Request $request){
		
		
		// Getting all post data
		if($request->ajax()) {
			$date = $request->input('date');
			
			$dt = Carbon::createFromTimestamp($date);

			$minutes = 15;
				
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day, $this->starttime, $minutes);
			
			$time[$ordertime->timestamp] = $ordertime->toDateTimeString();
			
			$loop = ($this->closetime-$this->starttime-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$i][0] = $ordertime->copy()->addMinutes($i*15)->timestamp;
				$time[$i][1] = $ordertime->copy()->addMinutes($i*15)->toDateTimeString();
// 				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->toDateTimeString();
					
			}
			
			return $time;
// 			return json_encode($time);
// 			return response()->json(['date' => $time]);
		}
		
// 		
	}
	
	/*
	 * 
	 * 
	 */
	
	public function pickup_details(PickupDetailRequest $request){
		$datas = $request->all();
		
		$request->session()->put('pickup_deatils', $datas);
		
		if($request->session()->has('pickup_deatils')){
// 			return $datas;
			return response()->json([
								'message'=>'success'
								]);
		}else{
			return response()->json([
					'error' => false,
					'message' => 'Valid Pincode'
			]);
		}
		
// 		session()->flash('data',$datas);
	}
	
	/*
	 * 
	 * 
	 */
	public function details(){
		
		$dt = Carbon::now();//add hour for the test
		
		$minutes=0;
		
		if($dt->hour <$this->starttime){
			$minutes = 15;
			
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day, $this->starttime, $minutes);
			
			$time[$ordertime->timestamp] = $ordertime->format('h:i A');
			
			$loop = ($this->closetime-$this->starttime-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->format('h:i A');
			
			}
			
			for($i=0;$i<=10;$i++){
				if($dt->copy()->addDays($i)->dayOfWeek != $this->dayoff){
					$date[$dt->copy()->addDays($i)->timestamp]= $dt->copy()->addDays($i)->formatLocalized('%A %d %B %Y');
				}
			}
			
		}elseif (($this->starttime <= $dt->hour)&&($dt->hour < $this->closetime)){
			
			switch ($dt->minute)	{
				case $dt->minute< 15:
					$minutes = 15;
					break;
				case $dt->minute<30:
					$minutes = 30;
					break;
				case $dt->minute<45:
					$minutes = 45;
					break;
				case $dt->minute<60:
					$minutes = 00;
					break;
			}
			
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day, $dt->hour, $minutes);
			
			$time[$ordertime->timestamp] = $ordertime->format('h:i A');
			
			$loop = ($this->closetime-$dt->hour-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->format('h:i A');
			
			}
			
			for($i=0;$i<=10;$i++){
				if($dt->copy()->addDays($i)->dayOfWeek != $this->dayoff){
					$date[$dt->copy()->addDays($i)->timestamp]= $dt->copy()->addDays($i)->formatLocalized('%A %d %B %Y');
				}
			}
			
		}else{
			
			$minutes = 15;
				
			$ordertime = Carbon::create($dt->year, $dt->month, $dt->day+1, $this->starttime, $minutes);
			
			$time[$ordertime->timestamp] = $ordertime->format('h:i A');
			
			$loop = ($this->closetime-$this->starttime-1)*4 +(60-$minutes)/15;
			for($i=1;$i<=$loop;$i++){
				$time[$ordertime->copy()->addMinutes($i*15)->timestamp] = $ordertime->copy()->addMinutes($i*15)->format('h:i A');
					
			}
				
			for($i=0;$i<=10;$i++){
				if($dt->copy()->addDays($i+1)->dayOfWeek != $this->dayoff){
					$date[$dt->copy()->addDays($i)->timestamp]= $dt->copy()->addDays($i+1)->formatLocalized('%A %d %B %Y');
				}
			}
		}
	
// 		return "___";
// 		dd( Carbon::createFromTimestamp(1450436210)->toDateTimeString());
		return view('frontend.home.ordertime',compact('date','time'));
	}
	
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
