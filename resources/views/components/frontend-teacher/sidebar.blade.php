<nav
class="sidebar offcanvas-md offcanvas-start"
data-bs-scroll="true"
data-bs-backdrop="false"
>
<div class="d-flex justify-content-end m-3 d-block d-md-none">
  <button
    aria-label="Close"
    data-bs-dismiss="offcanvas"
    data-bs-target=".sidebar"
    class="btn p-0 border-0 fs-4"
  >
    <i class="fas fa-close"></i>
  </button>
</div>
<div class="d-flex justify-content-center mt-md-5 mb-5">
    <a class="navbar-brand" href="{{ route('home') }}">
  <img
    src="{{ asset('/frontend1/images/ic_siaum.svg') }}"
    alt="Logo"
    width="140px"
    height="80px"
  /></a>
</div>
<div class="pt-2 d-flex flex-column gap-5">
  @if (Auth::guard('guru')->user())  
  <div class="menu p-0" style="margin-top: -25px">
    <p>Manajemen Utama</p>
    <a href="{{ route('home') }}" class="item-menu @if(Request::is('home')) active @endif">
      <i class="icon ic-stats"></i>
      Dashboard
    </a>
    <a href="{{ route('dashboard.kategori.index') }}" class="item-menu @if(Request::is('dashboard/kategori*')) active @elseif(Request::is('dashboard/pertanyaan*')) active  @endif">
      <i class="icon ic-msg"></i>
      Manajemen <br> AUM Umum
    </a>
    <a href="{{ route('dashboard.hasilIndividu.index') }}" class="item-menu @if(Request::is('dashboard/hasilIndividu*')) active  @endif">
      <i class="icon ic-trans"></i>
      Hasil Analisis <br> Individu
    </a>
    <a href="{{ route('dashboard.hasilKelompok.pilihShow') }}" class="item-menu @if(Request::is('dashboard/hasilKelompok*')) active  @endif">
      <i class="icon ic-trans"></i>
      Hasil Analisis <br> Kelompok
    </a>
  </div>
  <div class="menu" style="margin-top: -25px">
    <p>Others</p>
    <a href="{{ route('dashboard.siswa.index') }}" class="item-menu @if(Request::is('dashboard/guru*')) active @elseif(Request::is('dashboard/siswa*')) active @elseif(Request::is('dashboard/ubahPassword*')) active @elseif(Request::is('dashboard/updatePassword*')) active  @endif">
      <i class="icon ic-account"></i>
      Manajemen <br>Pengguna
    </a>
    @endif
    
    @if (Auth::guard('admin')->user())  
    <div class="menu" style="margin-top: -25px">
      <p>Manajemen Admin</p>
      <a href="{{ route('admin.home') }}" class="item-menu @if(Request::is('admin/home')) active @endif">
        <i class="icon ic-stats"></i>
        Dashboard
      </a>
      <a href="{{ route('dashboard.index.siswa') }}" class="item-menu @if(Request::is('dashboard/guru*')) active @elseif(Request::is('dashboard/siswa*')) active @elseif(Request::is('dashboard/index*')) active @elseif(Request::is('dashboard/ubahPassword*')) active @elseif(Request::is('dashboard/updatePassword*')) active @endif">
        <i class="icon ic-account"></i>
        Manajemen <br>Pengguna
      </a>
    <a href="{{ route('dashboard.sekolah.index') }}" class="item-menu @if(Request::is('dashboard/sekolah*')) active @elseif(Request::is('dashboard/jurusan*')) active  @elseif(Request::is('dashboard/tingkatan*')) active @elseif(Request::is('dashboard/kelas*')) active  @endif">
      <i class="icon ic-settings"></i>
      Manajemen <br>Sekolah
    </a>
    </div>
    @endif

    <a href="{{ route('logout') }}" class="item-menu">
      <i class="icon ic-logout"></i>
      Logout
    </a>
  </div>
</div>
</nav>