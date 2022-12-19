<?php

namespace App\Http\Controllers;

use App\Http\Requests\PertanyaanRequest;
use App\Models\KategoriMasalah;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //request data cari pertanyaan berdasrkan kategori
        $re_kategori = $request->cari_kategori;

        //jika hasil request tidak kosong
        if ($re_kategori != null) {
            $pertanyaans = Pertanyaan::where('kode_kategori', $re_kategori)->paginate(50);
        } 
        //jika hasil request kosong
        elseif ($re_kategori == null ) {
            $pertanyaans = Pertanyaan::paginate(10);
        }

        $kategoris = KategoriMasalah::all();
        return view('pages.guru.aum.pertanyaan.index', compact(['kategoris', 'pertanyaans', 'request']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan form tambah pertanyaan
        $kategoris = KategoriMasalah::all()->sortBy('created_at');
        return view('pages.guru.aum.pertanyaan.create', compact(['kategoris']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PertanyaanRequest $request)
    {
         //ambil request data pertanyaan
        $pertanyaan = $request->all();

         //simpan data pertanyaan
        $pertanyaans = Pertanyaan::create($pertanyaan);

        if ($pertanyaans) {
            return redirect()->route('dashboard.pertanyaan.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.pertanyaan.index')->with('failed', 'Tambah data gagal!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode_pertanyaan)
    {
        //menampilkan data pertanyaan yang akan diedit
        $kategoris = KategoriMasalah::all();
        $pertanyaans = Pertanyaan::findOrFail($kode_pertanyaan);
        return view('pages.guru.aum.pertanyaan.edit', compact(['kategoris', 'pertanyaans']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pertanyaan $pertanyaan)
    {
         //ambil request data pertanyaan
        $data = $request->all();

        //jika belum memilik kategori
        if(($request->kode_kategori)==null){
            return back()->with('errror', 'Pilih Kategori terlebih dulu!');
        }

        //validasi data 
        $request->validate([
            'kode_kategori' => ['exists:kategori_masalahs,kode_kategori'],
            'kode_pertanyaan' => ['required', 'string', 'max:3'],
            'pertanyaan' => ['required', 'string'],
        ]);

        //update data pertanyaan
        $pertanyaans = $pertanyaan->update($data);

        if ($pertanyaans) {
            return redirect()->route('dashboard.pertanyaan.index')->with('success', 'Update data sukses!');
        } else {
            return redirect()->route('dashboard.pertanyaan.index')->with('failed', 'Update data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pertanyaan $pertanyaan)
    {
        //hapus data pertanyaan
        $pertanyaans = $pertanyaan->delete();

        if ($pertanyaans) {
            return redirect()->route('dashboard.pertanyaan.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.pertanyaan.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
