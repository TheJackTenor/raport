<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaValidator2 extends FormRequest
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
            'namasiswa' => 'required|string|max:50',
            'nis' => 'required|numeric',
            'jeniskelamin' => 'required',
            'nomortelepon' => 'numeric|max:9999999999999',
            'namaayah' => 'string',
            'namaibu' => 'string',
            'nomorteleponortu' => 'numeric|max:9999999999999',
            'namawali' => 'string',
            'nomorteleponwali' => 'nullable|max:9999999999999',
            'alamatwali' => 'nullable',
            'pekerjaanwali' => 'nullable',
        ];
    }
}
