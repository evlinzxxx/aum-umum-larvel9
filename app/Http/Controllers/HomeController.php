<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\LembarJawaban;
use App\Models\Pertanyaan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Siswa $siswa)
    {
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);

        $jawabans = LembarJawaban::where('nisn', $siswa_nisn)->count();
        $pertanyaans = Pertanyaan::all()->count();
        $hasil = HasilIndividu::where('nisn', $siswa_nisn)->count();

        return view('pages.siswa.home', compact(['siswa', 'jawabans', 'pertanyaans', 'hasil']));
    }
}
