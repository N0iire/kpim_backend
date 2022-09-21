<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class RegisterRequest extends FormRequest
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
            'username' => 'required|max:25|unique:users|string',
            'password' => 'required|min:6|string',
            'nik' => 'required|unique:users,nik|string',
            'nama_anggota' => 'required|string',
            'alamat' => 'required|string',
            'ttl' => 'required|string',
            'pekerjaan' => 'required|string',
            'tgl_daftar' => 'required|date',
            'jabatan' => 'required'
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
            'username.required' => 'Username dibutuhkan!',
            'username.max' => 'Username maksimal karakter :max!',
            'username.unique' => 'Username telah digunakan!',
            'password.required' => 'Password dibutuhkan',
            'password.min' => 'Password minimal :min karakter!',
            'nik.required' => 'NIK dibutuhkan!',
            'nik.unique' => 'NIK telah digunakan!',
            'nama_anggota.required' => 'Nama Anggota dibutuhkan!',
            'alamat.required' => 'Alamat dibutuhkan!',
            'ttl.required' => 'Tempat Tanggal Lahir dibutuhkan!',
            'pekerjaan.required' => 'Pekerjaan dibutuhkan!',
            'jabatan.required' => 'Jabatan dibutuhkan!',

        ];
    }
}
