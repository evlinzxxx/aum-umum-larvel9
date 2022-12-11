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
        $sekolahs = Sekolah::all();
        return view('pages.guru.sekolah.index', compact(['sekolahs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru.sekolah.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SekolahRequest $request)
    {
        $sekolah = $request->all();

        $sekolah = Sekolah::create($sekolah);

        if ($sekolah) {
            return redirect()->route('dashboard.sekolah.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.sekolah.index')->with('failed', 'Tambah data gagal!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sekolah $sekolah)
    {
        return view('pages.guru.sekolah.edit', compact(['sekolah']));
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
        $data = $request->all();

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
        $sekolah = $sekolah->delete();

        if ($sekolah) {
            return redirect()->route('dashboard.sekolah.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.sekolah.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
