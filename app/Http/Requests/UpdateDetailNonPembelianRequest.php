<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetailNonPembelianRequest extends FormRequest
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
            'nama_transaksi' => 'required|string',
            'tgl_transaksi' => 'required|date',
            'nominal_transaksi' => 'required|numeric',
            'keterangan' => 'nullable|text'
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
            'nama_transaksi.required' => 'Nama transaksi harus diisi!',
            'nominal_transaksi.required' => 'Nominal transaksi harus diisi!',
            'nominal_transaksi.numeric' => 'Nominal transaksi harus diisi angka!'
        ];
    }
}
