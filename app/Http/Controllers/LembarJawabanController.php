<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\KategoriMasalah;
use App\Models\LembarJawaban;
use App\Models\Pertanyaan;
use App\Models\Siswa;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LembarJawabanController extends Controller
{
    public function start(Pertanyaan $pertanyaans)
    {
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);
        if(($siswa->gender)==null){
            return back()->with('failed','Lengkapi Data Diri Dahulu!');
        }
        $pertanyaans = Pertanyaan::paginate(5);
        $pertanyaan = Pertanyaan::all();
        $date = date('d M Y');

        $jawaban = LembarJawaban::where('nisn', $siswa_nisn)->get();

        $total = count($jawaban);

        Session::put('pertanyaan_url', request()->fullUrl());

        return view('pages.siswa.lembarJawaban.index', compact(['pertanyaans','pertanyaan', 'siswa', 'date', 'jawaban', 'total']));
    }


    public function assign(Request $request)
    {

        $request->validate([
            'sekolah' => 'required',
            'nisn' => 'required',
            'tingkatan' => 'required',
            'jurusan' => 'required',
            'kelas' => 'required',
            'kode_kategori' => 'required',
            'kode_pertanyaan' => 'required',
            'jawaban' => 'required',
        ], [
            'jawaban.required' => 'Pilih jawaban terlebih dahulu!',
        ]);

        $id = $request->input('kode_pertanyaan');
        $siswa = Auth::user()->nisn;

        $kode_pertanyaan = $request->kode_pertanyaan;

        $jawaban = $request->jawaban;

        $ck = count($kode_pertanyaan);
        $cj = count($jawaban);
        if($ck!=$cj){
            return back()->with('failed', 'Pilih Jawaban Terlebih dahulu!');
        }
              
        $a = LembarJawaban::where('nisn', $siswa)->where('kode_pertanyaan', '=', $id)->get()->count();
        
        if ($a < 1) {
            foreach($kode_pertanyaan as $k){
            $jawab = LembarJawaban::create([
                'sekolah' => $request->sekolah[$k],
                'nisn' => $request->nisn[$k],
                'tingkatan' => $request->tingkatan[$k],
                'jurusan' => $request->jurusan[$k],
                'kelas' => $request->kelas[$k],
                'kode_kategori' => $request->kode_kategori[$k],
                'kode_pertanyaan' => $kode_pertanyaan[$k],
                'jawaban' => $jawaban[$k],
            ]);
            }
        } elseif ($a == 1) {
            foreach($kode_pertanyaan as $k){
            $jawab = LembarJawaban::where('kode_pertanyaan', '=', $k)
            ->update([
                'jawaban' => $jawaban[$k],
            ]);
        }
        }
        
        if (session('pertanyaan_url')) {
            return redirect(session('pertanyaan_url'));
        }

        return redirect()->route('user.test', $jawab);
    }

    public function end()
    {
        $siswa_nisn = Auth::user()->nisn;
        $total = LembarJawaban::where('nisn', $siswa_nisn)->get()->count();
        $pertanyaan = Pertanyaan::all()->count();


        if ($total == $pertanyaan) {
            return redirect()->route('user.hitung');
        } else {
            return back()->with('failed', 'Anda belum mengisi semua pertanyaan');
        }
    }


}
