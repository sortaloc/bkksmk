<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLokerRequest extends FormRequest
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
            'judul' => 'required',
            'persyaratan' => 'required',
            'jam_kerja' => 'required',
            'gaji' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Judul harus diisi',
            'persyaratan.required' => 'Persyaratan harus diisi',
            'jam_kerja.required' => 'Jam Kerja harus diisi',
            'gaji.required' => 'Gaji harus diisi'
        ];
    }
}
