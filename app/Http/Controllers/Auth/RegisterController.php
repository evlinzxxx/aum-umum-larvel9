<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\GuruRequest;
use App\Http\Requests\SiswaRequest;
use App\Models\Guru;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Providers\RouteServiceProvider;
use App\Models\Tingkatan;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:guru');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function registerAs()
    {
        return view('registerAs', ['route' => route('register'), 'title' => 'Registrasi sebagai']);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     * @return \App\Models\Admin
     * 
     * 
     */

    public function showSiswaRegisterForm()
    {
        //tampilkan data sekolah,tingkatan,jurusan,dan kelas
        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        return view(
            'Auth.registerSiswa',
            compact(['sekolahs', 'tingkatans', 'jurusans', 'kelases']),
            ['route' => route('siswa.register-view'), 'title' => 'Registrasi Siswa']
        );
    }

    protected function createSiswa(SiswaRequest $request, Siswa $siswa)
    {
        //simpan data register siswa
        $siswas = $siswa->create([
            'sekolah' => $request->sekolah,
            'nisn' => $request->nisn,
            'nama' => $request->nama,
            'tingkatan' => $request->tingkatan,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
            'email' => null,
            'gender' => null,
            'password' => Hash::make($request->password),
            'url_photo' => 'default_user.png',
        ]);

        if ($siswas) {
            return redirect()->intended('login')->with('success', 'Data berhasil dibuat!');
        } else {
            return redirect()->intended('login')->with('failed', 'Data gagal dibuat!');
        }
    }

    public function showGuruRegisterForm()
    {
        //tampilkan data sekolah
        $sekolahs = Sekolah::all();
        return view('Auth.registerGuru', compact(['sekolahs']), ['route' => route('guru.register-view'), 'title' => 'Registrasi Guru BK']);
    }

    protected function createGuru(GuruRequest $request, Guru $guru)
    {
        //simpan data register guru
        $guru = $guru->create([
            'sekolah' => $request->sekolah,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'email' => null,
            'gender' => null,
            'password' => Hash::make($request->password),
            'url_photo' => 'default_user.png',
        ]);

        if ($guru) {
            return redirect()->intended('login')->with('success', 'Data berhasil dibuat!');
        } else {
            return redirect()->intended('login')->with('failed', 'Data gagal dibuat!');
        }
    }
}
