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
    public function index()
    {
        $kategoris = KategoriMasalah::all();
        $pertanyaans = Pertanyaan::paginate(10);
        return view('pages.guru.aum.pertanyaan.index', compact(['kategoris', 'pertanyaans']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        $pertanyaan = $request->all();

        $pertanyaans = Pertanyaan::create($pertanyaan);

        if ($pertanyaans) {
            return redirect()->route('dashboard.pertanyaan.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.pertanyaan.index')->with('failed', 'Tambah data gagal!');
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
    public function edit($kode_pertanyaan)
    {
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
        $data = $request->all();

        if(($request->kode_kategori)==null){
            return back()->with('errror', 'Pilih Kategori terlebih dulu!');
        }

        $request->validate([
            'kode_kategori' => ['exists:kategori_masalahs,kode_kategori'],
            'kode_pertanyaan' => ['required', 'string', 'max:3'],
            'pertanyaan' => ['required', 'string'],
        ]);


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

        
        $pertanyaans = $pertanyaan->delete();

        if ($pertanyaans) {
            return redirect()->route('dashboard.pertanyaan.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.pertanyaan.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
