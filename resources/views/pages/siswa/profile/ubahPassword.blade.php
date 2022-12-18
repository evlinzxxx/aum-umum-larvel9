@extends('layouts.user')
<link href="/assets/css/user.css" rel="stylesheet">
@section('main')

{{-- Start section title data --}}
<section class="p-1">
  <header>
      <div class="row gy-4 px-5 mt-2">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>Ubah Password </h1>
          </div>
      </div>
  </header>
</section>
{{-- End section title data --}}


<div class="container-xl px-4 mt-4">
  <form action="{{ route('user.updatePassword', $siswa->nisn) }}" method="post">
    @csrf
  <hr class="mt-0 mb-4">
  {{-- Start alert data --}}
          <div class="row mb-0">
            <div class="col-md-15">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible  fade show">
                {{ session('success') }}
                <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @elseif(session('failed'))
            <div class="alert alert-danger alert-dismissible fade show" >
                {{ session('failed') }}
                <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            </div>
        </div>
        {{-- End alert data --}}

         {{-- Start form edit password --}}
         <div class="card mb-4">
             <div class="card-header">Ubah Password</div>
                <div class="card-body ">
                    <div class="row mb-3">
                        <label for="old-password" class="col-md-4 col-form-label text-md-end">{{ __('Password Lama') }}</label>

                            <div class="col-md-5">
                                <input id="old-password" type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="new-password">
                                @error('old-password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                        <div class="row mb-3">
                            <label for="new-password" class="col-md-4 col-form-label text-md-end">{{ __('Password Baru') }}</label>

                            <div class="col-md-5">
                                <input id="new-password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required autocomplete="new-password">
                                @error('new_password')
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
                        
                        <div class="mt-5">
                            <a href="{{ route('user.show',[$siswa->nisn]) }}" class="btn btn-outline-info">Kembali</a>
                            <button type="submit" class="btn btn-primary float-right">Ubah Password</button>
                        </div>
    </form>
</div>
{{-- End form edit password --}}
@endsection