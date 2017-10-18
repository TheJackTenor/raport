<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KelasValidator extends FormRequest
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
            'namakelas' => 'required|unique:datakelas,namakelas|max:15',
            'katjurusan' => 'required',
            'kursi' => 'required|numeric',
            'pilihwali' => 'required',
            'golongankelas' => 'required',
            'pilihwali' => 'required',
        ];
    }
}
