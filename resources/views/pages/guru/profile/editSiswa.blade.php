@extends('layouts.teacher')

@section('content')

{{-- Start section title data --}}
<section class="p-3">
    <header>
      <h3>Edit Siswa&raquo; {{ $siswa->nama }}</h3>
    </header>
</section>
{{-- End section title data --}}

{{-- Start section edit profile --}}
<div class="row">
  <div class="col">
    <form action="{{ route('dashboard.siswa.update', $siswa->nisn) }}" method="post" enctype="multipart/form-data" >
            @method('put')
            @csrf
            
      <div class="card-body px-5">
          <div class="form-group row mb-3" >
              <h5 class="px-1 mb-2">NISN : {{ $siswa->nisn }}</h5>
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
                  <select class="form-select @error('tingkatan') is-invalid @enderror" name="tingkatan" id="tingkatan">
                    @foreach ($tingkatans as $tingkatan)
                      <option value="{{ $tingkatan->tingkatan }}" {{ old('tingkatan') == $tingkatan->tingkatan ? 'selected' : null }}>{{ $tingkatan->tingkatan }}</option>
                    @endforeach
                  </select>
                  <label for="floatingSelectGrid">Tingkatan</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <select class="form-select @error('jurusan') is-invalid @enderror" name="jurusan" id="jurusan">
                    @foreach ($jurusans as $jurusan)
                      <option value="{{ $jurusan->jurusan }}" {{ old('jurusan') == $jurusan->jurusan ? 'selected' : null }}>{{ $jurusan->jurusan }}</option>
                    @endforeach
                  </select>
                  <label for="floatingSelectGrid">Jurusan</label>
                </div>
              </div>
              <div class="col-md">
                <div class="form-floating">
                  <select class="form-select @error('kelas') is-invalid @enderror" name="kelas" id="kelas">
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
            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
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
        
        <div class="form-group row mb-3" >
            <label for="url_photo" class="px-1 mb-2">Photo</label>
            <div class="mt-1"><img src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}" id="url_photo" width="150"></div>
            <input id="url_photo" type="file" class="form-control @error('url_photo') is-invalid @enderror mt-4" value="nullable"  name="url_photo"
            accept="image/*" onchange="document.getElementById('output').src=window.URL.createObjectURL(this.files[0])">

              @error('url_photo')
              <span class="invalid-feedback">{{ $message }}</span>  
              @enderror

            <div class="mt-3"><img src="" id="output" width="150"></div>
        </div>

        <div class="card-footer">
          <a href="{{ route('dashboard.siswa.index') }}" class="btn btn-outline-info">Kembali</a>
          <button type="submit" class="btn btn-primary float-right">Edit User</button>
        </div>

      </div>
    </form>
  </div>
</div>

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
    document.getElementsByName('kelas')[0].value = "{{ $siswa->kelas}}";
    </script>

{{-- End section edit profile --}}
@endsection