<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop\Shops;
use App\Models\Menu\Catalogue;
use App\Models\Menu\Dishes;

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
        return view('frontend.home.home')->withShop($this->shop);
    }
    
    public function policy()
    {
    	return view('frontend.home.policy')->withShop($this->shop);
    }

    public function menu(){
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
