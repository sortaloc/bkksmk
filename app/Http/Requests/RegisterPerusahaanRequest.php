<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterPerusahaanRequest extends FormRequest
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
            'nama_perusahaan'   => 'required|string|max:255',
            'no_hp'             => 'required|max:13|unique:kontak,no_hp',
            'email'             => 'required|string|email|max:255|unique:users,email',
            'password'          => 'required|string|min:6|confirmed',
            'username'          => 'required|string|unique:users,username',

        ];
    }

    public function messages()
    {
        return [
            'nama_perusahaan.required' => 'Nama Perusahaan harus diisi',
            'nama_perusahaan.string' => 'Nama Perusahaan tidak valid',
            'nama_perusahaan.max' => 'Nama Perusahaan maksimal 255 karakter',
            'no_hp.required' => 'No HP harus diisi',
            'no_hp.max' => 'No HP maksimal 13 karakter',
            'no_hp.unique' => 'No HP sudah terdaftar',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'username.required' => 'Username harus diisi',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password dan Konfirmasi Password tidak sama',
        ];
    }
}
