<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Kelas2Validator extends FormRequest
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
            'namakelas' => 'required|max:15',
            'katjurusan' => 'required',
            'kursi' => 'required|numeric',
            'pilihwali' => 'required',
            'golongankelas' => 'required',
            'pilihwali' => 'required',
        ];
    }
}
