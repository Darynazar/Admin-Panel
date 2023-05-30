<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'is_admin' => 'required|boolean'
        ];
    }

    public function messages()
    {
        return [
        
            'name.required' => 'ایتم دسته بندی الزامی است',
            'name.string' => 'ایتم نام باید از نوع رشته باشد',

            'email.required' => 'ایتم زیر دسته بندی الزامی است',
            'email.email' => 'ایتم ایمیل باید از نوع ایمیل باشد',
            'email.unique' => 'ایتم ایمیل  باید ازمنحصر به قرد باشد',

            'is_admin.required' => 'ایتم نوع کابر الزامی است',
            'is_admin.boolean' => 'ایتم نوع کابر باید از نوع بولین باشد',

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], 400));
    }
}
