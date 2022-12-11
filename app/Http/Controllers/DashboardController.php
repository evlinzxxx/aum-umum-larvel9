<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\HasilKelompok;
use App\Models\KategoriMasalah;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $nisn0 = HasilIndividu::all();
        $nisn1 = $nisn0->pluck('nisn');
        $nisn = $nisn1->last();

        $siswa = Siswa::where('nisn', $nisn)->pluck('nama');

        $hasil = HasilIndividu::where('nisn', $nisn)->get();
        $cek = HasilIndividu::where('nisn', $nisn)->count();


        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');

        foreach ($kategori as $k) {
            $data_individu[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $data_iindividu[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya')->count();
        }

        $nilai = HasilKelompok::all();
        $sekolah = $nilai->pluck('sekolah')->last();
        $tingkatan = $nilai->pluck('tingkatan')->last();
        $jurusan = $nilai->pluck('jurusan')->last();
        $kelas = $nilai->pluck('kelas')->last();
        $hasil = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->get();

        foreach ($kategori as $k) {
            $data_kelompok[] = $hasil->where('kode_kategori', $k)->pluck('rata_jumlah');
        }

        $kelas = [$tingkatan . ' ' . $jurusan . ' ' . $kelas];
        $sekolahh = $sekolah;


        return view('pages.guru.index', compact(['data_individu', 'data_kelompok', 'kategori', 'siswa', 'kelas', 'sekolahh']));
    }
}
