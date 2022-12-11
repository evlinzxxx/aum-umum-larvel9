<?php

namespace App\Http\Controllers;

use App\Http\Requests\KategoriMasalahRequest;
use App\Models\KategoriMasalah;
use Illuminate\Http\Request;

class KategoriMasalahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoris = KategoriMasalah::all()->sortBy('created_at');

        return view('pages.guru.aum.kategori.index', compact((['kategoris'])));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru.aum.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriMasalahRequest $request)
    {
        $kategoris = $request->all();

        $kategori = KategoriMasalah::create($kategoris);

        if ($kategori) {
            return redirect()->route('dashboard.kategori.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.kategori.index')->with('failed', 'Tambah data gagal!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(KategoriMasalah $kategori)
    {
        return view('pages.guru.aum.kategori.edit', compact(['kategori']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriMasalah $kategori, KategoriMasalahRequest $request)
    {
        $data = $request->all();

        $kategoris = $kategori->update($data);

        if ($kategoris) {
            return redirect()->route('dashboard.kategori.index')->with('success', 'Ubah data sukses!');
        } else {
            return redirect()->route('dashboard.kategori.index')->with('failed', 'Ubah data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KategoriMasalah $kategori)
    {
        $kategoris = $kategori->delete();

        if ($kategoris) {
            return redirect()->route('dashboard.kategori.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.kategori.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
