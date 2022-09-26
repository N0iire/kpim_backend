<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
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
            'nama_barang' => 'required|string|min:3',
            'jenis_barang' => 'required|string|min:3',
            'satuan' => 'nullable|string|min:2',
            'stok' => 'required|integer',
            'status' => 'required|boolean',
            'berat' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/',
            'harga_beli' => 'required',
            'harga_jual' => 'nullable',
        ];
    }
}
