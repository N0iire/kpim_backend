<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSimpananPokokRequest extends FormRequest
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
            'id_user' => 'required|integer|exists:users,id',
            'tgl_bayar' => 'required|date',
            'nominal_pokok' => 'required',
            'ket' => 'nullable|string'
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
            'id_user.required' => 'ID Anggota diperlukan',
            'nominal_pokok.required' => 'Nominal tidak boleh kosong!',
            'nominal_pokok.numeric' => 'Nominal hanya diisi dengan angka!'
        ];
    }
}
