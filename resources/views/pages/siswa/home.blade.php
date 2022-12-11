@extends('layouts.user')

@section('main')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center mb-5">

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="col-md-15 offset">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close px-9" data-bs-dismiss="alert" aria-label="Close">
                </button>
            </div>
                @elseif(session('failed'))
                <div class="alert alert-danger alert-dismissible fade show" >
                    {{ session('failed') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                  </div>
            @endif
        </div>
        </div>
      <div class="row gy-4 px-5">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Sistem Informasi <br> Alat Ungkap Masalah Umum </h1>
          <h2>Menganalisis 10 jenis bidang masalah umum <br> kepribadian mu!</h2>
          <div>
            <a href="#start" class="btn-get-started scrollto">Mulai Sekarang</a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img">
          <img src="/assets/img/dream2.svg" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <!-- ======= Contact Us Section ======= -->
  <section id="tahapan" class="contact mt-5">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Tahapan</h2>
        <p>Langkah-langkah tes AUM Umum</p>
      </div>

        <div class="col-lg-15 mt-5 mt-lg-0 d-flex align-items-stretch text-center" data-aos="fade-up" data-aos-delay="200">
          <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="form-group col-md-12">
                <h4 for="name">Berikut adalah tahapan untuk melakukan tes AUM Umum :</h4>
              </div>
              <div class="form-group col-md-12">
                <h5 for="name">1. Klik <a href="#hero">Mulai Sekarang</a> untuk memulai test AUM Umum ini</h5>
              </div>
              <div class="form-group col-md-12">
                <h5 for="name">2. Anda akan disuguhkan 225 pertanyaan tentang permasalahan umum</h5>
              </div>
              <div class="form-group col-md-12">
                <h5 for="name">3. Anda akan diminta untuk menjawab "Ya" atau "Tidak" pada setiap permasalahan yang ditampilkan </h5>
              </div>
              <div class="form-group col-md-12">
                <h5 for="name">4. Pastikan semua pertanyaan sudah terjawab</h5>
              </div>
              <div class="form-group col-md-12">
                <h5 for="name">5. Setelah selesai menjawab pertanyaan, jangan lupa mengklik tombol  SELESAI</h5>
              </div>
          </form>
        </div>

      </div>
  </section><!-- End Contact Us Section -->

  <section id="start">
  <section id="hero" class="d-flex align-items-center mb-5" data-aos="fade-up">

    <div class="container">
      <div class="row">
      <div class="row gy-4">
              @if($hasil==10)
              <div class="col-lg-6 order-1 order-lg-2 hero-img" style="margin-left: 450px">
                <img src="/assets/img/end.svg" width="400" alt="">
                <form action="{{ route('user.hapusTest',[Auth::guard('user')->user()->nisn]) }}" id="delete-form{{ Auth::guard('user')->user()->nisn }}" method="post">
                  @csrf
                  @method('delete')
                  <a href="{{ route('user.hasilAkhir') }}"  style="margin-left: 60px"  class="btn-get-started scrollto mb-5">Lihat Hasil</a>
              <button style="border:none;"  type="submit" class="btn-get-started scrollto" onclick="if(confirm('Yakin untuk tes ulang?  Data hasil tes sebelumnnya akan hilang')){
                  event.preventDefault();
                  document.getElementById('delete-form{{ Auth::guard('user')->user()->nisn }}').submit();
              }else{
                  event.preventDefault();
              }">Tes Ulang
              </button>
            </form>

          </div>
              @elseif($jawabans>=1)
              <div class="col-lg-6 order-1 order-lg-2 hero-img" style="margin-left: 450px">
                <img src="/assets/img/continue.svg" width="450" alt="">
              <a href="{{ route('user.test',[Auth::guard('user')->user()->nisn]) }}"  style="margin-left: 100px"  class="btn-get-started scrollto mb-5">Lanjutkan Pengerjaan</a>
          </div>
              @elseif($jawabans==null)
              <div class="col-lg-6 order-1 order-lg-2 hero-img" style="margin-left: 450px">
                <img src="/assets/img/start.svg" width="450" alt="">
              <a href="{{ route('user.test',[Auth::guard('user')->user()->nisn]) }}" style="margin-left: 130px" class="btn-get-started scrollto mb-5">Mulai Sekarang</a>
          </div>
              @endif
      </div>
    </div>
  </section>
  </section><!-- End Hero -->
    
@endsection

