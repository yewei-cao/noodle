<?php

namespace App\Http\Controllers\Backend\Menu;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Menu\Type;
use App\Models\Menu\Catalogue;

class CataloguesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $catalogues = Catalogue::latest()->get();;
        return view('backend.pages.menu.catalogue.index',compact('catalogues'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$type = Type::lists('name','id');
    	
    	return view('backend.pages.menu.catalogue.create',compact('type'));
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
        		'ranking' => 'required',
    	]);
    	
    	$this->user->catalogues()->create($request->all());
    	
    	return redirect()->route('admin.menu.catalogue.index')->withFlashSuccess(trans("menu_backend.menu_catalogue_createstring"));
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
    	$catalogue = Catalogue::findOrFail($id);
    	
    	$type = $catalogue->type->lists('name','id');
    	 
    	return view('backend.pages.menu.catalogue.edit',compact(['catalogue','type']));
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
    			'type_id'=>'required',
    			'name' => 'required',
    			'description' => 'required|min:6',
    			'ranking' => 'required',
    	]);
    	
    	Catalogue::findOrFail($id)->update(['user_id'=>$this->user->id,'type_id'=>$request->input('type_id'),'name'=> $request->input('name'),'description'=> $request->input('description'),'ranking'=> $request->input('ranking')]);
    	
    	return redirect()->route('admin.menu.catalogue.index')->withFlashSuccess(trans("menu_backend.menu_type_update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Catalogue::destroy($id);
    	return redirect()->route('admin.menu.catalogue.index')->withFlashSuccess(trans("menu_backend.menu_catalogue_deleting"));
    }
}
