@extends('layouts.app')
<link rel="icon" href="/frontend1/images/students2.svg" />
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title ?? "" }}</div>

                <div class="card-body">
                    <form action="{{ route('siswa.register')}}" method="post" enctype="multipart/form-data" >
                        @csrf

                        <div id="role" class="role text-center flex">
                            <h2>Registrasi</h2>
                             <a>
                                 <img
                                 src="/frontend1/images/students2.svg"
                                 alt="Student"
                                 width="140px"
                                 height="140px"
                                 /></a>
                        </div>
                        <br>

                        {{-- Start form registerSiswa --}}
                        <div class="row mb-3">
                            <label for="sekolah" class="col-md-4 col-form-label text-md-end">Asal Sekolah</label>

                            <div class="col-md-5">
                                <select name="sekolah" id="sekolah" class="form-control @error('sekolah') is-invalid @enderror">
                                    <option disabled selected>Pilih asal sekolah</option>
                                    @foreach ($sekolahs as $sekolah)
                                    <option value="{{ $sekolah->sekolah }}" {{ old('sekolah') == $sekolah->sekolah ? 'selected' : null }} >{{ $sekolah->sekolah }}</option>
                                 @endforeach
                                </select>
                                @error('sekolah')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="nisn" class="col-md-4 col-form-label text-md-end">{{ __('NISN') }}</label>

                            <div class="col-md-5">
                                <input id="nisn" type="nisn" class="form-control @error('nisn') is-invalid @enderror" name="nisn" value="{{ old('nisn') }}" required autocomplete="nisn" autofocus>

                                @error('nisn')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>

                            <div class="col-md-5">
                                <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>

                                @error('nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5 offset-md-4" style="display: flex">
                                <div class="col-md-4">
                                    <div class="form-floating">
                                        <select name="tingkatan" id="tingkatan" class="form-select @error('tingkatan') is-invalid @enderror">
                                            <option disabled selected>Pilih tingkatan</option>
                                          @foreach ($tingkatans as $tingkatan)
                                          <option value="{{ $tingkatan->tingkatan }}" {{ old('tingkatan') == $tingkatan->tingkatan ? 'selected' : null }}>{{ $tingkatan->tingkatan }}</option>
                                       @endforeach
                                      </select>
                                      @error('tingkatan')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                                      <label> Tingkatan</label>
                                      </div>
                                    </div>
                                <div class="col-md-5">
                                    <div class="form-floating px-2">
                                        <select name="jurusan" id="jurusan" class="form-select @error('jurusan') is-invalid @enderror">
                                            <option disabled selected>Pilih jurusan</option>
                                          @foreach ($jurusans as $jurusan)
                                          <option value="{{ $jurusan->jurusan }}" {{ old('jurusan') == $jurusan->jurusan ? 'selected' : null }}>{{ $jurusan->jurusan }}</option>
                                       @endforeach
                                      </select>
                                      @error('jurusan')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                                      <label class="px-4"> Jurusan</label>
                                      </div>
                                    </div>
                                <div class="col-md-3">
                                    <div class="form-floating">
                                        <select name="kelas" id="kelas" class="form-select @error('kelas') is-invalid @enderror">
                                            <option disabled selected>Pilih kelas</option>
                                          @foreach ($kelases as $kelas)
                                          <option value="{{ $kelas->kelas }}" {{ old('kelas') == $kelas->kelas ? 'selected' : null }}>{{ $kelas->kelas }}</option>
                                       @endforeach
                                      </select>
                                      @error('kelas')
                                   <span class="invalid-feedback" role="alert">
                                       <strong>{{ $message }}</strong>
                                   </span>
                               @enderror
                                      <label> Kelas</label>
                                      </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo" class="col-md-4 col-form-label text-md-end">{{ __('password') }}</label>

                            <div class="col-md-5">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Konfirmasi Password') }}</label>

                            <div class="col-md-5">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-2" >
                            <div style="display: flex" class="col-md-8 offset-md-4" >
                                <label>{{ __('Sudah memiliki akun? ') }}</label>
                                <a href="{{ route('login') }}" >{{ __('Login') }}</a>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-5 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrasi') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- End form registerSiswa --}}
@endsection



