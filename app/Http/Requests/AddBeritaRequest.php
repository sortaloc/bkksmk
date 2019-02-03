<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddBeritaRequest extends FormRequest
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
            'judul_berita' => 'required|max:255',
            'isi_berita' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'judul_berita.required' => 'Judul berita harus diisi',
            'judul_berita.max' => 'Judul berita maksimal 255 karakter',
            'isi_berita.required' => 'Isi berita harus diisi',
        ];
    }
}
