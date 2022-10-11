<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCicilanRequest extends FormRequest
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
            'id_pinjaman' => 'required|integer|exists:pinjamans,id',
            'tgl_bayar' => 'required|date',
            'nominal_bayar' => 'required'
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
            'nominal_bayar.required' => 'Nominal harus diisi!',
            'nominal_bayar.numeric' => 'Nominal harus diisi dengan angka!'
        ];
    }
}
