@extends('layouts.teacher')

@section('content')

<header>
  <h3>Hasil Analisis Individu &raquo; <span class="text-primary">  {{ $siswa->nama }} </span></h3>
</header>

<div class="text-center">
<div class="w-56 flex p-5">
    <img
      src="/frontend1/images/empty.svg"
      alt="Logo"
      width="400px"
      height="400px"
    />
  </div>

  <h4 class="mb-3" >Hasil Analisis <span class="text-danger">{{ $siswa->nama }}</span>  belum tersedia <br> Minta  <span class="text-danger">{{ $siswa->nama }}</span>  melakukan Tes Terlebih dahulu</h4>
  <div>
    <a href="{{ route('dashboard.hasilIndividu.index') }}" class="btn btn-danger"><i class="fa-solid fa-backward px-2"></i>Kembali</a>
  </div>


</div>



@endsection