<header id="header" class="fixed-top d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">

    <div class="logo">
      <h1 class="text-light">@guest <a href="{{ url('/') }}"><img
        src="/frontend1/images/ic_siaum.svg"
        alt="Logo"
        width="240px"
        height="180px"
      /></a> @endguest
        @auth
        <a href="{{ route('siswa.home') }}"><img
          src="/frontend1/images/ic_siaum.svg"
          alt="Logo"
          width="140px"
          height="80px"
        /></a>
      @endauth</h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
    </div>

    <nav id="navbar" class="navbar">
      <ul>
        @guest
        <li><a class="nav-link scrollto" href="{{ url('/') }}">Beranda</a></li>
        <li><a class="nav-link scrollto" href="#about">Tentang AUM Umum</a></li>
        <li><a class="nav-link scrollto" href="#problem">Bidang Masalah</a></li>
        <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
        <li><a class="getstarted scrollto" href="{{ route('login') }}">Login</a></li>  
        @endguest
        @auth
        <li><a class="nav-link scrollto" href="{{ route('siswa.home') }}">Beranda</a></li>
        <li><a class="nav-link scrollto" href="{{ route('user.hasilAkhir') }}">Hasil Tes</a></li>
        <li><a class="nav-link scrollto" href="{{ route('user.show',[Auth::guard('user')->user()->nisn]) }}">Profile</a></li>
        <li><a class="getstarted scrollto" href="{{ route('logout') }}">Logout</a></li> 
        @endauth
      </ul>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->