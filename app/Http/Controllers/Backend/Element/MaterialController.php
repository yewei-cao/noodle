<?php

namespace App\Http\Controllers\Backend\Element;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Element\Material;
use App\Models\Element\Material_type;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image;
use App\Http\Requests\Backend\Element\MaterialRequest;

class MaterialController extends Controller
{
	protected $cache_image = 'images/cache_image/';
	protected $photo_path = 'images/material_photos/';
	/**
	 * Upload a photo to server.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function uploadphoto(Request $request)
	{
		$file = $request->file('photo');
	
		$filename = $this->makeFileName($file);
		$file->move($this->cache_image,$filename);
	
		return $filename;
	}
	
    /**
     * Display a listing of the resource.
     *materials
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materials = Material::latest()->paginate(5);
    	return view('backend.pages.element.material.index',compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$type = Material_type::lists('name','id');
		return view('backend.pages.element.material.create',compact('type'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MaterialRequest $request)
    {
    	
    	$data = $this->add_photo($request);
    	    	 
    	Material::create($data);
    	 
    	return redirect()->route('admin.element.material.index')->withFlashSuccess(trans("element_backend.element_material_createstring"));
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
        $material = Material::findOrFail($id);
        
        $type = $material->type->lists('name','id');
    	
    	return view('backend.pages.element.material.edit',compact('material','type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, $id)
    {
    	$material = Material::findOrFail($id);
    	
    	$data = $request->all();
        
        if($material->photo_name != $request->input('photo_name')){
        	$data = $this->add_photo($request);
        	\File::delete($material->photo_path);
        	\File::delete($material->photo_thumbnail_path);
        }
        
		$material->update($data);
		
		return redirect()->route('admin.element.material.index')->withFlashSuccess(trans("element_backend.element_material_update"));
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material::destroy($id);
    	return redirect()->route('admin.element.material.index')->withFlashSuccess(trans("element_backend.element_material_deleting")); 
        
    }
    
    /**
     * Search the specified dish from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
    	$name = $request->input('table_search');
    	$materials = Material::where('name', 'LIKE', '%'.$name.'%')->paginate(10);
    	//
    
    	//     	$dishes = Dishes::latest()->get();
    	 
    	//     	dd($name);
    	return view('backend.pages.element.material.index',compact('materials'));
    }
    
    protected function makeFileName(UploadedFile $file){
    	$name = sha1(
    			time().$file->getClientOriginalName()
    	);
    
    	$extension = $file->getClientOriginalExtension();
    
    	return "{$name}.{$extension}";
    }
    
    protected function add_photo(MaterialRequest $request){
    	$data = $request->all();
    	 
    	$filename = $request->input('photo_name');
    	 
    	
    	if($filename){
    	
    		$img = Image::make( file_get_contents($this->cache_image.'/'.$filename))->save($this->photo_path.$filename);
    	
    		$thumbnail =Image::make( file_get_contents($this->cache_image.'/'.$filename))->fit(200,200)->save($this->photo_path.'tn-'.$filename);
    	
    		$data = $data +[
    				'photo_path' => $this->photo_path.$filename,
    				'photo_thumbnail_path' => $this->photo_path.'tn-'.$filename,
    		];
    		 
    	}
    	return $data;
    }
}
