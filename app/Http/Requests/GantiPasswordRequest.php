<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GantiPasswordRequest extends FormRequest
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
            'passLama' => 'required|min:6',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'passLama.required' => 'Password lama harus diisi',
            'passLama.min' => 'Password lama minimal 6 karakter',
            'password.required' => 'Password baru harus diisi',
            'password.min' => 'Password baru minimal 6 karakter',
            'password.confirmed' => 'Password baru dan konfirmasi password baru tidak sama'
        ];
    }
}
