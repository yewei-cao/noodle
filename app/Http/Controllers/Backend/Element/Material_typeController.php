<?php

namespace App\Http\Controllers\Backend\Element;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Element\Material_type;

class Material_typeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$types = Material_type::latest()->get();
    	return view('backend.pages.element.type.index',compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('backend.pages.element.type.create');
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
    			'name' => 'required',
    			'description' => 'required|min:6',
    	]);
    	Material_type::create($request->all());
    	 
    	return redirect()->route('admin.element.type.index')->withFlashSuccess(trans("element_backend.element_material_createstring"));
    	
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
    	$type = Material_type::findOrFail($id);
    	 
    	return view('backend.pages.element.type.edit',compact('type'));
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
				'name' => 'required',
				'description' => 'required|min:6',
		]);
		
		Material_type::findOrFail($id)->update($request->all());
		
		return redirect()->route('admin.element.type.index')->withFlashSuccess(trans("element_backend.element_material_update"));
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material_type::destroy($id);
    	return redirect()->route('admin.element.type.index')->withFlashSuccess(trans("element_backend.element_material_deleting")); 
        
    }
    
    
}
