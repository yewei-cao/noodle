<?php

namespace App\Http\Controllers\Frontend\Home;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop\Shops;

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

    
}
