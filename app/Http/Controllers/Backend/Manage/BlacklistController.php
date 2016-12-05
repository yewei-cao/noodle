<?php

namespace App\Http\Controllers\Backend\Manage;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Shop\Blacklists;

class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blacklists = Blacklists::latest()->get();
    	
    	return view('backend.pages.manage.blacklist.index',compact('blacklists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('backend.pages.manage.blacklist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    			'ip' => 'required|ip',
    			'reason' => 'required|min:3'
    	]);
    	 
    	Blacklists::create($request->all());
    	 
    	return redirect()->route('admin.manage.blacklist.index')->withFlashSuccess(trans("menu_backend.menu_blacklist_createstring"));
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
        $blacklist = Blacklists::findOrFail($id);
    	 
    	return view('backend.pages.manage.blacklist.edit',compact('blacklist'));
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
        $this->validate($request, [
				'ip' => 'required|ip',
    			'reason' => 'required|min:3'
		]);
		
		Blacklists::findOrFail($id)->update($request->all());
		
		return redirect()->route('admin.manage.blacklist.index')->withFlashSuccess(trans("element_backend.menu_blacklist_update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blacklists::destroy($id);
    	return redirect()->route('admin.manage.blacklist.index')->withFlashSuccess(trans("element_backend.menu_blacklist_deleting")); 
    }
}
