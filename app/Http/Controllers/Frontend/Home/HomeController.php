<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop\Shops;
use App\Models\Menu\Catalogue;
use App\Models\Menu\Dishes;
use Mapper;
use Carbon\Carbon;

class HomeController extends Controller
{
	public function __construct(){
		$this->shop = Shops::first();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	 
    	Mapper::map("-39.5357013","176.8484829",['zoom' => 16]);
    	
        return view('frontend.home.home')->withShop($this->shop);
    }
    
    public function policy()
    {
    	return view('frontend.home.policy')->withShop($this->shop);
    }

    public function menu(){
    	
    	$dt = Carbon::now();
    	
//     	return $dt->addDays(1)->dayOfWeek;
    	
    	if (in_array($dt->addDays(2)->dayOfWeek, $this->shop->workday())) {
    		return "got it";
    	}
    	return "not got it";
    	
    	
    	
    	$catalogues = Catalogue::orderBy('ranking', 'asc')->get();
    	$active = [
    			'menu'=>'active',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    	
//     	dd($catalogues);
    	
    	return view('frontend.home.menu.index',compact('catalogues'))
    	->withActive($active)
    	->withShop($this->shop);
    }
    
    public function types($type,Request $request){
    	$catalogues = Catalogue::where('name', $type)->orderBy('ranking', 'asc')->get();
    	
    	if(!$catalogues->count()){
    		return redirect()->route('menu.index');
    	}
    		
    	switch ($type){
    		case "noodles":
    			$active = [
    			'menu'=>'',
    			'noodles'=>'active',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    			break;
    		case "rice":
    			$active = [
    			'menu'=>'',
    			'noodles'=>'',
    			'rice'=>'active',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    			break;
    		case "snack&drinks":
    			$active = [
    			'menu'=>'',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'active',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    			break;
    		case "soups":
    			$active = [
    			'menu'=>'',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'active',
    			'chips'=>'',
    			'payment'=>''];
    			break;
    		case "chips":
    			$active = [
    			'menu'=>'',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'active',
    			'payment'=>''];
    			break;
    		default:
    			$active = [
    				'menu'=>'active',
    				'noodles'=>'',
    				'rice'=>'',
    				'snack&drinks'=>'',
    				'soups'=>'',
    				'chips'=>'',
    				'payment'=>''];
    			break;
    		
    	}
    	return view('frontend.home.menu.index',compact('catalogues'))
    	->withActive($active)
    	->withShop($this->shop);
    }
    
    public function dish($dishname,Request $request){
    	$dishname = str_replace('-', ' ', $dishname);
    	$dish = Dishes::where('name', $dishname)->firstOrFail();
    	$materials = [];
    	$i = 0;
    	$active = [
    			'menu'=>'active',
    			'noodles'=>'',
    			'rice'=>'',
    			'snack&drinks'=>'',
    			'soups'=>'',
    			'chips'=>'',
    			'payment'=>''];
    	foreach ($dish->mgroup->material as $material){
    		$materials[$i]['id']=$material->id;
    		$materials[$i]['name']=$material->name;
    		$i++;
    	}
    	foreach ($dish->materials as $material){
    		$materials[$i]['id']=$material->id;
    		$materials[$i]['name']=$material->name;
    		$i++;
    	}
    	return view('frontend.home.menu.dish',compact('materials','dish','active'))
    			->withShop($this->shop);
    	
    }
}
