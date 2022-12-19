<?php

namespace App\Http\Controllers;

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
        //ambil data siswa yang sedang login
        $siswa_nisn = Auth::user()->nisn;
        $siswa = Siswa::find($siswa_nisn);

        //Jika profil belum lengkap
        if(($siswa->gender)==null){
            return back()->with('failed','Lengkapi Data Diri Dahulu!');
        }

        //ambil data pertanyaan
        $pertanyaans = Pertanyaan::paginate(5);
        //tanggal pengisian
        $date = date('d M Y');
        //ambil data jawaban yang sudah disimpan
        $jawaban = LembarJawaban::where('nisn', $siswa_nisn)->get();

        //hitung total jawaban yang sudah dijawab
        $total = count($jawaban);

        Session::put('pertanyaan_url', request()->fullUrl());

        return view('pages.siswa.lembarJawaban.index', compact(['pertanyaans', 'siswa', 'date', 'jawaban', 'total']));
    }


    public function assign(Request $request)
    {
        //validasi data jawaban
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

        //ambil kode pertanyaan
        $id = $request->input('kode_pertanyaan');
        $siswa = Auth::user()->nisn;

        //request data yang akan disimpam
        $kode_pertanyaan = $request->kode_pertanyaan;
        $jawaban = $request->jawaban;

        //hitung nilai jawaban 
        $hp = count($kode_pertanyaan);
        $hj = count($jawaban);
        //jika jawaban belum dipilih
        if($hp!=$hj){
            return back()->with('failed', 'Pilih Jawaban Terlebih dahulu!');
        }
        
        //cek jika sudah ada jawaban
        $a = LembarJawaban::where('nisn', $siswa)->where('kode_pertanyaan', '=', $id)->get()->count();
        
        //jika belum ada, simpan data jawaban
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
        }
        //jika sudah ada, update data jawaban 
        elseif ($a == 1) {
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
        //cek total jawab yang sudah dijawab
        $siswa_nisn = Auth::user()->nisn;
        $total = LembarJawaban::where('nisn', $siswa_nisn)->get()->count();
        $pertanyaan = Pertanyaan::all()->count();

        //jika semua pertanyaan dijawab
        if ($total == $pertanyaan) {
            return redirect()->route('user.hitung');
        } 
        //jika ada pertanyaan yang belum dijawab
        else {
            return back()->with('failed', 'Anda belum mengisi semua pertanyaan');
        }
    }


}
