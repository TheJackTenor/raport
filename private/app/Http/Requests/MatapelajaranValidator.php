<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class MatapelajaranValidator extends FormRequest
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
           'namapelajaran' => 'required|unique:datapelajaran,namapelajaran|max:50',           
          'pknoragama' => Rule::unique('datapelajaran')->where(function ($query) {
    $query->where('pknoragama','<>','Lainnya');
})

        ];
    }
}
