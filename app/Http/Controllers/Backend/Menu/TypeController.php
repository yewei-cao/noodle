<?php

namespace App\Http\Controllers\Backend\Menu;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Menu\Type;

class TypeController extends Controller
{
 	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$types = Type::latest()->get();
    	
    	return view('backend.pages.menu.type.index',compact('types'));
    	
    }
    
    /**
     * Show the form for creating a new type.
     *
     * @return Response
     */
    public function create()
    {
    	return view('backend.pages.menu.type.create');
    }
    
    public function store(Request $request){
    	$this->validate($request, [
    			'name' => 'required',
    			'description' => 'required|min:6',
    			'ranking' => 'required',
    	]);
    	
    	$this->user->types()->create($request->all());
    	
    	return redirect()->route('admin.menu.type.index')->withFlashSuccess(trans("menu_backend.menu_type_createstring"));
//     	sweetalert_message()->overlay(trans("menu_backend.menu_type_createstring"),'Info');
    	
//     	return redirect()->back()->withFlashSuccess(trans("menu_backend.menu_type_createstring"));;

//     	return redirect()->route('admin.menu.type.index');
    }
    
    public function edit($id){
    	
    	$type = Type::findOrFail($id);
    	return view('backend.pages.menu.type.edit',compact('type'));
    	
    }

	public function update(Request $request,$id){
		$this->validate($request, [
				'name' => 'required',
				'description' => 'required|min:6',
				'ranking' => 'required',
		]);
		
		Type::findOrFail($id)->update(['name'=> $request->input('name'),'description'=> $request->input('description'),'ranking'=> $request->input('ranking')]);
		
		return redirect()->route('admin.menu.type.index')->withFlashSuccess(trans("menu_backend.menu_type_update"));
		
	}

/**
     * Remove the specified type from storage.
     * 
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
    	Type::destroy($id);
    	return redirect()->route('admin.menu.type.index')->withFlashSuccess(trans("menu_backend.menu_type_deleting")); 
        
    }

}
