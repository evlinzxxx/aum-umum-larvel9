@extends('layouts.teacher')

@section('content')

<section class="p-3">
    <header>
      <h3>Data Kategori</h3>
      <div class="data mt-4" style="display: flex">
        <a href="{{ route('dashboard.kategori.index') }}" class="item-menu @if(Request::is('dashboard/kategori')) active @endif">
          <i class="icon ic-stats"></i>
          Data Kategori
        </a>
        <a href="{{ route('dashboard.pertanyaan.index') }}" class="item-menu">
          <i class="icon ic-stats"></i>
          Data Pertanyaan
        </a>
      </div>
    </header>
  </section>

  <div class="mb-5 ">
  <a href="{{ route('dashboard.kategori.create') }}" class="btn btn-outline-info"><i class="fa-solid fa-plus"></i> Tambah Data</a>
</div>

  <div class="data-kategori">
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

<div class="card-body">
    <table id="datatables" class="table table-bordered" >
        <thead>
            <tr>
                <th>Kode Kategori</th>
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($kategoris as $kategori)
        <tbody>    
            <tr>
                <td>{{ $kategori->kode_kategori }}</td>
                <td>{{ $kategori->nama_kategori }}</td>
            <td>
                {{-- {{ Form::open(['route'=>['product.destroy',$product->id], 'method'=>'delete']) }} --}}
                <form action="{{ route('dashboard.kategori.destroy',$kategori->kode_kategori) }}" id="delete-form{{ $kategori->kode_kategori }}" method="post">
                    @csrf
                        @method('delete')
                <div class="btn-group" >
                <a href="{{ route('dashboard.kategori.edit',['kategori'=>$kategori->kode_kategori]) }}" class="btn btn-warning">
                <i class="fas fa-pen"></i>
                </a>
                <button type="submit" class="btn btn-danger" onclick="if(confirm('Yakin hapus data?')){
                    event.preventDefault();
                    document.getElementById('delete-form{{ $kategori->kode_kategori }}').submit();
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
</div>
</div>

@endsection

