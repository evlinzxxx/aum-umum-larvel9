@extends('layouts.teacher')

@section('content')

<section class="p-3">
    <header>
      <h3>Data Jurusan</h3>
      <div class="data mt-4" style="display: flex">
        <a href="{{ route('dashboard.sekolah.index') }}" class="item-menu">
          <i class="icon ic-stats"></i>
          Data Sekolah
        </a>
        <a href="{{ route('dashboard.tingkatan.index') }}" class="item-menu @if(Request::is('dashboard/tingkatan')) active @endif">
          <i class="icon ic-stats"></i>
          Data Tingkatan
        </a>
        <a href="{{ route('dashboard.jurusan.index') }}" class="item-menu">
          <i class="icon ic-stats"></i>
          Data Jurusan
        </a>
        <a href="{{ route('dashboard.kelas.index') }}" class="item-menu">
          <i class="icon ic-stats"></i>
          Data Kelas
        </a>
      </div>
    </header>
  </section>

  <div class="mb-5 ">
  <a href="{{ route('dashboard.tingkatan.create') }}" class="btn btn-outline-info"><i class="fa-solid fa-plus"></i> Tambah Data</a>
</div>

  <div class="data-tingkatan">
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
                <th>Nama tingkatan</th>
                <th>Action</th>
            </tr>
        </thead>
        @foreach ($tingkatans as $tingkatan)
        <tbody>    
            <tr>
                <td>{{ $tingkatan->tingkatan }}</td>
            <td>
                {{-- {{ Form::open(['route'=>['product.destroy',$product->id], 'method'=>'delete']) }} --}}
                <form action="{{ route('dashboard.tingkatan.destroy',$tingkatan->tingkatan) }}" id="delete-form{{ $tingkatan->tingkatan }}" method="post">
                    @csrf
                        @method('delete')
                <div class="btn-group" >
                <a href="{{ route('dashboard.tingkatan.edit',['tingkatan'=>$tingkatan->tingkatan]) }}" class="btn btn-warning">
                <i class="fas fa-pen"></i>
                </a>
                <button type="submit" class="btn btn-danger" onclick="if(confirm('Sure to delete?')){
                    event.preventDefault();
                    document.getElementById('delete-form{{ $tingkatan->tingkatan }}').submit();
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
