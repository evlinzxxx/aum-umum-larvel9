@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
    <header>
      <h3>Edit Guru &raquo; {{ $guru->nama }}</h3>
    </header>
</section>
{{-- End section title data --}}

{{-- Start section show profile --}}
<div class="row">
    <div class="col">
        <form action="{{ route('dashboard.guru.update', $guru->nip) }}" method="post" enctype="multipart/form-data" >
            @method('put')
            @csrf
            
            <div class="card-body px-5">
                <div class="form-group row mb-3" >
                    <h5 class="px-1 mb-2">NIP : {{ $guru->nip }}</h5>
                </div>
                <div class="form-group row mb-3" >
                    <label for="sekolah" class="px-1 mb-2" >Asal Sekolah</label>
                    <select name="sekolah" id="sekolah" class="form-control  @error('sekolah') is-invalid @enderror">
                        @foreach ($sekolahs as $sekolah)
                        <option value="{{ $sekolah->sekolah }}"  {{ old('sekolah') == $sekolah->sekolah ? 'selected' : null }}>{{ $sekolah->sekolah }}</option>
                        @endforeach
                    </select>
                        @error('sekolah')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                </div>
                <div class="form-group row mb-3" >
                    <label for="nama" class="px-1 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $guru->nama }}">
                        @error('nama')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                </div>
                <div class="form-group row mb-3" >
                    <label for="gender" class="px-1 mb-2" >Jenis Kelamin</label>
                    <select name="gender" id="gender" class="form-control  @error('gender') is-invalid @enderror">
                        <option disabled selected>Pilih jenis kelamin</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : null }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : null }}>Perempuan</option>
                    </select>
                        @error('gender')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                </div>
                <div class="form-group row mb-3" >
                    <label for="email" class="px-1 mb-2">Email</label>
                    <input  type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $guru->email }}">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                </div>
                <div class="form-group row mb-3" >
                    <label for="url_photo" class="px-1 mb-2">Photo</label>
                    <div class="mt-1"><img src="{{ asset('uploads/guru/' . $guru->url_photo) }}" id="url_photo" width="150"></div>
                        <input id="url_photo" type="file" class="form-control @error('url_photo') is-invalid @enderror mt-4" value="nullable"  name="url_photo"
                        accept="image/*" onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])">
                    
                        @error('url_photo')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                    
                    <div class="mt-3"><img src="" id="output" width="150"></div>
                </div>

                <div class="card-footer">
                    <a href="{{ route('dashboard.guru.index') }}" class="btn btn-outline-info">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Edit User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementsByName('gender')[0].value = "{{ $guru->gender }}";
    </script>

<script>
    document.getElementsByName('sekolah')[0].value = "{{ $guru->sekolah }}";
    </script>

{{-- Start section show profile --}}
@endsection