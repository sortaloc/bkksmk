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
            'nis'           => 'required|numeric|digits:10|unique:daftar_cp',
            'nama'          => 'required',
            'jk'            => 'required',
            'email'         => 'required|string|email|max:255|unique:users',
            'username'      => 'required|string|unique:users',
            'password'      => 'required|string|min:6|confirmed',
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
            'emailCP.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'usernameCP.required' => 'Username harus diisi',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'passwordCP.required' => 'Password harus diisi',
            'passwordCP.min' => 'Password minimal 6 karakter',
            'passwordCP.confirmed' => 'Password dan Konfirmasi Password tidak sama',
        ];
    }
}
