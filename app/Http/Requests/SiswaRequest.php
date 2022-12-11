<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SiswaRequest extends FormRequest
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
            'nisn' => ['required', 'string','min:10' ,'max:10', 'unique:siswas'],
            'sekolah' => ['required', 'exists:sekolahs,sekolah'],
            'nama' => ['required', 'string', 'max:255'],
            'tingkatan' => ['required', 'exists:tingkatans,tingkatan'],
            'jurusan' => ['required', 'exists:jurusans,jurusan'],
            'kelas' => ['required', 'exists:kelases,kelas'],
            'gender' => ['string', 'in:Laki-laki,Perempuan'],
            'email' => ['string','email', 'max:255', 'unique:siswas'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'url_photo' => ['image', 'mimes:pdf,jpeg,png,jpg', 'max:2048'],
        ];
    }
}
