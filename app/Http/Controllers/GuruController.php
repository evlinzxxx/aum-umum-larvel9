<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Sekolah;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        //request data cari guru berdasrkan nama sekolah
        $re_sekolah = $request->cari_sekolah;

        //tampilkan data guru
        if ($re_sekolah != null) {
            $gurus = Guru::where('sekolah', $re_sekolah)->paginate(5);
        } elseif ($re_sekolah == null) {
            $gurus = Guru::paginate(5);
        }

        $sekolahs = Sekolah::all();

        return view('pages.admin.profile.index', compact(['gurus', 'sekolahs', 'request']));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nip)
    {
        //menampilkan profil data guru
        $guru = Guru::findOrFail($nip);
        return view('pages.admin.profile.show', compact(['guru']));
    }
    public function showGuru($nip)
    {
        //menampilkan profil data guru
        $guru = Guru::findOrFail($nip);
        return view('pages.guru.profile.show', compact(['guru']));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guru $guru)
    {
        //menampilkan data guru untuk diedit
        $sekolahs = Sekolah::all();
        return view('pages.admin.profile.edit', compact(['guru', 'sekolahs']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Guru $guru)
    {
        //reuest semua data yang akan diupdate
        $inputs = $request->all();

        //validasi data
        $request->validate([
            'sekolah' => 'required|exists:sekolahs,sekolah',
            'nama' => 'required|string|max:255',
            'gender' => 'in:Laki-laki,Perempuan',
            'email' => 'nullable|email|max:255',
            'url_photo' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        //menyimpan dan mengupdate foto
        if ($image = $request->file('url_photo')) {

            if (($guru->url_photo) == "default_user.png") {
            } 
            //hapus foto lama dari folder
            elseif (!empty($guru->url_photo) && file_exists('uploads/guru/' . $guru->url_photo)) {
                unlink('uploads/guru/' . $guru->url_photo);
            }
            $imageName = $inputs['nama'] . time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/guru/', $imageName);
            $inputs['url_photo'] = $imageName;
        }

        //update data guru baru yang sudah diedit
        $guru = $guru->update($inputs);

        if ($guru) {
            return redirect()->route('dashboard.guru.index')->with('success', 'Update data sukses!');
        } else {
            return redirect()->route('dashboard.guru.index')->with('failed', 'Update data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        //hapus data guru
        if (($guru->url_photo) == "default_user.png") {
            $guru = $guru->delete();

            //hapus data guru dan foto lama dari folder
        } elseif (!empty($guru->url_photo) && file_exists('uploads/guru/' . $guru->url_photo)) {
            unlink('uploads/guru/' . $guru->url_photo);

            $guru = $guru->delete();
        }
        if ($guru) {
            return redirect()->route('dashboard.guru.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.guru.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
