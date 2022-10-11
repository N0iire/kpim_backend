<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePinjamanRequest extends FormRequest
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
            'barang' => 'required',
            'username' => 'required|string|exists:users,username',
            'tgl_pinjaman' => 'required|date',
            'total_pinjaman' => 'required|numeric',
            'durasi_cicilan' => 'required|integer'
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
            'id_user.required' => 'ID Anggota harus diisi!',
            'nominal_cicilan.required' => 'Nominal harus diisi!',
            'nominal_cicilan.numeric' => 'Nominal harus diisi dengan angka!',
            'jatuh_tempo.required' => 'Jatuh tempo harus diisi!',
            'jatuh_tempo.date' => 'Format tanggal (YYYY-MM-DD)/(2021-04-23)'
        ];
    }
}
