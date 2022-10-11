<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCatatanJualRequest extends FormRequest
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
            'nama_pembeli' => 'required|string',
            'tgl_penjualan' => 'required|date',
            'total_penjualan' => 'required|numeric'
        ];
    }
}
