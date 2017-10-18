<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisValidator extends FormRequest
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
            'email'=>'required|email',
            'username' => 'required|max:30',
            'password' => 'required|min:6',
            'confirmpassword' => 'required|same:password'
        ];
    }

    public function messages()
    {
        return[
        'confirmpassword.same'=>'Konfirmasi password tidak sesuai'

        ];
    }
}
