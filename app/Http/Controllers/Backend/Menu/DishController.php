<?php

namespace App\Http\Controllers\Backend\Menu;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Menu\Catalogue;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\Backend\Menu\CreateDishRequest;
use App\Models\Menu\Dishes;
use App\Models\Element\Mgroup;
use App\Models\Element\Material;

class DishController extends Controller
{
	protected $cache_image = 'images/cache_image/';
	protected $photo_path = 'images/dish_photos/';
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
        
// 		$imagedata =Image::make( file_get_contents($this->photo_path.'/'.$filename))->fit(200,200)->save($this->photo_path.'tn-'.$filename);
        
		return $filename;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$dishes = Dishes::latest()->paginate(10);
    	return view('backend.pages.menu.dish.index',compact('dishes'));
    }

    /**
     * Show the form for creating a new !resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$catalogue = Catalogue::lists('name','id');
    	$group = Mgroup::lists('name','id');
    	$mas = $this->allmaterials();
    	return view('backend.pages.menu.dish.create',compact('catalogue','group'))->withMaterials($mas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDishRequest $request)
    {
    	
    	$data = $this->add_photo($request);
        $dish = Dishes::create($data);
        $this->attachmaterials($dish,$request->input('materials'));
        return redirect()->route('admin.menu.dish.index')->withFlashSuccess(trans("menu_backend.menu_dish_createstring"));
        
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
    	$dish = Dishes::findOrFail($id);
    	$catalogue = $dish->catalogue->lists('name','id');
    	$group = $dish->mgroup->lists('name','id');
    	$mas = $this->allmaterials();
//     	$dish_materials = $dish->materials->lists('id')->toArray();
    	
    	return view('backend.pages.menu.dish.edit',compact(['dish','catalogue','group']))
    	->withMaterials($mas)
    	->withDishMaterials($dish->materials->lists('id')->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateDishRequest $request, $id)
    {
    	$dish = Dishes::findOrFail($id);
    	
    	$data = $request->all();
    	
    	if($dish->photo_name != $request->input('photo_name')){
    		$data = $this->add_photo($request);
    		
    		\File::delete($dish->photo_path);
    		\File::delete($dish->photo_thumbnail_path);
    	}
    	
    	$dish_materials = $dish->materials->lists('id')->toArray();
    	
    	$dish->update($data);
    	
    	$dish->detachMaterials($dish_materials);
    	
    	$this->attachmaterials($dish,$request->input('materials'));
    	
    	return redirect()->route('admin.menu.dish.index')->withFlashSuccess(trans("menu_backend.menu_dish_update"));
    	 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//     	dd($id);
     	Dishes::destroy($id);
     	return redirect()->route('admin.menu.dish.index')->withFlashSuccess(trans("menu_backend.menu_dish_deleting"));
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
    	$dishes = Dishes::where('name', 'LIKE', '%'.$name.'%')->paginate(10);
//     	

//     	$dishes = Dishes::latest()->get();
    	
//     	dd($name);
    	return view('backend.pages.menu.dish.index',compact('dishes'));
    }
    
    protected function makeFileName(UploadedFile $file){
    	$name = sha1(
    			time().$file->getClientOriginalName()
    	);
    
    	$extension = $file->getClientOriginalExtension();
    
    	return "{$name}.{$extension}";
    }
    
    protected function add_photo(CreateDishRequest $request){
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
    
    protected function attachmaterials($dish,$materials){
    	if(is_array($materials))
    	{
    		foreach($materials as $material){
    			$dish->attachMaterial($material);
    		}
    	}
    }
    
    protected function allmaterials(){
    	$mas = [];
    	 
    	$materials = Material::select('material_type_id')->groupBy('material_type_id')->get();
    	foreach ($materials as $material){
    		$mas[$material->material_type_id] =  Material::where('material_type_id',  $material->material_type_id)->valid()->get();
    	}
    	 
    	return $mas;
    }
}
