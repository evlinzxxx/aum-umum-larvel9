<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\Jurusan;
use App\Models\KategoriMasalah;
use App\Models\Kelas;
use App\Models\LembarJawaban;
use App\Models\Pertanyaan;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HasilIndividuController extends Controller
{
    public function index(Request $request)
    {
        $sklh = auth()->user()->sekolah;

        //request data cari hasil individu berdasrkan sekolah,tingkatan,jurusan,dan kelas
        $re_tingkatan = $request->cari_tingkatan;
        $re_jurusan = $request->cari_jurusan;
        $re_kelas = $request->cari_kelas;

        //jika hasil request tidak kosong
        if ($re_tingkatan != null && $re_jurusan != null && $re_kelas != null) {
            $siswas = Siswa::where('sekolah', $sklh)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->paginate(40);
        }
        //jika hasil request kosong
        elseif ($re_tingkatan == null && $re_jurusan == null && $re_kelas == null) {
            $siswas = Siswa::where('sekolah', $sklh)->paginate(20);
        }

        $sekolahs = Sekolah::where('sekolah', $sklh)->get();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        return view('pages.guru.aum.hasilIndividu.index', compact(['siswas', 'sekolahs', 'tingkatans', 'jurusans', 'kelases', 'request']));
    }

    public function hitung()
    {
        $siswa_nisn = Auth::user()->nisn;

        //ambil data jawaban siswa
        $data =  LembarJawaban::where('nisn', $siswa_nisn)->get();
        $sekolah =  LembarJawaban::where('nisn', $siswa_nisn)->pluck('sekolah')->first();
        $tingkatan = LembarJawaban::where('nisn', $siswa_nisn)->pluck('tingkatan')->first();
        $jurusan = LembarJawaban::where('nisn', $siswa_nisn)->pluck('jurusan')->first();
        $kelas = LembarJawaban::where('nisn', $siswa_nisn)->pluck('kelas')->first();

        //ambil data kategori
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');
        //ambil data pertanyaan
        $pertanyaan = Pertanyaan::all();

        //ambil data jawaban berdasarkan kategorinya    
        foreach ($kategori as $k) {
            $kp[] = $data->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_pertanyaan');
            $jumlah_kp[] = $data->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_pertanyaan')->count();
            $total_pert[] = $pertanyaan->where('kode_kategori', $k)->pluck('pertanyaan')->count();
        }

        $total_kp = count($kp);

        //ambil kode pertanyaan
        for ($i = 0; $i < $total_kp; $i++) {

            $kode = [];
            foreach ($kp[$i] as $value) {
                $kode[] = $value;
            }

            $kPertanyaan[] = implode(',', $kode);
        }

        //simpan data hasil analisis individu
        for ($i = 0; $i < $total_kp; $i++) {
            $ai = DB::table('hasil_individus')->insert([
                'nisn'                      => $siswa_nisn,
                'sekolah'                   => $sekolah,
                'tingkatan'                 => $tingkatan,
                'jurusan'                   => $jurusan,
                'kelas'                     => $kelas,
                'kode_kategori'             => $kategori[$i],
                'kode_pertanyaan'           => $kPertanyaan[$i],
                'jumlah_ya'                 => $jumlah_kp[$i],
                'persentase_masalah'        => ($jumlah_kp[$i] / $total_pert[$i]) * 100,
                'created_at'                => NOW(),
                'updated_at'                => NOW()
            ]);
        }

        return redirect()->route('user.endPage');
    }

    public function endPage()
    {
        //menampilkan halaman akhir pengisisan aum
        return view('pages.siswa.lembarJawaban.selesai');
    }

    public function show()
    {
        //ambil data siswa yang sudah melakukan tes
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);

        //hitung nilai hasil individu 
        $cek = HasilIndividu::where('nisn', $siswa_nisn)->get()->count();

        $hasils = HasilIndividu::where('nisn', $siswa_nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        //jika belum ada hasil analisis individu
        if ($cek == null) {
            return view('pages.siswa.lembarJawaban.blankHasil');
        }

        //ambil data tanggal pengisian 
        $datee = LembarJawaban::where('nisn', $siswa_nisn)->pluck('created_at')->first();
        $date = $datee->isoFormat('D MMMM Y');

        $kategori = $kategoris->pluck('kode_kategori');

        //ambil data hasil analisis individu berdasarkan kategori
        foreach ($hasil as $k) {
            $data[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        //data untuk graph di pdf
        $dataCharts = HasilIndividu::where('nisn', $siswa_nisn)->get();

        //hitung jumlah masalah
        $jml_ya = HasilIndividu::where('nisn', $siswa_nisn)->pluck('jumlah_ya')->toArray();
        $total_mslh = array_sum($jml_ya);

        //hitung jumlah pertanyaan
        $jml_pertanyaan = Pertanyaan::all()->count();

        //hitung jumlah persentase masalah
        $persen = HasilIndividu::where('nisn', $siswa_nisn)->pluck('persentase_masalah')->toArray();
        $jml_persen = (array_sum($persen) / 225) * 100;
        //menghitung persentase tertinggi
        $maxpersen = max($persenn);
        $highest_percent = $maxpersen->first();

        //menghitung nilai masalah tertinggi
        $jmya = HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $highest_percent)->pluck('jumlah_ya')->toArray();
        $max_mslh = max($jmya);


        $cari_kode = (HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $highest_percent)->pluck('kode_kategori'));
        $hitung = $cari_kode->count();
        //jika ada persentase yang nilainya sama
        if ($hitung > 1) {
            $lihat = HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $highest_percent)->where('jumlah_ya', $max_mslh)->pluck('kode_kategori')->first();
            $kat = KategoriMasalah::where('kode_kategori', $lihat)->pluck('nama_kategori');
        }
        //jika persentase tertinggi hanya satu 
        else {
            $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        }

        //kategori dengan persentase tertinggi
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $highest_kategori = implode(',', $kate);

        //kode pertanyaan dengan persentase tertinggi
        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $highest_masalah = implode(',', $kode);

        return view(
            'pages.siswa.lembarJawaban.show',
            compact([
                'dataCharts', 'total_mslh', 'siswa', 'kategori',
                'kategoris', 'data', 'date', 'hasils', 'hasil',
                'jml_persen', 'jml_pertanyaan', 'highest_kategori',
                'highest_percent',  'highest_masalah'
            ])
        );
    }


    public function cetak()
    {
        //ambil data siswa yang sudah melakukan tes
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);

        $hasils = HasilIndividu::where('nisn', $siswa_nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        //ambil data tanggal pengisian 
        $datee = LembarJawaban::where('nisn', $siswa_nisn)->pluck('created_at')->first();
        $date = $datee->isoFormat('D MMMM Y');

        $kategori = $kategoris->pluck('kode_kategori');

        //ambil data hasil analisis individu berdasarkan kategori
        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        //data untuk graph di pdf
        $dataCharts = HasilIndividu::where('nisn', $siswa_nisn)->get();

        //hitung jumlah masalah
        $jml_ya = HasilIndividu::where('nisn', $siswa_nisn)->pluck('jumlah_ya')->toArray();
        $total_mslh = array_sum($jml_ya);

        //hitung jumlah pertanyaan
        $jml_pertanyaan = Pertanyaan::all()->count();

        //hitung jumlah persentase masalah
        $persen = HasilIndividu::where('nisn', $siswa_nisn)->pluck('persentase_masalah')->toArray();
        $jml_persen = (array_sum($persen) / 225) * 100;
        //menghitung persentase tertinggi
        $maxpersen = max($persenn);
        $highest_percent = $maxpersen->first();

        //menghitung nilai masalah tertinggi
        $jmya = HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $highest_percent)->pluck('jumlah_ya')->toArray();
        $max_masalah = max($jmya);

        $cari_kode = (HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $highest_percent)->pluck('kode_kategori'));
        $hitung = $cari_kode->count();
        //jika ada persentase yang nilainya sama
        if ($hitung > 1) {
            $lihat = HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $highest_percent)->where('jumlah_ya', $max_masalah)->pluck('kode_kategori')->first();
            $kat = KategoriMasalah::where('kode_kategori', $lihat)->pluck('nama_kategori');
        }
        //jika persentase tertinggi hanya satu 
        else {
            $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        }

        //kategori dengan persentase tertinggi
        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $highest_kategori = implode(',', $kate);

        //kode pertanyaan dengan persentase tertinggi
        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $highest_masalah = implode(',', $kode);

        //cetak graph masalah
        $html = '<img src="' . $_POST['chart_input'] . '">';
        $pdf = PDF::loadView(
            'pages/siswa/lembarJawaban/cetak',
            compact([
                'html', 'total_mslh', 'siswa', 'kategori',
                'kategoris', 'data', 'date', 'hasils', 'hasil',
                'jml_persen', 'jml_pertanyaan', 'highest_kategori',
                'highest_percent',  'highest_masalah'
            ])
        );
        $pdf->render();
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Analisis-AUM-Umum.pdf');
    }

    public function showGuru($nisn)
    {
        //ambil data siswa yang sudah melakukan tes
        $siswa = Siswa::findOrFail($nisn);

        $hasils = HasilIndividu::where('nisn', $nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        //hitung nilai hasil individu 
        $cek = HasilIndividu::where('nisn', $nisn)->get()->count();

        //jika belum ada hasil analisis individu
        if ($cek == null) {
            return view('pages.guru.aum.hasilIndividu.blankHasil', compact(['siswa']));
        }

        //ambil data tanggal penngisian
        $datee = LembarJawaban::where('nisn', $nisn)->pluck('created_at')->first();
        $date = $datee->isoFormat('D MMMM Y');

        $kategori = $kategoris->pluck('kode_kategori');
        //ambil data hasil analisis individu berdasarkan kategori
        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        //data untuk graph di pdf
        $dataCharts = HasilIndividu::where('nisn', $nisn)->get();

        //hitung jumlah masalah
        $jml_ya = HasilIndividu::where('nisn', $nisn)->pluck('jumlah_ya')->toArray();
        $total_mslh = array_sum($jml_ya);

        //hitung jumlah pertanyaan
        $jml_pertanyaan = Pertanyaan::all()->count();

        //hitung jumlah persentase masalah
        $persen = HasilIndividu::where('nisn', $nisn)->pluck('persentase_masalah')->toArray();
        $jml_persen = (array_sum($persen) / 225) * 100;
        //menghitung persentase tertinggi
        $maxpersen = max($persenn);
        $highest_percent = $maxpersen->first();

        //menghitung nilai masalah tertinggi
        $jmya = HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $highest_percent)->pluck('jumlah_ya')->toArray();
        $max_masalah = max($jmya);

        $cari_kode = (HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $highest_percent)->pluck('kode_kategori'));
        $hitung = $cari_kode->count();
        //jika ada persentase yang nilainya sama
        if ($hitung > 1) {
            $lihat = HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $highest_percent)->where('jumlah_ya', $max_masalah)->pluck('kode_kategori')->first();
            $kat = KategoriMasalah::where('kode_kategori', $lihat)->pluck('nama_kategori');
        }
        //jika persentase tertinggi hanya satu 
        else {
            $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        }

        //kategori dengan persentase tertinggi
        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $highest_kategori = implode(',', $kate);

        //kode pertanyaan dengan persentase tertinggi
        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $highest_masalah = implode(',', $kode);

        return view(
            'pages.guru.aum.hasilIndividu.show',
            compact([
                'siswa', 'dataCharts', 'total_mslh', 'kategori',
                'kategoris', 'data', 'date', 'hasils', 'hasil',
                'highest_percent', 'jml_pertanyaan', 'highest_kategori',
                'highest_percent',  'highest_masalah', 'jml_persen'
            ])
        );
    }

    public function cetakGuru($nisn)
    {
        //ambil data siswa yang sudah melakukan tes
        $siswa = Siswa::findOrFail($nisn);
        $hasils = HasilIndividu::where('nisn', $nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        //ambil data tanggal penngisian
        $datee = LembarJawaban::where('nisn', $nisn)->pluck('created_at')->first();
        $date = $datee->isoFormat('D MMMM Y');

        $kategori = $kategoris->pluck('kode_kategori');
        //ambil data hasil analisis individu berdasarkan kategori
        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        //data untuk graph di pdf
        $dataCharts = HasilIndividu::where('nisn', $nisn)->get();

        //hitung jumlah masalah
        $jml_ya = HasilIndividu::where('nisn', $nisn)->pluck('jumlah_ya')->toArray();
        $total_mslh = array_sum($jml_ya);

        //hitung jumlah pertanyaan
        $jml_pertanyaan = Pertanyaan::all()->count();

        //hitung jumlah persentase masalah
        $persen = HasilIndividu::where('nisn', $nisn)->pluck('persentase_masalah')->toArray();
        $jml_persen = (array_sum($persen) / 225) * 100;
        //menghitung persentase tertinggi
        $maxpersen = max($persenn);
        $highest_percent = $maxpersen->first();

        //menghitung nilai masalah tertinggi
        $jmya = HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $highest_percent)->pluck('jumlah_ya')->toArray();
        $max_masalah = max($jmya);

        $cari_kode = (HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $highest_percent)->pluck('kode_kategori'));
        $hitung = $cari_kode->count();
        //jika ada persentase yang nilainya sama
        if ($hitung > 1) {
            $lihat = HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $highest_percent)->where('jumlah_ya', $max_masalah)->pluck('kode_kategori')->first();
            $kat = KategoriMasalah::where('kode_kategori', $lihat)->pluck('nama_kategori');
        }
        //jika persentase tertinggi hanya satu 
        else {
            $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        }

        //kategori dengan persentase tertinggi
        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $highest_kategori = implode(',', $kate);

        //kode pertanyaan dengan persentase tertinggi
        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $highest_masalah = implode(',', $kode);

        $html = '<img src="' . $_POST['chart_inputt'] . '">';
        $pdf = PDF::loadView(
            'pages/guru/aum/hasilIndividu/cetak',
            compact([
                'html', 'total_mslh', 'siswa', 'kategori', 'kategoris',
                'data', 'date', 'hasils', 'hasil', 'highest_percent',
                'jml_pertanyaan', 'highest_kategori', 'highest_percent',
                'highest_masalah', 'jml_persen'
            ])
        );
        $pdf->render();
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Analisis-AUM-Umum.pdf');
    }
}
