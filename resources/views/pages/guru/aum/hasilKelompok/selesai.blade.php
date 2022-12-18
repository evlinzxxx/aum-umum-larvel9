@extends('layouts.teacher')

@section('content')
{{-- Start section title --}}
<header>
  <h3>Hasil Analisis Kelompok &raquo; <span class="text-primary">  {{ $sekolah }}</span> &raquo; <span class="text-primary">{{ $tingkatan }} {{ $jurusan }} {{ $kelas }}</span>  </h3>
</header>
{{-- End section title --}}

{{-- Start section end result --}}
<div class="text-center">
  <div class="w-56 flex p-5">
    <img
    src="/frontend1/images/done.svg"
    alt="Logo"
    width="400px"
    height="400px"
    />
  </div>
  
  <h2 class="mb-3" >Data Analisis Kelompok {{ $tingkatan }} {{ $jurusan}} {{ $kelas }}  <br> Berhasil Dibuat!</h2>
  
  <p>Cari Data Analisis Di Halaman Analisis Kelompok</p>
  <a  href="{{ route('dashboard.hasilKelompok.show', ['sekolah'=>$sekolah ,'tingkatan'=>$tingkatan, 'jurusan'=>$jurusan , 'kelas'=>$kelas]) }}" class="btn btn-warning"><i class="bi bi-file-earmark-text-fill"></i>Lihat Hasil</a>
</div>
{{-- End section end result --}}
@endsection