@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
    <header>
      <h3>Data Pengguna &raquo; Data Siswa</h3>
        <div class="data mt-4" style="display: flex">
            <a href="{{ route('dashboard.index.siswa') }}" class="item-menu @if(Request::is('dashboard/index')) active @endif">
                <i class="icon ic-stats"></i>
                Data Siswa
            </a>
            <a href="{{ route('dashboard.guru.index') }}" class="item-menu ">
                <i class="icon ic-stats"></i>
                Data Guru
            </a>
        </div>
    </header>
</section>
{{-- End section title data --}}

{{-- Start alert data --}}
<div class="row">
    <div class="col">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger alert-dismissible fade show" >
            {{ session('failed') }}
        </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        @endif
    </div>
</div>
{{-- End alert data --}}

{{-- Start searching profile --}}
<div class="card p-4 mb-5">
    <h3>Cari Data</h3>
    <form action="{{ route('dashboard.index.siswa') }}" method="get">
        <div class="row">
            <div class="col-4">
                <label class="visually" style="font-size: 14px"  for="sekolah">Sekolah</label>
                <select class="form-select" name="cari_sekolah" id="sekolah">
                    <option disabled selected> {{ $request->cari_sekolah }}</option>
                    @foreach ($sekolahs as $sekolah)
                    <option value="{{ $sekolah->sekolah }}">{{ $sekolah->sekolah }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <label class="visually" style="font-size: 14px" for="tingkatan">Tingkatan</label>
                <select class="form-select" name="cari_tingkatan" id="tingkatan">
                    <option disabled selected>{{ $request->cari_tingkatan }}</option>
                    @foreach ($tingkatans as $tingkatan)
                    <option value="{{ $tingkatan->tingkatan }}">{{ $tingkatan->tingkatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <label class="visually" style="font-size: 14px" for="jurusan">Jurusan</label>
                <select class="form-select" name="cari_jurusan" id="jurusan">
                    <option disabled selected>{{ $request->cari_jurusan }}</option>
                    @foreach ($jurusans as $jurusan)
                    <option value="{{ $jurusan->jurusan }}">{{ $jurusan->jurusan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <label class="visually" style="font-size: 14px" for="kelas">Kelas</label>
                <select class="form-select" name="cari_kelas" id="kelas">
                    <option disabled selected>{{ $request->cari_kelas }}</option>
                    @foreach ($kelases as $kelas)
                    <option value="{{ $kelas->kelas }}">{{ $kelas->kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 mt-4">
                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass px-2"></i>Cari</button>
            </div>
        </div>
    </form>
</div>
{{-- End searching profile --}}

{{-- Start index profile --}}
<div class="card-body">
    <table id="datatables" class="table table-bordered" >
        <thead>
            <tr>
                <th>Asal Sekolah</th>
                <th>NISN</th>
                <th>Kelas</th>
                <th>Nama</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($siswas as $siswa)
        <tbody>    
            <tr>
                <td>{{ $siswa->sekolah}}</td>
                <td>{{ $siswa->nisn }}</td>
                <td>{{ $siswa->tingkatan}}  {{ $siswa->jurusan}}  {{ $siswa->kelas}}</td>
                <td>{{ $siswa->nama }}<br><i class="fa-solid fa-envelope"></i> <span class="text-primary" style="font-style:italic">{{ $siswa->email }}</span></td>
                <td><img src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}" width="100" alt=""></td>
                <td>
                    <form action="{{ route('dashboard.destroy.siswa',$siswa->nisn) }}" id="delete-form{{ $siswa->nisn }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="btn-group" >
                            <a href="{{ route('dashboard.show.siswa',['siswa'=>$siswa->nisn]) }}" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('dashboard.edit.siswa',['siswa'=>$siswa->nisn]) }}" class="btn btn-warning">
                                <i class="fas fa-pen"></i>
                            </a>
                            <button type="submit" class="btn btn-danger" onclick="if(confirm('Yakin hapus data?')){
                                event.preventDefault();
                                document.getElementById('delete-form{{ $siswa->nisn }}').submit();
                            }else{
                                event.preventDefault();}">
                                    <i class="fas fa-trash" ></i>
                            </button>
                        </div>
                    </form>
                </td>
            </tr>
        </tbody>
        @endforeach
    </table>
    {{-- pagination start --}}
    {{ $siswas->links('pagination::bootstrap-5') }}
    {{-- pagination end --}}
</div>
{{-- End index profile --}} 
@endsection