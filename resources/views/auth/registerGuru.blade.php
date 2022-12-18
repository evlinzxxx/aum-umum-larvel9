@extends('layouts.app')
<link rel="icon" href="/frontend1/images/teachers2.svg" />
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title ?? "" }}</div>

                <div class="card-body">
                        <form method="POST" action="{{ route('guru.register') }}" enctype="multipart/form-data">
                        @csrf

                        <div id="role" class="role text-center flex">
                            <h2>Registrasi</h2>
                             <a>
                                 <img
                                 src="/frontend1/images/teachers2.svg"
                                 alt="Teacher"
                                 width="140px"
                                 height="140px"
                                 /></a>
                        </div>
                        <br>

                        {{-- Start form registerGuru --}}
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
                            <label for="nip" class="col-md-4 col-form-label text-md-end">{{ __('NIP') }}</label>

                            <div class="col-md-5">
                                <input id="nip" type="nip" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus>

                                @error('nip')
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
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

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
{{-- End form registerGuru --}}
@endsection