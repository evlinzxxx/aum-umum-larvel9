<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\HasilKelompok;
use App\Models\Jurusan;
use App\Models\KategoriMasalah;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Pertanyaan;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HasilKelompokController extends Controller
{

    public function pilihShow(Request $request)
    {
        //data sekolah,tingkatan,jurusan,dan kelas untuk daftar searching
        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        return view('pages.guru.aum.hasilKelompok.index', compact(['sekolahs', 'tingkatans', 'jurusans', 'kelases', 'request']));
    }


    public function index(Request $request)
    {
        //menampilkan hasil analisis kelompok yang sudah tersedia
        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        //request data cari hasil kelompok berdasarkan sekolah,tingkatan,jurusan,dan kelas
        $re_sekolah = $request->cari_sekolah;
        $re_tingkatan = $request->cari_tingkatan;
        $re_jurusan = $request->cari_jurusan;
        $re_kelas = $request->cari_kelas;

        //hitung hasil analisis kelompok
        $cek = HasilKelompok::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->count();

        //jika tidak ada data hasil analisis kelompok
        if ($cek == null) {
            return back()->with('failed', 'Siswa Kelas ini belum melakukan pengisian AUM Umum');
        } 
        //jika ada hasil analisis kelompok
        elseif ($re_sekolah != null && $re_tingkatan != null && $re_jurusan != null && $re_kelas != null) {
            $data1 = HasilKelompok::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->pluck('sekolah')->first();
            $data2 = HasilKelompok::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->pluck('tingkatan')->first();
            $data3 = HasilKelompok::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->pluck('jurusan')->first();
            $data4 = HasilKelompok::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->pluck('kelas')->first();

            return view('pages.guru.aum.hasilKelompok.index', compact(['data1', 'data2', 'data3', 'data4', 'sekolahs', 'tingkatans', 'jurusans', 'kelases', 'request']));
        }
    }


    public function pilih(Request $request)
    {
        //data sekolah,tingkatan,jurusan,dan kelas untuk daftar searching
        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        return view('pages.guru.aum.hasilKelompok.create', compact(['sekolahs', 'tingkatans', 'jurusans', 'kelases', 'request']));
    }

    public function hitung(Request $request)
    {
        //jika search data yang akan ditambahkan blm diisi
        if ($request->sekolah == null && $request->tingkatan == null && $request->jurusan == null && $request->kelas == null) {
            return back()->with('failed', 'Pilih Sekolah dan Kelas terlebih dahulu!');
        }

        //request data cari sekolah,tingkatan,jurusan,dan kelas
        $sekolah = $request->sekolah;
        $tingkatan = $request->tingkatan;
        $jurusan = $request->jurusan;
        $kelas = $request->kelas;

        //hitung hasil analisis individu
        $cek_data = HasilIndividu::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->count();

        //jika siswa di kelas ini belum mengisi aum
        if ($cek_data == null) {
            return back()->with('failed', 'Siswa kelas ini belum melakukan pengisian AUM Umum');
        }

        //cek jika hasil kelompok sudah tersedia 
        $siswa = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->count();

        //jika ada
        if ($siswa >= 1) {
            return view('pages.guru.aum.hasilKelompok.blankHasil', compact(['sekolah', 'tingkatan', 'jurusan', 'kelas']));
        } 
        //jika tidak ada
        else {
            //ambil nilai hasil individu siswa di kelas yang dipilih
            $siswa = HasilIndividu::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->get();
            $cek_siswa = HasilIndividu::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('nisn')->toArray();
            $cek = Siswa::all();

            //hitung nilai responden
            $total_responden = (count($cek_siswa)) / 10;

            $kategoris = KategoriMasalah::all()->sortBy('created_at');
            $kategori = $kategoris->pluck('kode_kategori');
            //ambil data hasil individu berdarkan kelas yang dipilih 
            foreach ($kategori as $k) {
                $jml_tertinggi[] = $siswa->where('kode_kategori', $k)->max('jumlah_ya');
                $jml_terendah[] = $siswa->where('kode_kategori', $k)->min('jumlah_ya');
                $jml_masalah[] =  $siswa->where('kode_kategori', $k)->sum('jumlah_ya');
                $rata_masalah[] =  $siswa->where('kode_kategori', $k)->sum('jumlah_ya') / $total_responden;
            }

            $total_kp = count($kategori);

            //simpan data analisis kelompok berdasarkan kategori
            for ($i = 0; $i < $total_kp; $i++) {
                $ak = DB::table('hasil_kelompoks')->insert([

                    'kode_kategori'             => $kategori[$i],
                    'sekolah'                   => $sekolah,
                    'tingkatan'                 => $tingkatan,
                    'jurusan'                   => $jurusan,
                    'kelas'                     => $kelas,
                    'jumlah_tertinggi'          => $jml_tertinggi[$i],
                    'jumlah_terendah'           => $jml_terendah[$i],
                    'jumlah_masalah'            => $jml_masalah[$i],
                    'rata_jumlah'               => $rata_masalah[$i],
                    'created_at'                => NOW(),
                    'updated_at'                => NOW()
                ]);
            }
            return view('pages.guru.aum.hasilKelompok.selesai', compact(['sekolah', 'tingkatan', 'jurusan', 'kelas']));
        }
    }


    public function show($sekolah, $tingkatan, $jurusan, $kelas)
    {
        //ambil data hasil kelompok berdasarkan kelas
        $hasils = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->get();
        //ambil data kategori
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        $hasil = $kategoris->pluck('kode_kategori');
        //hitung jumlah pertanyaan
        $jml_pertanyaan = Pertanyaan::all()->count();

        $kategories = $kategoris->pluck('kode_kategori');
        //ambil data hasil kelompok berdarkan kelas yang dipilih 
        foreach ($kategories as $k) {
            $data[] = $hasils->where('kode_kategori', $k)->pluck('rata_jumlah');
            $dat[] = $hasils->where('kode_kategori', $k)->pluck('jumlah_tertinggi');
        }

        //ambil nilai jumlah masalah tertinggi
        $max_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('jumlah_tertinggi')->toArray();
        $jml_max_masalah = array_sum($max_mslh);

        //ambil nilai jumlah masalah terendah
        $min_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('jumlah_terendah')->toArray();
        $jml_min_masalah = array_sum($min_mslh);

        //ambil nilai jumlah masalah
        $total_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('jumlah_masalah')->toArray();
        $jml_total_masalah = array_sum($total_mslh);

        //ambil nilai jumlah rata masalah
        $rata_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('rata_jumlah')->toArray();
        $jml_rata_masalah = array_sum($rata_mslh);

        //ambil nilai hasil individu siswa di kelas yang dipilih
        $cek_siswa = HasilIndividu::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('nisn')->toArray();
        $cek = Siswa::all();

        //hitung nilai responden
        $total_responden = (count($cek_siswa)) / 10;

        //nilai persentase tertinggi
        $persen_max = max($data)->first();
        $kat = HasilKelompok::where('rata_jumlah', $persen_max)->pluck('kode_kategori');
        $kate = [];
        foreach ($kat as $value) {
            $kate[] = $value;
        }
        $kateg = implode(',', $kate);

        //ambil nama kategori dengan persentase masalah tertinggi
        $kode_masalah = KategoriMasalah::where('kode_kategori', $kateg)->pluck('nama_kategori')->first();


        return view(
            'pages.guru.aum.hasilKelompok.show',
            compact([
                'data', 'kategories', 'sekolah', 'jurusan', 'tingkatan', 'kelas', 'hasil',
                'jml_pertanyaan', 'jml_max_masalah', 'jml_min_masalah', 'jml_total_masalah',
                'jml_rata_masalah', 'total_responden', 'persen_max', 'kode_masalah', 'hasils'
            ])
        );
    }

    public function destroy($sekolah, $tingkatan, $jurusan, $kelas, HasilKelompok $hasilKelompok)
    {
        //hapus data analisis kelompok
        $hasil = $hasilKelompok->where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->delete();

        if ($hasil) {
            return redirect()->route('dashboard.hasilKelompok.pilihShow')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.hasilKelompok.pilihShow')->with('failed', 'Hapus data gagal!');
        }
    }

    public function cetakPdf($sekolah, $tingkatan, $jurusan, $kelas)
    {
         //ambil data hasil kelompok berdasarkan kelas
         $hasils = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->get();
         //ambil data kategori
         $kategoris = KategoriMasalah::all()->sortBy('created_at');
         $hasil = $kategoris->pluck('kode_kategori');
         //hitung jumlah pertanyaan
         $jml_pertanyaan = Pertanyaan::all()->count();
 
         $kategories = $kategoris->pluck('kode_kategori');
         //ambil data hasil kelompok berdarkan kelas yang dipilih 
         foreach ($kategories as $k) {
             $data[] = $hasils->where('kode_kategori', $k)->pluck('rata_jumlah');
             $dat[] = $hasils->where('kode_kategori', $k)->pluck('jumlah_tertinggi');
         }
 
         //ambil nilai jumlah masalah tertinggi
         $max_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('jumlah_tertinggi')->toArray();
         $jml_max_masalah = array_sum($max_mslh);
 
         //ambil nilai jumlah masalah terendah
         $min_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('jumlah_terendah')->toArray();
         $jml_min_masalah = array_sum($min_mslh);
 
         //ambil nilai jumlah masalah
         $total_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('jumlah_masalah')->toArray();
         $jml_total_masalah = array_sum($total_mslh);
 
         //ambil nilai jumlah rata masalah
         $rata_mslh = HasilKelompok::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('rata_jumlah')->toArray();
         $jml_rata_masalah = array_sum($rata_mslh);
 
         //ambil nilai hasil individu siswa di kelas yang dipilih
         $cek_siswa = HasilIndividu::where('sekolah', $sekolah)->where('tingkatan', $tingkatan)->where('jurusan', $jurusan)->where('kelas', $kelas)->pluck('nisn')->toArray();
         $cek = Siswa::all();
 
         //hitung nilai responden
         $total_responden = (count($cek_siswa)) / 10;
 
         //nilai persentase tertinggi
         $persen_max = max($data)->first();
         $kat = HasilKelompok::where('rata_jumlah', $persen_max)->pluck('kode_kategori');
         $kate = [];
         foreach ($kat as $value) {
             $kate[] = $value;
         }
         $kateg = implode(',', $kate);
 
         //ambil nama kategori dengan persentase masalah tertinggi
         $kode_masalah = KategoriMasalah::where('kode_kategori', $kateg)->pluck('nama_kategori')->first();


        $html = '<img src="' . $_POST['chart_inputs'] . '">';
        $pdf = PDF::loadView(
            'pages/guru/aum/hasilKelompok/cetak',
            compact([
                'html', 'data', 'kategories', 'sekolah', 'jurusan', 'tingkatan', 'kelas', 'hasil',
                'jml_pertanyaan', 'jml_max_masalah', 'jml_min_masalah', 'jml_total_masalah',
                'jml_rata_masalah', 'total_responden', 'persen_max', 'kode_masalah', 'hasils'
            ])
        );

        $pdf->render();
        $pdf->setPaper('A4', 'potrait');
        return $pdf->download('Analisis-AUM-Umum.pdf');
    }
}
