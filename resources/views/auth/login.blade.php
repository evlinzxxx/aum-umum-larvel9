@extends('layouts.app')
<link rel="icon" href="/frontend2/dream.svg" />
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $title ?? "" }}</div>

                <div class="card-body" >
                    <form method="POST" action="{{ route('postLogin') }}">
                        @csrf

                        <div>
                            <div class="w-56 text-center">
                                <h2>Login</h2>
                                <img
                                src="/frontend1/images/login.svg"
                                alt="UserRegister"
                                width="200px"
                                height="200px"
                                class="mb-3"
                              />  
                            </div>
                        </div>
                <br>
                {{-- Start alert data --}}
                <div class="row mb-0">
                    <div class="col-md-7 offset-md-3">
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

            {{-- Start form login --}}
            <div class="row mb-3">
                <label for="number" class="col-md-3 col-form-label text-md-end">{{ __('NISN / NIP') }}</label>
                
                            <div class="col-md-7">
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" value="{{ old('number') }}"autofocus>

                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="password" class="col-md-3 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-2" >
                            <div style="display: flex" class="col-md-8 offset-md-3" >
                                <label>{{ __('Belum memiliki akun? ') }}</label>
                                <a href="{{ route('register') }}" >{{ __('Registrasi') }}</a>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-3">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- End form login --}}

@endsection