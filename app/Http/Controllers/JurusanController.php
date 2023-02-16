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
        //menampilkan index data jurusan
        $jurusans = Jurusan::all();

        return view('pages.admin.sekolah.jurusan.index', compact((['jurusans'])));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //menampilkan form tambah jurusan
        return view('pages.admin.sekolah.jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JurusanRequest $request)
    {
         //ambil request data jurusan
        $jurusan = $request->all();

        //simpan data jurusan
        $jurusan = Jurusan::create($jurusan);

        if ($jurusan) {
            return redirect()->route('dashboard.jurusan.index')->with('success', 'Tambah data sukses!');
        } else {
            return redirect()->route('dashboard.jurusan.index')->with('failed', 'Tambah data gagal!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jurusan $jurusan)
    {
        //menampilkan data jurusan yang akan diedit
        return view('pages.admin.sekolah.jurusan.edit', compact(['jurusan']));
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
        //ambil request data jurusan
        $data = $request->all();
        
        //update data jurusan
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
        //hapus data jurusan
        $jurusan = $jurusan->delete();

        if ($jurusan) {
            return redirect()->route('dashboard.jurusan.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.jurusan.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
