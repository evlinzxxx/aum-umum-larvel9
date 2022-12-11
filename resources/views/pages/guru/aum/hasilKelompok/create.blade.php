@extends('layouts.teacher')

@section('content')
<section class="p-3">
    <header>
      <h3>Hasil Analisis Kelompok &raquo; Tambah Data</h3>
    <div class="data mt-4" style="display: flex">
      <a href="{{ route('dashboard.hasilKelompok.pilihShow') }}" class="item-menu">
        <i class="icon ic-stats"></i>
        Hasil Analisis 
      </a>
      <a href="{{ route('dashboard.hasilKelompok.pilih') }}" class="item-menu @if(Request::is('dashboard/hasilKelompok/pilih')) active @endif">
        <i class="icon ic-stats"></i>
        Tambah Data 
      </a>
    </div>
    </header>
</section>

<div class="row">
  <div class="col">
          @if(session('failed'))
          <div class="alert alert-danger alert-dismissible fade show" >
              {{ session('failed') }}
          </div>
      @endif
  </div>
</div>

<div class="card p-4 mb-5">
    <h3>Pilih Data Kelompok</h3>
    <form action="{{ route('dashboard.hasilKelompok.hitung') }}" method="get">
<div class="row">
<div class="col-4">
    <label class="visually" style="font-size: 14px"  for="sekolah">Sekolah</label>
    <select class="form-select" name="sekolah" id="sekolah">
        <option> {{ $request->sekolah }}</option>
        @foreach ($sekolahs as $sekolah)
        <option value="{{ $sekolah->sekolah }}">{{ $sekolah->sekolah }}</option>
        @endforeach
    </select>
  </div>
<div class="col-2">
    <label class="visually" style="font-size: 14px" for="tingkatan">Tingkatan</label>
    <select class="form-select" name="tingkatan" id="tingkatan">
        <option>{{ $request->tingkatan }}</option>
        @foreach ($tingkatans as $tingkatan)
        <option value="{{ $tingkatan->tingkatan }}">{{ $tingkatan->tingkatan }}</option>
        @endforeach
    </select>
  </div>
<div class="col-2">
    <label class="visually" style="font-size: 14px" for="jurusan">Jurusan</label>
    <select class="form-select" name="jurusan" id="jurusan">
        <option>{{ $request->jurusan }}</option>
        @foreach ($jurusans as $jurusan)
        <option value="{{ $jurusan->jurusan }}">{{ $jurusan->jurusan }}</option>
        @endforeach
    </select>
  </div>
<div class="col-2">
    <label class="visually" style="font-size: 14px" for="kelas">Kelas</label>
    <select class="form-select" name="kelas" id="kelas">
        <option>{{ $request->kelas }}</option>
        @foreach ($kelases as $kelas)
        <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
        @endforeach
    </select>
  </div>
  <div class="col-2 mt-4">
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus px-2"></i>Buat Analisis</button>
</div>
</div>
</form>
</div>

</div>


@endsection

