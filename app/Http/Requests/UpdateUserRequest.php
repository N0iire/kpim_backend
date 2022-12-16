<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => 'required|string|max:30',
            'password' => 'nullable|string|min:5',
            'confirm_password' => 'required_with:password|same:password',
            'avatar' => 'nullable|string',
            'nik' => 'nullable|string',
            'nama_anggota' => 'nullable|string',
            'alamat' => 'nullable|string',
            'ttl' => 'nullable|string',
            'pekerjaan' => 'nullable|string',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required' => 'Username harus diisi!',
            'username.string' => 'Username harus diisi dengan kalimat!',
            'username.max'  => 'Username maksimal :max karakter',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Harap konfirmasi password!',
            'nik.required' => 'NIK harus diisi!',
            'nik.unique' => 'NIK sudah digunakan!',
            'nik.string' => 'NIK harus diisi dengan karakter!',
            'nama_anggota.required' => 'Nama anggota harus diisi!',
            'nama_anggota.string' => 'Nama anggota harus diisi dengan karakter!',
            'alamat.required' => 'Alamat perlu diisi!',
            'alamat.string' => 'Alamat harus diisi dengan karakter!',
            'ttl.required' => 'Tempat Tanggal Lahir harus diisi!',
            'pekerjaan.required' => 'Pekerjaan harus diisi!',
            'pekerjaan.string' => 'Pekerjaan harus diisi dengan karakter!',
        ];
    }
}
