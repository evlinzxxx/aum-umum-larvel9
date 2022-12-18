@extends('layouts.user')

@section('main')

{{-- Start section end test --}}
<div class="text-center">
  <div class="w-56 flex p-5">
    <img
    src="/frontend1/images/done.svg"
    alt="Logo"
    width="400px"
    height="400px"
    />
  </div>
  <h2 class="mb-3" >Selamat kamu sudah menjawab <br> <span class="fw-bold text-danger px-1">225</span>pertanyaan AUM Umum</h2>
  <p>Klik tombol Lihat Hasil, untuk mendapatkan kesimpulan dari Tes AUM Umum Kamu</p>
  <a  href="{{ route('user.hasilAkhir') }}" class="btn btn-warning"><i class="bi bi-file-earmark-text-fill"></i>Lihat Hasil</a>
</div>
{{-- End section end test --}}



@endsection