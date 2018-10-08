<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterCPRequest extends FormRequest
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
            'nis' => 'required|numeric|digits:10|unique:daftar_cp',
            'nama' => 'required',
            'jk' => 'required',
            'no_hp_cp' => 'required|max:13|unique:kontak,no_hp',
            'emailCP' => 'required|string|email|max:255|unique:users,email',
            'usernameCP' => 'required|string|unique:users,username',
            'passwordCP' => 'required|string|min:6|confirmed',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'emailCP',
            'username' => 'usernameCP',
            'password' => 'passwordCP',
            'no_hp' => 'no_hp_cp'
        ];
    }

    public function messages()
    {
        return [
            'nis.required' => 'NIS harus diisi',
            'nis.numeric' => 'NIS harus angka',
            'nis.digits' => 'NIS harus 10 karakter',
            'nis.unique' => 'NIS sudah terdaftar',
            'nama.required' => 'Nama harus diisi',
            'jk.required' => 'Jenis Kelamin harus diisi',
            'no_hp_cp.required' => 'No HP harus diisi',
            'no_hp_cp.max' => 'No HP maksimal 13 karakter',
            'no_hp_cp.unique' => 'No HP sudah terdaftar',
            'emailCP.required' => 'Email harus diisi',
            'emailCP.email' => 'Email tidak valid',
            'emailCP.max' => 'Email maksimal 255 karakter',
            'emailCP.unique' => 'Email sudah terdaftar',
            'usernameCP.required' => 'Username harus diisi',
            'usernameCP.max' => 'Username maksimal 255 karakter',
            'usernameCP.unique' => 'Username sudah terdaftar',
            'passwordCP.required' => 'Password harus diisi',
            'passwordCP.min' => 'Password minimal 6 karakter',
            'passwordCP.confirmed' => 'Password dan Konfirmasi Password tidak sama',
        ];
    }
}
