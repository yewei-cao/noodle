<?php

namespace App\Http\Controllers\Backend\Element;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Element\Mgroup;
use App\Models\Element\Material;

class MgroupController extends Controller
{
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = Mgroup::latest()->get();
    	return view('backend.pages.element.mgroup.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	
    	$mas = $this->allmaterials();
    	
//     	Material::select('material_type_id')->groupBy('material_type_id')->get();
    	
//     	$mas = Material::where('material_type_id','3')->valid()->get();
    	
    	
//     	dd($mas);
        return view('backend.pages.element.mgroup.create')->withMaterials($mas);

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
    	
    	$mgroup = Mgroup::create($request->all());
    	
    	$this->attachmaterials($mgroup,$request->input('materials'));

    	return redirect()->route('admin.element.mgroup.index')->withFlashSuccess(trans("element_backend.mgroup_createstring"));
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
        $mgroup = Mgroup::findOrFail($id);
        
        $mgroup_materials = $mgroup->material->lists('id')->toArray();
        
        $mas = $this->allmaterials();
        
        return view('backend.pages.element.mgroup.edit',compact('mgroup','mgroup_materials'))->withMaterials($mas);
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
        $mgroup = Mgroup::findOrFail($id);
        
        $mgroup_materials = $mgroup->material->lists('id')->toArray();
        
        $mgroup->update($request->all());
        
        $mgroup->detachMaterials($mgroup_materials);
        
        $this->attachmaterials($mgroup,$request->input('materials'));
        
        return redirect()->route('admin.element.mgroup.index')->withFlashSuccess(trans("element_backend.mgroup_update"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    	Mgroup::destroy($id);
    	return redirect()->route('admin.element.mgroup.index')->withFlashSuccess(trans("element_backend.mgroup_deleting"));
    	
    }
    
    protected function attachmaterials($mgroup,$materials){
    	if(is_array($materials))
    	{
    		foreach($materials as $material){
    			$mgroup->attachMaterial($material);
    		}
    	}
    }
    
    protected function allmaterials(){
    	$mas = [];
    	
    	$materials = Material::select('material_type_id')->groupBy('material_type_id')->get();
    	
//     	return $materials;
    	foreach ($materials as $material){
    		$mas[$material->material_type_id] = Material::where('material_type_id',  $material->material_type_id)->valid()->get();
    	}
    	
    	return $mas;
    }
}
