@extends('layouts.user')

@section('main')

{{-- Start section blank result --}}
<div class="text-center">
<div class="w-56 flex p-5">
    <img
      src="/frontend1/images/empty.svg"
      alt="Logo"
      width="400px"
      height="400px"
    />
  </div>

  <h2 class="mb-3" >Hasil Analisis Mu belum tersedia <br> Lakukan Tes Terlebih dahulu</h2>
  <div>
    <a href="{{ route('siswa.home') }}" class="btn btn-danger"><i class="bi bi-skip-start-fill px-1"></i>Mulai Sekarang</a>
  </div>
</div>
{{-- End section blank result --}}

@endsection