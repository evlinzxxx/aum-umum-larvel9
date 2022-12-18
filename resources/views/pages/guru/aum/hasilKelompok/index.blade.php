@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
    <header>
        <h3>Hasil Analisis Kelompok &raquo; Cari Data</h3>
        <div class="data mt-4" style="display: flex">
            <a href="{{ route('dashboard.hasilKelompok.pilihShow') }}" class="item-menu @if(Request::is('dashboard/hasilKelompok/pilihShow')) active @endif">
                <i class="icon ic-stats"></i>
                Hasil Analisis 
            </a>
            <a href="{{ route('dashboard.hasilKelompok.pilih') }}" class="item-menu">
                <i class="icon ic-stats"></i>
                Tambah Data 
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
            <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @elseif(session('gagal'))
        <div class="alert alert-danger alert-dismissible fade show" >
            {{ session('gagal') }}
            <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
</div>
{{-- End alert data --}}
  
{{-- Start Searching Data --}}
<div class="card p-4 mb-5">
    <h3>Cari Data</h3>
    <form action="{{ route('dashboard.hasilKelompok.index') }}" method="get">
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
{{-- End Searching Data --}}


{{-- Start Index Data --}}
@isset($data1,$data2,$data3,$data4)
<div class="card-body">
    <table id="datatables" class="table table-bordered" >
        <thead>
            <tr>
                <th>Asal Sekolah</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>    
            <tr>
                <td>{{ $data1 }}</td>
                <td>{{ $data2 }} {{ $data3 }} {{ $data4 }}</td>
                <td>
                    <form action="{{ route('dashboard.hasilKelompok.destroy',[$data1, $data2, $data3, $data4]) }}" id="delete-form{{ $data1}}{{ $data2 }}{{ $data3 }}{{ $data4 }}" method="post">
                        @csrf
                        @method('delete')
                        <div class="btn-group" >
                            <a href="{{ route('dashboard.hasilKelompok.show', ['sekolah'=>$data1 ,'tingkatan'=>$data2, 'jurusan'=>$data3 , 'kelas'=>$data4]) }}" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <button type="submit" class="btn btn-danger" onclick="if(confirm('Yakin hapus data hasil analisis kelompok?')){
                                event.preventDefault();
                                document.getElementById('delete-form{{ $data1}}{{ $data2 }}{{ $data3 }}{{ $data4 }}').submit();
                            }else{
                                event.preventDefault();}">
                                <i class="fas fa-trash" ></i>
                            </button>
                        </div>
                    </form>  
                </td>
            </tr>
        </tbody>
    </table> 
</div>
@endisset
{{-- End Index Data --}}
@endsection

