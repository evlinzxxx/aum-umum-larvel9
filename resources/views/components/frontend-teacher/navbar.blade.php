<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <div>
        <button
          class="sidebarCollapseDefault btn p-0 border-0 d-none d-md-block"
          aria-label="Hamburger Button"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
        <button
          data-bs-toggle="offcanvas"
          data-bs-target=".sidebar"
          aria-controls="sidebar"
          aria-label="Hamburger Button"
          class="sidebarCollapseMobile btn p-0 border-0 d-block d-md-none"
        >
          <i class="fa-solid fa-bars"></i>
        </button>
      </div>
      <div class="d-flex align-items-center justify-content-end gap-4">
        <img
          src="{{ asset('uploads/guru/'. Auth::guard('guru')->user()->url_photo) }}"
          alt="Photo Profile"
          class="avatar"
        />
      </div>
    </div>
    <div class="btn-group dropstart">
      <button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
        {{ Auth::guard('guru')->user()->nama }}
      </button>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('dashboard.guru.show',['guru'=>Auth::guard('guru')->user()->nip]) }}">Profile</a></li>
        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
      </ul>
    </div>
  </nav>