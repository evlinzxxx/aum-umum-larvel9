<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function ubahPassword($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        return view('pages.siswa.profile.ubahPassword', compact(['siswa']));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' =>'required',
            'new_password' => 'required'
        ]);

       if(!Hash::check($request->old_password, auth()->guard('user')->user()->password)){
            return back()->with('failed', 'Password Lama Salah');
       }

       Siswa::where('nisn', auth()->user()->nisn)->update([
            'password' => Hash::make($request->new_password)
       ]);

       return back()->with('success', 'Password Berhasil Diubah');
    }

    public function ubahPasswordGuru($nip)
    {
        $guru = Guru::findOrFail($nip);
        return view('pages.guru.profile.ubahPassword', compact(['guru']));
    }

    public function updatePasswordGuru(Request $request)
    {
        $request->validate([
            'old_password' =>'required',
            'new_password' => 'required'
        ]);

       if(!Hash::check($request->old_password, auth()->guard('guru')->user()->password)){
            return back()->with('failed', 'Password Lama Salah');
       }

       Guru::where('nisn', auth()->user()->nip)->update([
            'password' => Hash::make($request->new_password)
       ]);

       return back()->with('success', 'Password Berhasil Diubah');
    }


}
