<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AddAlumniRequest extends FormRequest
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
            'nis'               => ['required', 'integer', 'digits:10', Rule::unique('alumni')->ignore($this->nis, 'nis')],
            'nama'              => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'nis.required' => 'NIS harus diisi',
            'nis.integer' => 'NIS hanya berisi angka',
            'nis.digits' => 'NIS berisi 10 digit angka',
            'nis.unique' => 'NIS sudah terpakai',
            'nama.required' => 'Nama harus diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
        ];
    }
}
