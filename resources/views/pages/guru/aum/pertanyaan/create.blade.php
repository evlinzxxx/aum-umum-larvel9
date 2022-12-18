@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
    <header>
        <h3>Data Pertanyaan  &raquo; Tambah Data </h3>
    </header>
</section>
{{-- End section title data --}}

{{-- Start example data --}}
    <h5 class="text-danger px-3" style="font-style: italic">Gunakan tiga digit angka untuk kode pertanyaan seperti contoh di bawah ini !</h5>
    <h6 class="px-3">CONTOH : <span style="font-weight:bold">001</span> </h6>
{{-- End example data --}}

{{-- Start form add data --}}
<div class="row mt-4">
    <div class="col">
        <form action="{{ route('dashboard.pertanyaan.store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            <div class="flex-wrap mb-3 -mx-3">
                <div class="w-full px-3">
                    <label for="kode_kategori" class="px-1 mb-2" >Kategori</label>
                    <br>
                        <select name="kode_kategori" id="kode_kategori" class="form-control @error('kode_kategori') is-invalid @enderror">
                            <option disabled selected>Pilih Kategori</option>
                            @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->kode_kategori }}" {{ old('kode_kategori') == $kategori->kode_kategori ? 'selected' : null }} >({{ $kategori->kode_kategori }})  {{ $kategori->nama_kategori }}</option>
                            @endforeach
                        </select>
                                @error('kode_kategori')
                                <span class="invalid-feedback">{{ $message }}</span>  
                                @enderror
                </div>
            </div>
            
            <div class="flex-wrap mb-4">
                <div class="w-full px-3 col-md-4">
                    <label class="mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="kode_pertanyaan">Kode Pertanyaan</label>
                        <input name="kode_pertanyaan" id="kode_pertanyaan" type="text" value="{{ old('kode_pertanyaan')}}" class="form-control @error('kode_pertanyaan') is-invalid @enderror">
                            @error('kode_pertanyaan')
                            <span class="invalid-feedback">{{ $message }}</span>  
                            @enderror
                </div>
            </div>

            <div class="form-floating w-full px-3">
                <textarea class="form-control @error('pertanyaan') is-invalid @enderror" name="pertanyaan" id="pertanyaan" style="height: 100px">{{ old('pertanyaan') }}</textarea>
                    <label class="px-4" for="pertanyaan"> Pertanyaan</label>
                        @error('pertanyaan')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
            </div>

              <div class="flex-wrap mb-6 -mx-3">
                  <div class="w-full px-3 mt-4">
                      <button type="submit" class="hover:bg-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" >
                          Tambah Data
                        </button>
                  </div>
              </div>
{{-- End form add data --}}
@endsection