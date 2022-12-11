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
        $re_sekolah = $request->cari_sekolah;

        if ($re_sekolah != null) {
            $gurus = Guru::where('sekolah', $re_sekolah)->paginate(5);
        } elseif ($re_sekolah == null ) {
            $gurus = Guru::paginate(5);
        }

        $sekolahs = Sekolah::all();

        return view('pages.guru.profile.index', compact(['gurus', 'sekolahs', 'request']));
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($nip)
    {
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
        $sekolahs = Sekolah::all();
        return view('pages.guru.profile.edit', compact(['guru', 'sekolahs']));
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

        $inputs = $request->all();

        $request->validate([
            'sekolah' => 'required|exists:sekolahs,sekolah',
            'nama' => 'required|string|max:255',
            'gender' => 'in:Laki-laki,Perempuan',
            'email' => 'string|email|max:255',
            'url_photo' => 'image|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        if ($image = $request->file('url_photo')) {

            //delete the old
            if (!empty($guru->url_photo) && file_exists('uploads/guru/' . $guru->url_photo)) {
                unlink('uploads/guru/' . $guru->url_photo);
            }
            $imageName = $inputs['nama'] . time() . '.' . $image->getClientOriginalExtension();
            $image->move('uploads/guru/', $imageName);
            $inputs['url_photo'] = $imageName;
        }


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
        if (!empty($guru->url_photo) && file_exists('uploads/guru/' . $guru->url_photo)) {
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
