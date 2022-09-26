<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCatatanJualRequest extends FormRequest
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
            'nama_pembeli' => 'required|string|min:3',
            'tgl_penjualan' => 'required|date',
            'total_penjualan' => 'required'
        ];
    }
}
