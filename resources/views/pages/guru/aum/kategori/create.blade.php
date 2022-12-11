@extends('layouts.teacher')

@section('content')
    
<section class="p-3">
    <header>
        <h3>Data Kategori  &raquo; Tambah Data </h3>
    </header>
  </section>

  <h5 class="text-danger" style="font-style: italic">Sesuaikan format kategori pertanyaan AUM Umum seperti contoh di bawah ini !</h5>
  <h6 class="px-1">CONTOH : <span style="font-weight:bold">Jasmani dan Kesehatan (JDK)</span> </h6>

  <div class="row mt-4">
    <div class="col">
        <form action="{{ route('dashboard.kategori.store')}}" method="post" enctype="multipart/form-data" >
            @csrf

            <div class="flex-wrap mb-6 -mx-3">
                <div class="w-full px-3">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="kode_kategori">Kode Kategori</label>
                    <input name="kode_kategori" id="kode_kategori" type="text" value="{{ old('kode_kategori')}}" class="form-control @error('kode_kategori') is-invalid @enderror">
                    @error('kode_kategori')
                    <span class="invalid-feedback">{{ $message }}</span>  
                    @enderror
                </div>
            </div>
            <div class="flex-wrap mb-6 -mx-3">
                <div class="w-full px-3">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="nama_kategori">Nama Kategori</label>
                    <input name="nama_kategori" id="nama_kategori" type="text" value="{{ old('nama_kategori')}}" class="form-control @error('nama_kategori') is-invalid @enderror">
                    @error('nama_kategori')
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