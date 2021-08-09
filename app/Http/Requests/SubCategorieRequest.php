<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategorieRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png,svg',
            'subcategory'=> 'required|array|min:1',
            'subcategory.*.name'=> 'required',
            'subcategory.*.abbr'=> 'required',
            'main_categorie_id' =>'required_without:id|exists:main_categories,id',
            //'category.*.active'=>'required',
        ];
    }


    public function messages()
    {
        return [];
     }

}
