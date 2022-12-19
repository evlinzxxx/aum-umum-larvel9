<?php

namespace App\Http\Controllers;

use App\Models\HasilIndividu;
use App\Models\Jurusan;
use App\Models\Kelas;
use App\Models\LembarJawaban;
use App\Models\Sekolah;
use App\Models\Siswa;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //request data cari siswa berdasrkan nama sekolah,tingkatan,jurusan,dan kelas
        $re_sekolah = $request->cari_sekolah;
        $re_tingkatan = $request->cari_tingkatan;
        $re_jurusan = $request->cari_jurusan;
        $re_kelas = $request->cari_kelas;

        //jika hasil request tidak kosong
        if ($re_sekolah != null && $re_tingkatan != null && $re_jurusan != null && $re_kelas != null) {
            $siswas = Siswa::where('sekolah', $re_sekolah)->where('tingkatan', $re_tingkatan)->where('jurusan', $re_jurusan)->where('kelas', $re_kelas)->paginate(40);
        } 
        //jika hasil request kosong
        elseif ($re_sekolah == null && $re_tingkatan == null && $re_jurusan == null && $re_kelas == null) {
            $siswas = Siswa::paginate(5);
        }

        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();

        return view('pages.guru.profile.indexSiswa', compact(['sekolahs', 'tingkatans', 'jurusans', 'kelases', 'siswas', 'request']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nisn)
    {
        //menampilkan profil data siswa
        $siswa = Siswa::findOrFail($nisn);
        return view('pages.guru.profile.showSiswa', compact(['siswa']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Siswa $siswa)
    {
        //menampilkan data siswa untuk diedit
        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();
        return view('pages.guru.profile.editSiswa', compact(['sekolahs', 'tingkatans', 'jurusans', 'kelases', 'siswa']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Siswa $siswa)
    {
        //reuest semua data yang akan diupdate
        $inputs = $request->all();

        //validasi data
        $request->validate([
            'sekolah' => 'required|exists:sekolahs,sekolah',
            'nama' => 'required|string|max:255',
            'tingkatan' => 'required|exists:tingkatans,tingkatan',
            'jurusan' => 'required|exists:jurusans,jurusan',
            'kelas' => 'required|exists:kelases,kelas',
            'gender' => '',
            'email' => 'nullable|email|max:255',
            'url_photo' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        //menyimpan dan mengupdate foto
        if ($image = $request->file('url_photo')) {

            if (($siswa->url_photo) == "default_user.png") {
            }
            //hapus foto lama dari folder
            elseif (!empty($siswa->url_photo) && file_exists('uploads/siswa/' . $siswa->url_photo)) {
                unlink('uploads/siswa/' . $siswa->url_photo);
            }
            $imageName = $inputs['nama'] . time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/siswa/', $imageName);
            $inputs['url_photo'] = $imageName;
        }

        //update data
        $siswa = $siswa->update($inputs);

        if ($siswa) {
            return redirect()->route('dashboard.siswa.index')->with('success', 'Update data success!');
        } else {
            return redirect()->route('dashboard.siswa.index')->with('failed', 'Update data failed!');
        }
    }

    public function showSiswa($nisn)
    {
        //menampilkan profile di halaman siswa
        $siswa = Siswa::findOrFail($nisn);
        return view('pages.siswa.profile.showSiswa', compact(['siswa']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editSiswa($nisn)
    {
        //menampilkan data siswa untuk diedit di halaman siswa
        $sekolahs = Sekolah::all();
        $tingkatans = Tingkatan::all();
        $jurusans = Jurusan::all();
        $kelases = Kelas::all();
        $siswa = Siswa::findOrFail($nisn);
        return view('pages.siswa.profile.editSiswa', compact(['siswa', 'sekolahs', 'tingkatans', 'jurusans', 'kelases']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateSiswa(Request $request, Siswa $user)
    {
        //reuest semua data yang akan diupdate
        $inputs = $request->all();

        //validasi data
        $request->validate([
            'sekolah' => 'required|exists:sekolahs,sekolah',
            'nama' => 'required|string|max:255',
            'tingkatan' => 'required|exists:tingkatans,tingkatan',
            'jurusan' => 'required|exists:jurusans,jurusan',
            'kelas' => 'required|exists:kelases,kelas',
            'gender' => 'in:Laki-laki,Perempuan',
            'email' => 'nullable|email|max:255',
            'url_photo' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        //menyimpan dan mengupdate foto
        if ($image = $request->file('url_photo')) {

            if (($user->url_photo) == "default_user.png") {
            }
            //hapus foto lama dari folder
            elseif (!empty($user->url_photo) && file_exists('uploads/siswa/' . $user->url_photo)) {
                unlink('uploads/siswa/' . $user->url_photo);
            }
            $imageName = $inputs['nama'] . time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/siswa/', $imageName);
            $inputs['url_photo'] = $imageName;
        }

        //update data
        $users = $user->update($inputs);

        if ($users) {
            return redirect()->route('siswa.home')->with('success', 'Update data success!');
        } else {
            return redirect()->route('siswa.home')->with('failed', 'Update data failed!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Siswa $siswa)
    {
        //hapus data siswa dan foto di folder
        if (($siswa->url_photo) == "default_user.png") {
            $siswa = $siswa->delete();
        } elseif (!empty($siswa->url_photo) && file_exists('uploads/siswa/' . $siswa->url_photo)) {
            unlink('uploads/siswa/' . $siswa->url_photo);
            $siswa = $siswa->delete();
        }
        if ($siswa) {
            return redirect()->route('dashboard.siswa.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.siswa.index')->with('failed', 'Hapus data gagal!');
        }
    }

    public function hapusTest($nisn)
    {
        //hapus semua data jawaban dan analisis individu untuk memulai ulang tes
        $data_jawaban = LembarJawaban::where('nisn', $nisn)->get();
        $data_analisis = HasilIndividu::where('nisn', $nisn)->get();

        $data1 = $data_jawaban->each->delete();
        $data2 = $data_analisis->each->delete();

        if ($data1 && $data2) {
            return redirect()->route('siswa.home')->with('success', 'Data berhasi dihapus, silahkan mulai kembali pengisian!');
        } else {
            return redirect()->route('siswa.home')->with('failed', 'Hapus data gagal!');
        }
    }
}
