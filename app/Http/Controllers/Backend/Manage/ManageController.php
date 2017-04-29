<?php

namespace App\Http\Controllers\Backend\Manage;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop\Shops;

class ManageController extends Controller
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
    	return view('backend.pages.manage.shop')->withShop($this->shop); 
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
    	$data = $request->all();
    	
    	$this->validate($request, [
    			'title'=>'required',
    			'address'=>'required',
    			'phone'=>'required',
    			'distancefee'=>'required',
    			'maxfree'=>'required',
    			'freedelivery'=>'required',
    			'googleapi'=>'required',
    			'meta'=>'required',
    			'starttime' => 'required',
    			'closetime' => 'required',
//     			'dayoff' => 'required',
    	]);
    	
    	if(empty($request->input('cash'))){
    		$data['cash']=0;
    	}else{
    		$data['cash']=1;
    	}
    	
    	if(empty($request->input('credit'))){
    		$data['credit']=0;
    	}else{
    		$data['credit']=1;
    	}
    	
    	if(empty($request->input('poli'))){
    		$data['poli']=0;
    	}else{
    		$data['poli']=1;
    	}
    	
    	Shops::findOrFail($id)->update($data);
    	
    	return redirect()->route('admin.manage.index')
    	->withFlashSuccess(trans("menu_backend.manage_update"));
    }
    
}