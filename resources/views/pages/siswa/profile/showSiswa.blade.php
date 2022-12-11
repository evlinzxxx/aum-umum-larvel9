@extends('layouts.user')

<link href="/assets/css/user.css" rel="stylesheet">
@section('main')

<section class="p-0">
    <header>
        <div class="row gy-4 px-5 mt-2">
            <div class="col-lg-6 d-flex flex-column">
              <h3>Profile &raquo; <span class="text-danger"> {{ $siswa->nama }} </span> </h3>
            </div>
        </div>
    </header>
  </section>

  <section id="hero" class="d-flex align-items-center mb-2">

    <div class="container">
        <div class="main-body">    
            <div class="row gutters-sm">
              <div class="col-md-4 mb-2">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                      <img src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}" alt="Admin" class="rounded-circle mt-3" width="200">
                      <div class="mt-3">
                        <h3  style="font-weight: bold">{{ $siswa->nama }}</h3>
                        <p class="text-secondary mb-1">{{ $siswa->sekolah }}</p>
                        <p class="text-muted font-size-sm">NISN : {{ $siswa->nisn }}</p>
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
                        <h6 class="mb-0" style="font-weight: bold">NISN</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ $siswa->nisn }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0" style="font-weight: bold">Nama Lengkap</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ $siswa->nama }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0" style="font-weight: bold">Kelas</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ $siswa->tingkatan}}  {{ $siswa->jurusan}}  {{ $siswa->kelas}}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0" style="font-weight: bold">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ $siswa->email }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0" style="font-weight: bold">Jenis Kelamin</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        {{ $siswa->gender }}
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-12">
                        <a href="{{ route('siswa.home') }}" class="btn btn-outline-info">Back</a>
                        <a href="{{ route('user.edit',[$siswa->nisn]) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ route('user.ubahPassword',[$siswa->nisn]) }}" class="btn btn-dark"><i class="bi bi-shield-lock-fill"></i> <span></span> Ubah Password</a>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
        </div>
      </div>

  </section><!-- End Hero -->


    @endsection