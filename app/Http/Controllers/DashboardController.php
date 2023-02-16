<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\HasilKelompok;
use App\Models\KategoriMasalah;
use App\Models\Siswa;

class DashboardController extends Controller
{
    public function index()
    {
        $sklh = auth()->user()->sekolah;
        //ambil semua data hasil analisis individu yang terakhir dikirim/terbaru
        $nisn0 = HasilIndividu::all();
        $nisn1 = $nisn0->pluck('nisn');
        $nisn = $nisn1->last();

        $siswa = Siswa::where('sekolah', $sklh)->where('nisn', $nisn)->pluck('nama');
        $cek = HasilIndividu::where('sekolah', $sklh)->where('nisn', $nisn)->count();

        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');

        foreach ($kategori as $k) {
            $data_individu[] = HasilIndividu::where('sekolah', $sklh)->where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
        }

        //ambil semua data hasil analisis kelompok yang terakhir dibuat
        $nilai = HasilKelompok::where('sekolah', $sklh);
        $tingkatan = $nilai->pluck('tingkatan')->last();
        $jurusan = $nilai->pluck('jurusan')->last();
        $kelas = $nilai->pluck('kelas')->last();
        $hasil = HasilKelompok::where('sekolah', $sklh)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->get();

        foreach ($kategori as $k) {
            $data_kelompok[] = $hasil->where('kode_kategori', $k)->pluck('rata_jumlah');
        }

        //ambil nama kelasnya
        $kelas = [$tingkatan . ' ' . $jurusan . ' ' . $kelas];
        $sekolahh = $sklh;


        return view('pages.guru.index', compact(['data_individu', 'data_kelompok', 'kategori', 'siswa', 'kelas', 'sekolahh']));
    }


    public function indexAdmin(){
        return view('pages.admin.dashboard');
    }
}
