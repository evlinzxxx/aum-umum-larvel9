@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
  <header>
    <h3>Profile Guru &raquo; <span class="text-primary">  {{ $guru->nama }} </span></h3>
  </header>
</section>
{{-- End section title data --}}

{{-- Start section show profile --}}
<div class="container">
  <div class="main-body">    
    <div class="row gutters-sm">
      <div class="col-md-4 mb-2">
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="{{ asset('uploads/guru/' . $guru->url_photo) }}" alt="Admin" class="rounded-circle mt-3" width="150">
                <div class="mt-3">
                  <h3  style="font-weight: bold">{{ $guru->name }}</h3>
                  <p class="text-secondary mb-1">{{ $guru->sekolah }}</p>
                  <p class="text-muted font-size-sm">NIP : {{ $guru->nip }}</p>
                </div>
            </div>
          </div>
        </div>
      </div>
          
      <div class="col-md-8">
        <div class="card mb-3">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <h6 class="mb-0" style="font-weight: bold">NIP</h6>
              </div>
              <div class="col-sm-9 text-secondary">
                {{ $guru->nip }}
              </div>
            </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0" style="font-weight: bold">Nama Lengkap</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ $guru->nama }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0" style="font-weight: bold">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ $guru->email }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0" style="font-weight: bold">Jenis Kelamin</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    {{ $guru->gender }}
                  </div>
                </div>
                <hr>

                <div class="row">
                  <div class="col-sm-12">
                    <a href="{{ route('dashboard.guru.index') }}" class="btn btn-outline-info">Kembali</a>
                    <a href="{{ route('dashboard.guru.edit',['guru'=>$guru->nip]) }}" class="btn btn-primary">Edit</a>
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
{{-- End section show profile --}}
  
  
@endsection