<?php

namespace App\Http\Requests\Backend\Element;

use App\Http\Requests\Request;

class MaterialRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'material_type_id'=>'required',
        	'name'=>'required|min:3',
        	'price'=>'numeric',
        	'description'=>'required|min:6'
        ];
    }
}
