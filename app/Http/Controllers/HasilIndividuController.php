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
        $re_sekolah = $request->cari_sekolah;
        $re_tingkatan = $request->cari_tingkatan;
        $re_jurusan = $request->cari_jurusan;
        $re_kelas = $request->cari_kelas;

        if ($re_sekolah != null && $re_tingkatan != null && $re_jurusan != null && $re_kelas != null) {
            $siswas = Siswa::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->get();
        } elseif ($re_sekolah == null && $re_tingkatan == null && $re_jurusan == null && $re_kelas == null) {
            $siswas = Siswa::all();
        }

        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();


        return view('pages.guru.aum.hasilIndividu.index', compact(['siswas', 'sekolahs', 'tingkatans', 'jurusans', 'kelases', 'request']));
    }



    public function hitung()
    {
        $siswa_nisn = Auth::user()->nisn;

        $data =  LembarJawaban::where('nisn', $siswa_nisn)->get();
        $sekolah =  LembarJawaban::where('nisn', $siswa_nisn)->pluck('sekolah')->first();
        $tingkatan = LembarJawaban::where('nisn', $siswa_nisn)->pluck('tingkatan')->first();
        $jurusan = LembarJawaban::where('nisn', $siswa_nisn)->pluck('jurusan')->first();
        $kelas = LembarJawaban::where('nisn', $siswa_nisn)->pluck('kelas')->first();

        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');

        $pertanyaan = Pertanyaan::all();

        foreach ($kategori as $k) {
            $kp[] = $data->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_pertanyaan');
            $jumlah_kp[] = $data->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_pertanyaan')->count();
            $total_pert[] = $pertanyaan->where('kode_kategori', $k)->pluck('pertanyaan')->count();
        }

        $aa = count($kp);

        //ambil kode pertanyaan
        for ($i = 0; $i < $aa; $i++) {

            $kode = [];
            foreach ($kp[$i] as $value) {
                $kode[] = $value;
            }

            $kPertanyaan[] = implode(',', $kode);
        }

        for ($i = 0; $i < $aa; $i++) {
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
        return view('pages.siswa.lembarJawaban.selesai');
    }

    public function show()
    {
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);
        $cek = HasilIndividu::where('nisn', $siswa_nisn)->get()->count();
        $hasils = HasilIndividu::where('nisn', $siswa_nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        if ($cek == null) {
            return view('pages.siswa.lembarJawaban.blankHasil');
        }

        $datee = LembarJawaban::where('nisn', $siswa_nisn)->pluck('created_at')->first();

        $date = $datee->format('d M Y');

        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');

        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        $dataCharts = HasilIndividu::where('nisn', $siswa_nisn)->get();

        $jml_ya = HasilIndividu::where('nisn', $siswa_nisn)->pluck('jumlah_ya')->count();

        $jml_pertanyaan = Pertanyaan::all()->count();

        $persen = HasilIndividu::where('nisn', $siswa_nisn)->pluck('persentase_masalah')->toArray();

        $jml_persen = (array_sum($persen) / 225) * 100;

        $maxpersen = max($persenn);
        $p = $maxpersen->first();

        $cari_kode = (HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $p)->pluck('kode_kategori'));

        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $kateg = implode(',', $kate);

        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $masalah = implode(',', $kode);



        return view('pages.siswa.lembarJawaban.show', compact(['dataCharts', 'siswa', 'kategori', 'kategoris', 'data', 'date', 'hasils', 'hasil', 'jml_ya', 'jml_persen', 'jml_pertanyaan', 'kateg', 'p',  'masalah']));
    }


    public function cetak()
    {
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);
        $cek = HasilIndividu::where('nisn', $siswa_nisn)->get()->count();
        $hasils = HasilIndividu::where('nisn', $siswa_nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        if ($cek == null) {
            return view('pages.siswa.lembarJawaban.blankHasil');
        }

        $datee = LembarJawaban::where('nisn', $siswa_nisn)->pluck('created_at')->first();

        $date = $datee->format('d M Y');

        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');

        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $siswa_nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        $jml_ya = HasilIndividu::where('nisn', $siswa_nisn)->pluck('jumlah_ya')->count();

        $jml_pertanyaan = Pertanyaan::all()->count();

        $persen = HasilIndividu::where('nisn', $siswa_nisn)->pluck('persentase_masalah')->toArray();

        $jml_persen = (array_sum($persen) / 225) * 100;

        $maxpersen = max($persenn);
        $p = $maxpersen->first();

        $cari_kode = (HasilIndividu::where('nisn', $siswa_nisn)->where('persentase_masalah', $p)->pluck('kode_kategori'));

        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $kateg = implode(',', $kate);

        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $masalah = implode(',', $kode);

        $html = '<img src="' . $_POST['chart_input'] . '">';
        $pdf = PDF::loadView('pages/siswa/lembarJawaban/cetak', compact(['html', 'siswa', 'kategori', 'kategoris', 'data', 'date', 'hasils', 'hasil', 'jml_ya', 'jml_persen', 'jml_pertanyaan', 'kateg', 'p',  'masalah']));
        $pdf->render();
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('Analisis-AUM-Umum.pdf');
    }

    public function showGuru($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $hasils = HasilIndividu::where('nisn', $nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        $dataCharts = HasilIndividu::where('nisn', $nisn)->get();

        $cek = HasilIndividu::where('nisn', $nisn)->get()->count();

        if ($cek == null) {
            return view('pages.guru.aum.hasilIndividu.blankHasil', compact(['siswa']));
        }

        $datee = LembarJawaban::where('nisn', $nisn)->pluck('created_at')->first();
        $date = $datee->format('d M Y');
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');

        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        $jml_ya = HasilIndividu::where('nisn', $nisn)->pluck('jumlah_ya')->count();

        $jml_pertanyaan = Pertanyaan::all()->count();

        $persen = HasilIndividu::where('nisn', $nisn)->pluck('persentase_masalah')->toArray();

        $jml_persen = (array_sum($persen) / 225) * 100;

        $maxpersen = max($persenn);
        $p = $maxpersen->first();

        $cari_kode = (HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $p)->pluck('kode_kategori'));

        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $kateg = implode(',', $kate);

        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $masalah = implode(',', $kode);

        return view('pages.guru.aum.hasilIndividu.show', compact(['siswa', 'dataCharts', 'kategori', 'kategoris', 'data', 'date', 'hasils', 'hasil', 'jml_ya', 'jml_persen', 'jml_pertanyaan', 'kateg', 'p',  'masalah']));
    }

    public function cetakGuru($nisn)
    {
        $siswa = Siswa::findOrFail($nisn);
        $hasils = HasilIndividu::where('nisn', $nisn)->get();
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');

        $cek = HasilIndividu::where('nisn', $nisn)->get()->count();

        if ($cek == null) {
            return view('pages.guru.aum.hasilIndividu.blankHasil', compact(['siswa']));
        }

        $datee = LembarJawaban::where('nisn', $nisn)->pluck('created_at')->first();
        $date = $datee->format('d M Y');

        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $kategori = $kategoris->pluck('kode_kategori');
        foreach ($kategori as $k) {
            $data[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('jumlah_ya');
            $pertanyaan[] = Pertanyaan::where('kode_kategori', $k)->count();
            $dataaa[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->pluck('kode_kategori');
            $kp[] = LembarJawaban::where('nisn', $nisn)->where('kode_kategori', $k)->where('jawaban', 'Ya')->get();
            $persenn[] = HasilIndividu::where('nisn', $nisn)->where('kode_kategori', $k)->pluck('persentase_masalah');
        }

        $jml_ya = HasilIndividu::where('nisn', $nisn)->pluck('jumlah_ya')->count();

        $jml_pertanyaan = Pertanyaan::all()->count();

        $persen = HasilIndividu::where('nisn', $nisn)->pluck('persentase_masalah')->toArray();

        $jml_persen = (array_sum($persen) / 225) * 100;

        $maxpersen = max($persenn);
        $p = $maxpersen->first();

        $cari_kode = (HasilIndividu::where('nisn', $nisn)->where('persentase_masalah', $p)->pluck('kode_kategori'));

        $kat = KategoriMasalah::where('kode_kategori', $cari_kode)->pluck('nama_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $kateg = implode(',', $kate);

        $max2 = max($kp);
        $m = $max2->pluck('kode_pertanyaan');
        $kode = [];
        foreach ($m as $value) {
            $kode[] = $value;
        }
        $masalah = implode(',', $kode);

        $html = '<img src="' . $_POST['chart_inputt'] . '">';
        $pdf = PDF::loadView('pages/guru/aum/hasilIndividu/cetak', compact(['html', 'siswa', 'kategori', 'kategoris', 'data', 'date', 'hasils', 'hasil', 'jml_ya', 'jml_persen', 'jml_pertanyaan', 'kateg', 'p',  'masalah']));
        $pdf->render();
        $pdf->setPaper('A4', 'potrait');
        return $pdf->stream('Analisis-AUM-Umum.pdf');
    }
}
