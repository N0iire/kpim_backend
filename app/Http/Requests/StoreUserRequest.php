<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|string|min:3|unique:users',
            'api_token' => 'nullable|string',
            'password' => 'required|string|min:5',
            'avatar' => 'nullable|string',
            'nik' => 'required|string|min:5',
            'nama_anggota' => 'required|string|min:3',
            'alamat' => 'required|string',
            'ttl' => 'required|string',
            'pekerjaan' => 'required|string',
            'tgl_daftar' => 'required|date',
            'jabatan' => 'required|string',
            'nominal_pokok' => 'required',
            'ket' => 'nullable|string'
        ];
    }
}
