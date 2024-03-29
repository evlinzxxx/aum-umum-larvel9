@extends('layouts.teacher')

@section('content')
{{-- Start section title data --}}
<section class="p-3">
    <header>
        <h3>Hasil Analisis Individu</h3>
        <div class="data mt-4" style="display: flex">
            <a href="{{ route('dashboard.hasilIndividu.index') }}" class="item-menu @if(Request::is('dashboard/hasilIndividu/index')) active @endif">
                <i class="icon ic-stats"></i>
                Analisis Individu
            </a>
        </div>
    </header>
</section>
{{-- End section title data --}}


{{-- Start Searching Data --}}
<div class="card p-4 mb-5">
    <h3>Cari Data</h3>
        <form action="{{ route('dashboard.hasilIndividu.index') }}" method="get">
            <div class="row">
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
<div class="card-body">
    <table id="datatables" class="table table-bordered" >
        <thead>
            <tr>
                <th>Asal Sekolah</th>
                <th>NISN</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($siswas as $siswa)
        <tbody>    
           <tr>
               <td>{{ $siswa->sekolah }}</td>
               <td>{{ $siswa->nisn }}</td>
               <td>{{ $siswa->nama }}</td>
               <td>{{ $siswa->tingkatan }} {{ $siswa->jurusan }} {{ $siswa->kelas }}</td>
               <td>
                   <form >
                        <a href="{{ route('dashboard.hasilIndividu.show',['user'=>$siswa->nisn]) }}" class="btn btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    </form>  
               </td>
           </tr>
        </tbody>
        @endforeach
    </table>
    {{ $siswas->links('pagination::bootstrap-5') }}
</div>
{{-- End Index Data --}}

@endsection

