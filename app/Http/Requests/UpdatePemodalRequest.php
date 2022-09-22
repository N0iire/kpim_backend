<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePemodalRequest extends FormRequest
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
            'id_user' => 'required',
            'nama_pemodal' => 'required|string',
            'nominal_modal' => 'required|numeric',
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
            'id_user.required' => 'ID anggota harus diisi!',
            'nama_pemodal.required' => 'Nama pemodal harus diisi!',
            'nama_pemodal.string' => 'Nama pemodal harus diisi dengan text!',
            'nominal_modal.required' => 'Nominal harus diisi!',
            'nominal_modal.numeric' => 'Nominal harus diisi dengan angka!'
        ];
    }
}
