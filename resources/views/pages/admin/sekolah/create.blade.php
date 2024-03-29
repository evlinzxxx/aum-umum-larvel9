@extends('layouts.teacher')

@section('content')
    
{{-- Start section title data --}}
<section class="p-3">
    <header>
      <h3>Tambah Data Sekolah</h3>
    </header>
</section>
{{-- End section title data --}}

{{-- Start example data --}}
  <h5 class="text-danger" style="font-style: italic">Sesuaikan format nama sekolah seperti contoh di bawah ini !</h5>
  <h6 class="px-1">CONTOH : <span style="font-weight:bold">SMAN 6 Kota Bengkulu</span> </h6>
{{-- End example data --}}

{{-- Start form add sekolah --}}  
<div class="row mt-4">
    <div class="col">
        <form action="{{ route('dashboard.sekolah.store')}}" method="post" enctype="multipart/form-data" >
            @csrf
            
            <div class="flex-wrap mb-6 -mx-3">
                <div class="w-full px-3">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="sekolah">Nama Sekolah</label>
                    <input name="sekolah" id="sekolah" type="text" value="{{ old('sekolah')}}" class="form-control @error('sekolah') is-invalid @enderror">
                        @error('sekolah')
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

        </form>
    </div>
</div>
{{-- End form add sekolah --}}  

@endsection