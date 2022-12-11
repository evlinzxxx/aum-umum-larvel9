@extends('layouts.teacher')

@section('content')

<header>
  <h3>Hasil Analisis Kelompok &raquo; <span class="text-primary">  {{ $sekolah }}</span> &raquo; <span class="text-primary">{{ $tingkatan }} {{ $jurusan }} {{ $kelas }}</span>  </h3>
</header>

<div class="text-center">
<div class="w-56 flex p-5">
    <img
      src="/frontend1/images/available.svg"
      alt="Logo"
      width="350px"
      height="350px"
    />
  </div>

  <h4 class="mb-1" >Hasil Analisis <span class="text-danger">{{ $tingkatan }} {{ $jurusan }} {{ $kelas }}</span>  sudah tersedia.</h4> <br><p>Silahkan Cari di Index Hasil Analisis Kelompok <br>atau <br>
  Hapus Data dan Buat Ulang Hasil Analisis </p> 
  <div>
    <a href="{{ route('dashboard.hasilKelompok.pilih') }}" class="btn btn-danger"><i class="fa-solid fa-backward px-2"></i>Kembali</a>
  </div>


</div>



@endsection