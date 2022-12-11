<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PertanyaanRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'kode_kategori' => ['required'],
            'kode_pertanyaan' => ['required', 'string', 'unique:pertanyaans', 'max:3', 'min:3'],
            'pertanyaan' => ['required', 'string'],
        ];
    }
}
