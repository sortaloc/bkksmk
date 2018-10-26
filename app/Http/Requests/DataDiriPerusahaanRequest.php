<?php

namespace App\Http\Requests;

use App\Kontak;

use Illuminate\Foundation\Http\FormRequest;

class DataDiriPerusahaanRequest extends FormRequest
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
        $id = Kontak::find($this->request->get('id_kontak'))->id_kontak;
        return [
            'nama_perusahaan' => 'required|max:100',
            'no_hp' => 'required|max:13|unique:kontak,no_hp,'.$id.',id_kontak',
            // 'no_telepon' => 'unique:kontak,no_telepon,'.$id.',id_kontak',
            // 'id_line' => 'unique:kontak,id_line,'.$id.',id_kontak'
        ];
    }

    public function messages()
    {
        return [
            'nama_perusahaan.required' => 'Nama Perusahaan harus diisi',
            'nama_perusahaan.max' => 'Nama Perusahaan maksimal 100 karakter',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.max' => 'No HP maksimal 13 karakter',
            'no_hp.unique' => 'No HP sudah terdaftar',
            // 'no_telepon.unique' => 'No Telepon sudah terdaftar',
            // 'id_line.unique' => 'ID Line sudah terdaftar'
        ];
    }
}
