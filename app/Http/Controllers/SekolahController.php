<?php

namespace App\Http\Controllers;

use App\Http\Requests\SekolahRequest;
use App\Models\Sekolah;

class SekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan index data sekolah
        $sekolahs = Sekolah::all();
        return view('pages.admin.sekolah.index', compact(['sekolahs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan form tambah sekolah
        return view('pages.admin.sekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SekolahRequest $request)
    {
        //ambil request data sekolah
        $sekolah = $request->all();

        //simpan data sekolah
        $sekolah = Sekolah::create($sekolah);

        if ($sekolah) {
            return redirect()->route('dashboard.sekolah.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.sekolah.index')->with('failed', 'Tambah data gagal!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        //menampilkan data sekolah yang akan diedit
        return view('pages.admin.sekolah.edit', compact(['sekolah']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SekolahRequest $request, Sekolah $sekolah)
    {
        //ambil request data sekolah
        $data = $request->all();

        //update data sekolah
        $sekolah = $sekolah->update($data);

        if ($sekolah) {
            return redirect()->route('dashboard.sekolah.index')->with('success', 'Update data sukses!');
        } else {
            return redirect()->route('dashboard.sekolah.index')->with('failed', 'Update data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sekolah $sekolah)
    {
        //hapus data sekolah
        $sekolah = $sekolah->delete();

        if ($sekolah) {
            return redirect()->route('dashboard.sekolah.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.sekolah.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
