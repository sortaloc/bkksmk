<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddKegiatanRequest extends FormRequest
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
            'judul_kegiatan' => 'required|max:255',
            'deskripsi_kegiatan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'judul_kegiatan.required' => 'Judul kegiatan harus diisi',
            'judul_kegiatan.max' => 'Judul kegiatan maksimal 255 karakter',
            'deskripsi_kegiatan.required' => 'Deskripsi kegiatan harus diisi',
        ];
    }
}
