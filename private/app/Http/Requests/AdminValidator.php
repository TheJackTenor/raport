<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminValidator extends FormRequest
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
            'namaadmin' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    public function messages(){
        return[
            'namaadmin.required' => 'Username harus diisi !',
            'email.required' => 'Email tidak boleh kosong !',
            'email.email' => 'Format yang diinputkan harus email !',
            'password.required' => 'Password tidak boleh kosong !'
        ];
        
    }
}
