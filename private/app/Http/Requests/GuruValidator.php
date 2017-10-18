<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuruValidator extends FormRequest
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
            'namaguru' => 'required|max:50',
            'nip' => 'numeric',
            'email' => 'required|email|max:30',
            'alamat' => 'required',
            'foto' => 'required|image',
        ];
    }
}
