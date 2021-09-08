<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'photo' => 'required_without:id',
            'photo.*'=>'mimes:jpg,jpeg,png,svg',
            'product'=> 'required|array|min:1',
            'product.*.name'=> 'required',
            'product.*.description'=> 'string',
            'product.*.price'=>'required|regex:/^\d+(\.\d{1,2})?$/',
            'product.*.quntity'=>'required|Integer|min:0',
            'product.*.abbr'=>'required',
            //'category.*.active'=>'required',
        ];
    }
   
    public function messages()
    {
        return [

            'required'=>'هذا الحقل مطلوب',
            'string'=>'الاسم يجب ان يكون احرف',
            'min'=>'  يجب ان ان ىكون الحد الادنى عن 0 ',
            'Integer'=>'يجب ان القيمة المدخلة ارقام',
            'required_without'=>'يجب ادخال الصورة',
            'regex'=>'يجب ادخال السعر ويجب ان يكون ارقام',
        ];
    }


}
