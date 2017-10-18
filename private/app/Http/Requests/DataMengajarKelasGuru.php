<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataMengajarKelasGuru extends FormRequest
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
            'id_guru' => 'exists:datamengajarkelas,id_guru',
            'pilihkelas' => 'required'
        ];
    }

    public function messages(){
        return [
        'id_guru.exists' => 'Anda telah memiliki daftar mengajar kelas !',
        ];
    }
}
