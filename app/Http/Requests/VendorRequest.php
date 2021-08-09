<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
            
                'logo'=> 'required_without:id|mimes:jpg,jpeg,png,svg',
                'name'=> 'required|string|max:100',
                'mobile'=>'required|max:100|unique:vendors,mobile,'.$this -> id,
                'email'=> 'required|email|unique:vendors,email,'.$this -> id,
                'main_categorie_id' =>'required|exists:main_categories,id',
                'address' => 'required|string|max:500',
                'password'=> 'required_without:id',
                'company_name'=>'required|string',
        ];
    }

    public function messages(){

        return [
            'required'  => 'هذا الحقل مطلوب ',
            'max'  => 'هذا الحقل طويل',
            'main_categorie_id.exists'  => 'القسم غير موجود ',
            'email.email' => 'ضيغه البريد الالكتروني غير صحيحه',
            'address.string' => 'العنوان لابد ان يكون حروف او حروف وارقام ',
            'name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
            'logo.required_without'  => 'الصوره مطلوبة',
            'email.unique' => 'البريد الالكتروني مستخدم من قبل ',
            'mobile.unique' => 'رقم الهاتف مستخدم من قبل ',


        ];
    }

}
