@extends('layouts.teacher')

@section('content')

<section class="p-3">
    <header>
      <h3>Data Pertanyaan</h3>
      <div class="data mt-4" style="display: flex">
        <a href="{{ route('dashboard.kategori.index') }}" class="item-menu">
          <i class="icon ic-stats"></i>
          Data Kategori
        </a>
        <a href="{{ route('dashboard.pertanyaan.index') }}" class="item-menu @if(Request::is('dashboard/pertanyaan')) active @endif">
          <i class="icon ic-stats"></i>
          Data Pertanyaan
        </a>
      </div>
    </header>
  </section>

  <div class="mb-5 ">
  <a href="{{ route('dashboard.pertanyaan.create') }}" class="btn btn-outline-info"><i class="fa-solid fa-plus"></i> Tambah Data</a>
</div>

  <div class="data-category">
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
    <form action="{{ route('dashboard.pertanyaan.index') }}" method="get">
<div class="row">
<div class="col-4">
    <label class="visually" style="font-size: 14px"  for="kategori">Kategori</label>
    <select class="form-select" name="cari_kategori" id="kategori">
        <option disabled selected> {{ $request->cari_kategori }}</option>
        @foreach ($kategoris as $kategori)
        <option value="{{ $kategori->kode_kategori }}">({{ $kategori->kode_kategori }}) {{ $kategori->nama_kategori }}</option>
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
                <th>Kategori</th>
                <th>Kode Pertanyaan</th>
                <th>Pertanyaan</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($pertanyaans as $pertanyaan)
        <tbody>    
            <tr>
                <td>{{ $pertanyaan->kode_kategori }}</td>
                <td>{{ $pertanyaan->kode_pertanyaan }}</td>
                <td>{{ $pertanyaan->pertanyaan }}</td>
            <td>
                {{-- {{ Form::open(['route'=>['product.destroy',$product->kode_pertanyaan], 'method'=>'delete']) }} --}}
                <form action="{{ route('dashboard.pertanyaan.destroy',$pertanyaan->kode_pertanyaan) }}" id="delete-form{{ $pertanyaan->kode_pertanyaan }}" method="post">
                    @csrf
                        @method('delete')
                <div class="btn-group" >
                <a href="{{ route('dashboard.pertanyaan.edit',['pertanyaan'=>$pertanyaan->kode_pertanyaan]) }}" class="btn btn-warning">
                <i class="fas fa-pen"></i>
                </a>
                <button type="submit" class="btn btn-danger" onclick="if(confirm('Yakin hapus data?')){
                    event.preventDefault();
                    document.getElementById('delete-form{{ $pertanyaan->kode_pertanyaan }}').submit();
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
    {{ $pertanyaans->links('pagination::bootstrap-5') }}
</div>
</div>

@endsection
