<?php

namespace App\Http\Controllers;

use App\Http\Requests\TingkatanRequest;
use App\Models\Tingkatan;
use Illuminate\Http\Request;

class TingkatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan index data tingkatan
        $tingkatans = Tingkatan::all();

        return view('pages.guru.sekolah.tingkatan.index', compact(['tingkatans']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan form tambah tingkatan
        return view('pages.guru.sekolah.tingkatan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TingkatanRequest $request, Tingkatan $tingkatan)
    {
         //ambil request data tingkatan
        $tingkatan = $request->all();

        //simpan data tingkatan
        $tingkatan = Tingkatan::create($tingkatan);

        if ($tingkatan) {
            return redirect()->route('dashboard.tingkatan.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.tingkatan.index')->with('failed', 'Tambah data gagal!');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tingkatan $tingkatan)
    {
         //menampilkan data tingkatan yang akan diedit
        return view('pages.guru.sekolah.tingkatan.edit', compact(['tingkatan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TingkatanRequest $request, Tingkatan $tingkatan)
    {
        //ambil request data tingkatan
        $data = $request->all();

        //update data tingkatan
        $tingkatan = $tingkatan->update($data);

        if ($tingkatan) {
            return redirect()->route('dashboard.tingkatan.index')->with('success', 'Update data sukses!');
        } else {
            return redirect()->route('dashboard.tingkatan.index')->with('failed', 'Update data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tingkatan $tingkatan)
    {
        //hapus data tingkatan
        $tingkatan = $tingkatan->delete();

        if ($tingkatan) {
            return redirect()->route('dashboard.tingkatan.index')->with('success', 'Delete data sukses!');
        } else {
            return redirect()->route('dashboard.tingkatan.index')->with('failed', 'Delete data gagal!');
        }
    }
}
