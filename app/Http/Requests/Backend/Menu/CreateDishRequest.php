<?php

namespace App\Http\Requests\Backend\Menu;

use App\Http\Requests\Request;

class CreateDishRequest extends Request
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
            'catalogue_id'=>'required',
        	'mgroup_id'=>'required',
        	'name'=>'required|min:3',
        	'price'=>'required|numeric',
        	'description'=>'required|min:3',
        	'consumptionpoint'=>'required|numeric',
        ];
    }
}
