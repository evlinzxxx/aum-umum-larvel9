@extends('layouts.teacher')

@section('content')
    
<section class="p-3">
    <header>
      <h3>Tambah Data Jurusan</h3>
    </header>
  </section>

  <h5 class="text-danger" style="font-style: italic">Gunakan huruf kapital seperti contoh di bawah ini !</h5>
  <h6 class="px-1">CONTOH : <span style="font-weight:bold">MIPA</span> </h6>

  <div class="row mt-4">
    <div class="col">
        <form action="{{ route('dashboard.jurusan.store')}}" method="post" enctype="multipart/form-data" >
            @csrf

            <div class="flex-wrap mb-6 -mx-3">
                <div class="w-full px-3">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="school_name">Jurusan</label>
                    <input name="jurusan" id="jurusan" type="text" value="{{ old('jurusan')}}" class="form-control @error('jurusan') is-invalid @enderror">
                    @error('jurusan')
                    <span class="invalid-feedback">{{ $message }}</span>  
                    @enderror
                </div>
            </div>


        <div class="flex-wrap mb-6 -mx-3">
            <div class="w-full px-3 mt-4">
                <button type="submit" class="hover:bg-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" >
                   Tambah Data
                </button>
            </div>
        </div>

@endsection