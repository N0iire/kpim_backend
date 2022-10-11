<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailPinjamanRequest extends FormRequest
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
            'id_barang' => 'required|integer|exists:barangs,id',
            'jumlah' => 'required|integer',
            'sub_total' => 'required|numeric'
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
            'jumlah.required' => 'Jumlah barang harus diisi!',
            'jumlah.numeric' => 'Jumlah barang harus diisi dengan angka!'
        ];
    }
}
