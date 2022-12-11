<?php

namespace App\Http\Controllers;

use App\Http\Requests\JurusanRequest;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusans = Jurusan::all();

        return view('pages.guru.sekolah.jurusan.index', compact((['jurusans'])));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru.sekolah.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurusanRequest $request)
    {
        $jurusan = $request->all();

        $jurusan = Jurusan::create($jurusan);

        if ($jurusan) {
            return redirect()->route('dashboard.jurusan.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.jurusan.index')->with('failed', 'Tambah data gagal!');
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
    public function edit(Jurusan $jurusan)
    {
        return view('pages.guru.sekolah.jurusan.edit', compact(['jurusan']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JurusanRequest $request, Jurusan $jurusan)
    {
        $data = $request->all();
        
        $jurusan = $jurusan->update($data);

        if ($jurusan) {
            return redirect()->route('dashboard.jurusan.index')->with('success', 'Update data sukses!');
        } else {
            return redirect()->route('dashboard.jurusan.index')->with('failed', 'Update data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jurusan $jurusan)
    {
        $jurusan = $jurusan->delete();

        if ($jurusan) {
            return redirect()->route('dashboard.jurusan.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.jurusan.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
