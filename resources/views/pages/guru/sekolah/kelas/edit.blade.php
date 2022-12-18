@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
    <header>
      <h3>Edit Data class &raquo; <span class="text-primary">  {{ $kelas }} </span></h3>
    </header>
</section>
{{-- End section title data --}}

{{-- Start example data --}}
  <h5 class="text-danger" style="font-style: italic">Gunakan angka atau huruf kapital seperti contoh di bawah ini !</h5>
  <h6 class="px-1">CONTOH : <span style="font-weight:bold">1 atau A</span> </h6>
{{-- End example data --}}

{{-- Start form edit kelas --}}
<div class="row mt-4">
    <div class="col">
        <form action="{{ route('dashboard.kelas.update',['kela'=>$kelas]) }}" method="post" enctype="multipart/form-data" >
            @method('put')
            @csrf
            
            <div class="flex-wrap mb-6 -mx-3">
                <div class="w-full px-3">
                    <label class="block mb-2 text-xs font-bold tracking-wide text-gray-700 uppercase" for="class">Nama Kelas</label>
                    <input name="kelas" id="kelas" type="text" value="{{ $kelas}}" class="form-control @error('kelas') is-invalid @enderror">
                        @error('kelas')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                </div>
            </div>
            
            <div class="flex-wrap mb-6 -mx-3">
                <div class="w-full px-3 mt-4">
                    <button type="submit" class="hover:bg-gray-500 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" >
                        Edit Data
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
{{-- End form edit kelas --}}

@endsection