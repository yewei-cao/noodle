<?php

namespace App\Http\Controllers\Backend\Manage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop\Coupons;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CouponConroller extends Controller
{
	
	protected $path = 'images/voucher.jpg';
	
    
	public function index()
	{
		
		$coupons = Coupons::latest()->get();
		 
		return view('backend.pages.manage.coupon.index',compact('coupons'));
		 
	}
	
	public function create()
	{
		return view('backend.pages.manage.coupon.create');
	}
	
	public function store(Request $request)
	{
		$this->validate($request, [
				'title' => 'required',
				'value' => 'required'
		]);
		
		if(empty($request->input('used'))){
			$data['used']=0;
		}else{
			$data['used']=1;
		}
		
		$data =  $request->all();
		
// 		$path = $this->makecode($path,"abcdefg",90,320,18,'#e1e1e1');
		
		do{
			$code = str_random(6);
		}while(Coupons::where('code', $code)->count());
		
		$data['code'] = $code;
		$data['expired_time'] =  Carbon::now()->addYear()->addDay()->toDateString();
		
		$data['photo_path'] = $this->makecode($this->path,$code,$data['expired_time'],$data['value']);
		
		$coupon = Coupons::create($data);
		
		Mail::queue('emails.coupon',compact('coupon'),function ($message)use($coupon){
			$message->from(env('MAIL_USERNAME'))->to($coupon->email)
			->subject('Noodle Canteen Coupon');
		});
		
		return redirect()->route('admin.manage.coupon.index')->withFlashSuccess(trans("menu_backend.menu_coupon_createstring"));
	}
	
	public function edit($id)
	{
		$coupon = Coupons::findOrFail($id);
		
		return view('backend.pages.manage.coupon.edit',compact('coupon'));
	}
	
	public function update(Request $request, $id)
	{
		$this->validate($request, [
				'code' => 'required',
				'title' => 'required',
				'value' => 'required',
				'email' =>'required|email'
		]);
		
		$data = $request->all();
		
		if(empty($request->input('used'))){
			$data['used']=0;
		}else{
			$data['used']=1;
		}
		$coupon = Coupons::findOrFail($id);
		\File::delete($coupon->photo_path);
		
// 		return $data['value'];
		
		$data['photo_path'] = $this->makecode($this->path,$data['code'],$coupon->expiretime(),$data['value']);
		
		Coupons::findOrFail($id)->update($data);
		
		Mail::queue('emails.coupon',compact('coupon'),function ($message)use($coupon){
			$message->from(env('MAIL_USERNAME'))->to($coupon->email)
			->subject('Noodle Canteen Coupon');
		});
		
		return redirect()->route('admin.manage.coupon.index')->withFlashSuccess(trans("menu_backend.menu_coupon_update"));
	}
	
	public function destroy($id)
	{
		$coupon = Coupons::findOrFail($id);
		\File::delete($coupon->photo_path);
		Coupons::destroy($id);
		return redirect()->route('admin.manage.coupon.index')->withFlashSuccess(trans("menu_backend.menu_coupon_deleting"));
		
	}
	
	public function makecode($path,$code,$date,$value){
		$img = Image::make(public_path($path));
		$img->text($code, 58, 202, function($font){
			$font->file(public_path('css/fonts/Roboto-Bold.ttf'));
			$font->size(13);
			$font->color('#e1e1e1');
		});
		
		$img->text($date, 215, 200, function($font){
			$font->file(public_path('css/fonts/Roboto-Bold.ttf'));
			$font->size(13);
			$font->color('#e1e1e1');
		});
		
		$x = 282;
		if(preg_match('^[1-9]\d*\.\d*|0\.\d*[1-9]\d*$^',$value)){
			$x = 268;
		}
		$img->text($value, $x, 135, function($font){
			$font->file(public_path('css/fonts/Roboto-Bold.ttf'));
			$font->size(42);
			$font->color('#e0191c');
		});
		
		$img->save(public_path('images/coupon/'.$code.'.jpg'));
		return 'images/coupon/'.$code.'.jpg';
	}
	
}
