@include('components.frontend.script')

<body>

  <!-- ======= Header ======= -->
@include('components.frontend.navbar-frontend')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1>Sistem Informasi <br> Alat Ungkap Masalah Umum </h1>
          <h2>Menganalisis 10 jenis bidang masalah umum <br> kepribadian mu!</h2>
          <div>
            <a href="{{ route('login') }}" class="btn-get-started scrollto">Mulai Sekarang</a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 hero-img">
          <img src="assets/img/dream.svg" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-lg-5 d-flex align-items-center justify-content-center about-img">
            <img src="assets/img/about-img.svg" class="img-fluid" alt="" data-aos="zoom-in">
          </div>
          <div class="col-lg-6 pt-5 pt-lg-0">
            <h3 class="mb-4" data-aos="fade-up">Apa itu Alat Ungkap Masalah Umum?</h3>
            <p data-aos="fade-up" data-aos-delay="100">
              Alat ungkap masalah umum atau biasa disingkat dengan AUM Umum merupakan sebuah instrumen dalam bimbingan dan konseling yang digunakan 
              untuk menemukan dan memahami setiap permasalahan yang dialami oleh siswa. Alat ungkap masalah 
              ini digunakan karena kurangnya pemahaman yang mendalam dari guru bimbingan dan konseling terhadap siswa. 
            </p>
            <p data-aos="fade-up" data-aos-delay="100">
              AUM Umum merupakan sebuah alat yang digunakan untuk mengungkap masalah-masalah siswa, mahasiswa, dan masyarakat 
              secara menyeluruh mengungkapkan masalah-masalah umum. Alat Ungkap Masalah Umum ini didesain untuk mengungkap sepuluh
              bidang masalah yang mungkin dihadapi klien.
            </p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="problem" class="services section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>Bidang Masalah</h2>
          <p>10 Analisis Bidang Masalah</p>
        </div>

        <div class="row">
          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Jasmani dan Kesehatan</a></h4>
              <p class="description">Permasalahan tentang fisik atau jasmani serta kondisi kesehatan seseorang</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Diri Pribadi</a></h4>
              <p class="description">Permasalahan tentang kehawatiran terhadap pengenalan diri</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Hubungan Sosial</a></h4>
              <p class="description">Permasalahan tentang hubungan sosial dengan seseorang maupun dengan orang banyak</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Ekonomi dan Keuangan</a></h4>
              <p class="description">Permasalahan tentang keadaan finansial atau keuangan</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Karir dan Pekerjaan</a></h4>
              <p class="description">Permasalahan tentang perjalanan karir dan pekerjaan yang dihadapi sekarang maupun masa depan</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Pendidikan dan Pelajaran</a></h4>
              <p class="description">Permasalahan dibidang pendidikan khususnya yang sedang dihapai siswa SMA saat ini</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Agama, Nilai, dan Moral</a></h4>
              <p class="description">Permasalahan tentang kepercayaan dan keyakinan dalam agama dan nilai serta moral di lingkungan</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Hubungan Muda Mudi dan Perkawinan</a></h4>
              <p class="description">Permasalahan tentang dunia percintaan maupun kehidupan dengan pasangan</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch"  data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Keadaan dan Hubungan dalam Keluarga</a></h4>
              <p class="description">Permasalahan tentang relasi dan komunikasi antar sesama anggota keluarga</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bx bx-world"></i></div>
              <h4 class="title"><a href="">Waktu Senggang</a></h4>
              <p class="description">Permasalahan tentang pemanfaatan waktu senggang</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-title">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </div>

        <ul class="faq-list" data-aos="fade-up" data-aos-delay="100">

          <li>
            <div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Untuk apasih AUM Umum itu?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq1" class="collapse" data-bs-parent=".faq-list">
              <p>
                Menemukan, menganalisis, dan memahami setiap permasalahan umum yang dialami, khususnya oleh siswa.<br>Sehingga siswa dapat memperbaiki atau mencari jalan keluar untuk setiap permasalahan tersebut.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Apa perbedaan AUM Umum dan AUM PTSDL?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq2" class="collapse" data-bs-parent=".faq-list">
              <p>
               AUM Umum berfokus untuk menganalisis permasalahan seseorang dalam bidang yang umum saja, dan bisa dilakukan oleh semua tingkatan.Mulai dari siswa SD, SMP, SMA, Mahasiswa, dan Masyarakat Umum. 
               Sedangkan AUM PTSDL hanya berfokus pada hal hal yang berhubungan dengan pendidikan.Hanya bisa dilakukan oleh siswa SD, SMP, SMA dan Mahasiswa.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Dalam bentuk apa hasil analisis yang diberikan dari AUM Umum ini?<i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Hasil analisis akan menampilkan semua masalah yang dialami seseorang didalam setiap bidang.Lalu data permaslahan yang diperoleh akan ditampilkan dalam bentuk diagram batang, menampilkan jumlah semua masalah dalam bidang bidang, bahkan nilai permasalahan dengan jumlah terbanyak.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Berapa kali tes AUM Umum ini harus dilakukan? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Tes AUM Umum ini sebaiknnya dilakukan di setiap tahun, atau setiap kenaikan kelas.<br>Sehingga permasalahan yang dianalisis akan terbaharui.
              </p>
            </div>
          </li>

          <li>
            <div data-bs-toggle="collapse" href="#faq5" class="collapsed question">Dengan device atau perangkat apa saja AUM Umum ini dapat diakses? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
            <div id="faq5" class="collapse" data-bs-parent=".faq-list">
              <p>
               Untuk sekarang, AUM Umum ini hanya bisa diakses melalui web browser di PC.<br>Kedepannya mungkin akan dikembangkan dalam versi mobile.
              </p>
            </div>
          </li>

        </ul>

      </div>
    </section><!-- End F.A.Q Section -->

  </main><!-- End #main -->

@include('components.frontend.footer-frontend')

</body>

</html>