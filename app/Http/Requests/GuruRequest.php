<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GuruRequest extends FormRequest
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
            'sekolah' => ['required', 'exists:sekolahs,sekolah'],
            'nip' => ['required', 'string','min:18', 'max:18', 'unique:gurus'],
            'nama' => ['required', 'string', 'max:255'],
            'gender' => ['enum', 'in:Laki-laki,Perempuan'],
            'email' => ['email', 'max:255', 'unique:gurus'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'url_photo' => ['image', 'mimes:pdf,jpeg,png,jpg', 'max:2048'],
        ];
    }
}
