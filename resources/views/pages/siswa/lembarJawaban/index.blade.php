@extends('layouts.user')

@section('main')

{{-- Start Student Information --}}
  <section id="answer" class="contact" style="margin-top: -20pt">
    <div class="container">
      <form action="{{ route('user.assign', $siswa->nisn) }}" method="post">
      @csrf
      <div class="card">
        <div class="title p-2 d-flex" style="background-color: #e8f6ffd1">
          <div class="mt-1 px-4"><img src="{{ asset('uploads/siswa/' . $siswa->url_photo) }}" alt="Admin" class="rounded-circle" width="100"></div>
            <div class="p-4 px-4 flex">
              <div class="d-flex">
                <h6 class="mt-2" style="font-weight: bold">Nama Lengkap : {{ $siswa->nama }}</h6>
              </div>
              <div class="d-flex">
                <h6 class="mt-2" style="font-weight: bold">Kelas : {{ $siswa->tingkatan}}  {{ $siswa->jurusan}}  {{ $siswa->kelas}}</h6>
              </div>
            </div>
            <div class="p-3 px-5 flex">
              <div class="d-flex">
                <h6 class="mt-3" style="font-weight: bold">Asal Sekolah : {{ $siswa->sekolah }}</h6>
                </div>
                <div class="d-flex">
                  <h6 class="mt-2" style="font-weight: bold">Jenis Kelamin : {{ $siswa->gender }}</h6>
                </div>
              </div>
              <div class="d-flex">
                <h6 class="mt-4 p-2" style="font-weight: bold">Tanggal Pengisian : {{ $date }}</h6>
              </div>
        </div>
      </div>
{{-- End Student Information --}}

      {{-- Start Rules Information --}}
      <div class="card mt-3 border-danger">
        <div class="mb-2 px-0 " role="alert">
          <div class="px-4 py-3 mt-0 font-bold text-white bg-danger rounded-t">
            <i class="bi bi-exclamation-circle"></i> <span class="px-1">Petunjuk!</span> 
          </div>
          <p class="px-4 mt-3">
            1. Pilih jawaban <span class="fw-bold text-success">Ya</span> atau <span class="fw-bold text-danger">Tidak</span> pada setiap pertanyaan AUM<br>
            2. Klik <span class="fw-bold text-warning">Simpan</span> saat sudah memilih pilihan jawaban<br>
            3. Setelah selesai mengisi pertanyaan, klik tombol <span class="text-primary fw-bold">SELESAI</span>
          </p>                  
        </div>   
      </div>
      {{-- Start End Information --}}

{{-- Start answer --}}
@isset($jawaban)

<div class="accordion accordion-flush mt-2" id="accordionFlushExample">
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        <span style="font-weight: bold">Informasi Jawaban</span>
      </button>
    </h2>
    <hr>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">
        <p class="fw-bold text-success"><i class="bi bi-check-square-fill px-2"></i>Jumlah yang sudah dijawab : {{ $total }}</p>
        @foreach ($jawaban as $answer)
        <a class="badge text-bg-dark" style="font-weight: bold">{{ $answer->kode_pertanyaan }} <span class="px-1"></span>{{ $answer->jawaban }}</a> <span class="px-4"></span>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endisset
{{-- End answer --}}
  
{{-- Start alert --}}
  <div class="row mb-0">
    <div class="col-md-12 mt-4">
    @if (session('failed'))
    <div  class="alert alert-danger alert-dismissible  fade show"><i class="bi bi-exclamation-diamond-fill px-2"></i>
      {{ session('failed') }}
        <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    </div>
  </div>
{{-- End alert --}}
      
      {{-- Start pertanyaan Information --}}
    <div class="card mt-3 border-secondary">
      <div class="col-lg-15 mt-2 p-3">
        @error('jawaban')
        
        <div class="alert alert-danger alert-dismissible fade show" > <i class="bi bi-exclamation-circle"></i>
              {{ $message }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
              </button>
            </div>
          @enderror

          @foreach ($pertanyaans as $pertanyaan)
            @foreach ($pertanyaan->categories as $pertanyaa)
              <div class="card-header">
                <p class="fw-bold text-success">{{ $pertanyaa->nama_kategori }}</p></div>
                <p class="px-3 mt-2" value="{{ $pertanyaan->kode_pertanyaan }}">{{ $pertanyaan->kode_pertanyaan }}<span class="px-2">{{ $pertanyaan->pertanyaan }}</span> </p>
                <div class="px-3">
                  <input type="hidden" name="nisn[{{ $pertanyaan->kode_pertanyaan }}]" value="{{ $siswa->nisn }}">
                  <input type="hidden" name="sekolah[{{ $pertanyaan->kode_pertanyaan }}]" value="{{ $siswa->sekolah }}">
                  <input type="hidden" name="tingkatan[{{ $pertanyaan->kode_pertanyaan }}]" value="{{ $siswa->tingkatan }}">
                  <input type="hidden" name="jurusan[{{ $pertanyaan->kode_pertanyaan }}]" value="{{ $siswa->jurusan }}">
                  <input type="hidden" name="kelas[{{ $pertanyaan->kode_pertanyaan }}]" value="{{ $siswa->kelas }}">
                  <input type="hidden" name="kode_kategori[{{ $pertanyaan->kode_pertanyaan }}]" value="{{ $pertanyaan->kode_kategori }}">
                  <input type="hidden" name="kode_pertanyaan[{{$pertanyaan->kode_pertanyaan}}]" value="{{$pertanyaan->kode_pertanyaan}}">
                  <div class="form-check px-5">
                    <input class="form-check-input" type="radio" name="jawaban[{{ $pertanyaan->kode_pertanyaan }}]" id="Ya" value="Ya">
                      <label class="form-check-label" for="Ya">Ya</label>
                  </div>
                  <div class="form-check px-5 mb-4"> 
                    <input class="form-check-input" type="radio" name="jawaban[{{ $pertanyaan->kode_pertanyaan }}]" id="Tidak" value="Tidak">
                      <label class="form-check-label" for="Tidak">Tidak</label>
                  </div>
            @endforeach
                </div>
          @endforeach
        </div>
    </div>
 
    <button type="submit"  class="d-flex justify-content-start btn btn-danger mt-3"><i class="bi bi-download"></i><span class="px-2">Simpan</span></button>

    @if ($pertanyaans->currentPage() == $pertanyaans->lastPage())
        <a href="{{ route('user.end') }}" style="margin-left: 600px" class="btn btn-warning px-3 mb-4"><i class="bi bi-check2-circle"></i><span class="px-2">Selesai</span></a>
    @endif
      {{-- End pertanyaan Information --}}

      {{-- Start pagination --}}
      <div class="d-flex justify-content-end">
        {{ $pertanyaans->links('pagination::bootstrap-4') }}
      </div>
      {{-- End pagination --}}
    </div>
  </form>
</section>

    <script type="text/javascript">
      window.history.forward();
      function noBack() {
          window.history.forward();
      }
  </script>

@endsection