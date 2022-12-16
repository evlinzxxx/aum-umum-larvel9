@extends('layouts.teacher')

@section('content')
<section class="p-3">
    <header>
      <h3>Data Pengguna &raquo; Data Guru</h3>
    <div class="data mt-4" style="display: flex">
      <a href="{{ route('dashboard.guru.index') }}" class="item-menu @if(Request::is('dashboard/guru')) active @endif">
        <i class="icon ic-stats"></i>
        Data Guru
      </a>
      <a href="{{ route('dashboard.siswa.index') }}" class="item-menu">
        <i class="icon ic-stats"></i>
        Data Siswa
      </a>
    </div>
    </header>
  </section>

  <div class="data-teacher">
<div class="row">
    <div class="col">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
            @elseif(session('failed'))
            <div class="alert alert-danger alert-dismissible fade show" >
                {{ session('failed') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        @endif
    </div>
</div>

<div class="card p-4 mb-5">
    <h3>Cari Data</h3>
    <form action="{{ route('dashboard.guru.index') }}" method="get">
<div class="row">
<div class="col-4">
    <label class="visually" style="font-size: 14px"  for="sekolah">Sekolah</label>
    <select class="form-select" name="cari_sekolah" id="sekolah">
        <option> {{ $request->cari_sekolah }}</option>
        @foreach ($sekolahs as $sekolah)
        <option value="{{ $sekolah->sekolah }}">{{ $sekolah->sekolah }}</option>
        @endforeach
    </select>
  </div>
  <div class="col-5 mt-4">
  <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass px-2"></i>Cari</button>
</div>
</div>
</form>
</div>

<div class="card-body">
    <table id="datatables" class="table table-bordered" >
        <thead>
            <tr>
                <th>Asal Sekolah</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($gurus as $guru)
        <tbody>    
            <tr>
                <td>{{ $guru->sekolah}}</td>
                <td>{{ $guru->nip }}</td>
                <td>{{ $guru->nama }}</td>
                <td>{{ $guru->email }}</td>
                <td><img src="{{ asset('uploads/guru/' . $guru->url_photo) }}" width="100" alt=""></td>
            <td>
                {{-- {{ Form::open(['route'=>['product.destroy',$product->id], 'method'=>'delete']) }} --}}
                <form action="{{ route('dashboard.guru.destroy',$guru->nip) }}" id="delete-form{{ $guru->nip }}" method="post">
                    @csrf
                        @method('delete')
                <div class="btn-group" >
                    
                <a href="{{ route('dashboard.guru.show',['guru'=>$guru->nip]) }}" class="btn btn-primary">
                    <i class="fa-solid fa-eye"></i>
                </a>
                <a href="{{ route('dashboard.guru.edit',['guru'=>$guru->nip]) }}" class="btn btn-warning">
                <i class="fas fa-pen"></i>
                </a>
                <button type="submit" class="btn btn-danger" onclick="if(confirm('Yakin hapus data?')){
                    event.preventDefault();
                    document.getElementById('delete-form{{ $guru->nip }}').submit();
                }else{
                    event.preventDefault();
                }">
                    <i class="fas fa-trash" ></i>
                </button>
                </div>
            </form>
                {{-- {{ Form::close() }} --}}
             </td>
            </tr>
        </tbody>
            @endforeach
    </table>
    <div class="my-5">
    {{ $gurus->links('pagination::bootstrap-5') }}
</div>
</div>
</div>

@endsection

