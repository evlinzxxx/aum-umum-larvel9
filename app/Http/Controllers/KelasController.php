<?php

namespace App\Http\Controllers;

use App\Http\Requests\KelasRequest;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelases = Kelas::all();

        return view('pages.guru.sekolah.kelas.index', compact(['kelases']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.guru.sekolah.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KelasRequest $request)
    {
        $kelas = $request->all();

        $kelas = Kelas::create($kelas);

        if ($kelas) {
            return redirect()->route('dashboard.kelas.index')->with('success', 'Tambah data success!');
        } else {
            return redirect()->route('dashboard.kelas.index')->with('failed', 'Tambah data failed!');
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
    public function edit($kelas)
    {
        return view('pages.guru.sekolah.kelas.edit', compact(['kelas']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$kelas)
    {
        $data = $request->all();

        $data_kelas = Kelas::where('kelas',$kelas)->first();
        
        $kelas = $data_kelas->update($data);

        if ($kelas) {
            return redirect()->route('dashboard.kelas.index')->with('success', 'Update data sukses!');
        } else {
            return redirect()->route('dashboard.kelas.index')->with('failed', 'Update data gagal!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kelas)
    {
        $data_kelas = Kelas::where('kelas',$kelas)->first();
        
        $kelas = $data_kelas->delete();

        if ($kelas) {
            return redirect()->route('dashboard.kelas.index')->with('success', 'Hapus data sukses!');
        } else {
            return redirect()->route('dashboard.kelas.index')->with('failed', 'Hapus data gagal!');
        }
    }
}
