@extends('layouts.user')
<link href="/assets/css/user.css" rel="stylesheet">
@section('main')

{{-- Start section title data --}}
<section class="p-1">
  <header>
      <div class="row gy-4 px-5 mt-2">
          <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h1>Edit &raquo; <span class="text-danger"> {{ $siswa->nama }} </span> </h1>
          </div>
      </div>
  </header>
</section>
{{-- End section title data --}}

{{-- Start section edit profile --}}
<div class="container-xl px-4 mt-4">
  <form action="{{ route('user.update', $siswa->nisn) }}" method="post" enctype="multipart/form-data" >
    @method('put')
    @csrf
  <hr class="mt-0 mb-4">
  <div class="row">
    <div class="col-xl-4">
      <div class="card mb-4 mb-xl-0">
        <div class="card-header">Photo</div>
          <div class="card-body text-center">
            <div class="mt-1"><img src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}" alt="Admin" class="rounded-circle" width="200"></div>
              <input id="url_photo" type="file" class="form-control @error('url_photo') is-invalid @enderror mt-4" name="url_photo"
              accept="image/*" onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])">
                  @error('url_photo')
                  <span class="invalid-feedback">{{ $message }}</span>  
                  @enderror
                  
                  <div class="mt-3"><p>Preview</p><img src="" id="output" class="rounded-circle" width="200"></div>
          </div>
      </div>
    </div>

      <div class="col-xl-8">
        <div class="card mb-4">
          <div class="card-header">Detail Profile</div>
            <div class="card-body">
              <div class="card-body ">
                <div class="form-group row mb-3" >
                  <label for="nisn" class="px-1 mb-2">NISN</label>
                    <input type="text" readonly name="nisn" class="form-control @error('nisn') is-invalid @enderror" value="{{ $siswa->nisn }}">
                </div>
                      
                <div class="form-group row mb-3" >
                  <label for="sekolah" class="px-1 mb-2" >Asal Sekolah</label>
                  <select name="sekolah" id="sekolah" class="form-control @error('sekolah') is-invalid @enderror">
                    @foreach ($sekolahs as $sekolah)
                    <option value="{{ $sekolah->sekolah }}" {{ old('sekolah') == $sekolah->sekolah ? 'selected' : null }}>{{ $sekolah->sekolah }}</option>
                    @endforeach
                  </select>
                    @error('sekolah')
                    <span class="invalid-feedback">{{ $message }}</span>  
                    @enderror
                </div>
              
                <div class="form-group row mb-3" >
                  <label for="nama" class="px-1 mb-2">Nama Lengkap</label>
                  <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ $siswa->nama }}">
                    @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>  
                    @enderror
                </div>
              
                <div class="row g-3 mb-3">
                  <label for="class" class="px-1">Kelas</label>
                    <div class="col-md">
                      <div class="form-floating">
                        <select class="form-select  @error('tingkatan') is-invalid @enderror" name="tingkatan" id="tingkatan">
                          @foreach ($tingkatans as $tingkatan)
                          <option value="{{ $tingkatan->tingkatan }}"  {{ old('tingkatan') == $tingkatan->tingkatan ? 'selected' : null }}>{{ $tingkatan->tingkatan }}</option>
                          @endforeach
                        </select>
                        <label for="floatingSelectGrid">Tingkatan</label>
                      </div>
                    </div>
                    
                    <div class="col-md">
                      <div class="form-floating">
                        <select class="form-select  @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan">
                          @foreach ($jurusans as $jurusan)
                          <option value="{{ $jurusan->jurusan }}"  {{ old('jurusan') == $jurusan->jurusan ? 'selected' : null }}>{{ $jurusan->jurusan }}</option>
                          @endforeach
                        </select>
                        <label for="floatingSelectGrid">Jurusan</label>
                      </div>
                    </div>
                          
                    <div class="col-md">
                      <div class="form-floating">
                        <select class="form-select  @error('kelas') is-invalid @enderror" name="kelas" id="kelas">
                          @foreach ($kelases as $kelas)
                          <option value="{{ $kelas->kelas }}"  {{ old('kelas') == $kelas->kelas ? 'selected' : null }}>{{ $kelas->kelas }}</option>
                          @endforeach
                        </select>
                        <label for="floatingSelectGrid">Kelas</label>
                      </div>
                    </div>
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
                      <input  type="text" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ $siswa->email }}">
                        @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>  
                        @enderror
                    </div>
                    
                    <div class="mt-5">
                      <a href="{{ route('user.show',[$siswa->nisn]) }}" class="btn btn-outline-info">Back</a>
                      <button type="submit" class="btn btn-primary float-right">Edit User</button>
                  </div>
    </form>
  </div>
  {{-- End section edit profile --}}

<script>
    document.getElementsByName('gender')[0].value = "{{ $siswa->gender }}";
    </script>

<script>
    document.getElementsByName('sekolah')[0].value = "{{ $siswa->sekolah }}";
    </script>
<script>
    document.getElementsByName('tingkatan')[0].value = "{{ $siswa->tingkatan }}";
    </script>
<script>
    document.getElementsByName('jurusan')[0].value = "{{ $siswa->jurusan }}";
    </script>
<script>
    document.getElementsByName('kelas')[0].value = "{{ $siswa->kelas }}";
    </script>

@endsection