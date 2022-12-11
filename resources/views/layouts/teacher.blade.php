
@include('components.frontend-teacher.script')

<body>
  <!-- Nav Sidebar -->
  @include('components.frontend-teacher.sidebar')

  <!-- Main Content -->
  <main class="content">
    @include('components.frontend-teacher.navbar')
    @yield('content')
    @yield('chart')
  </main>
</body>
</html>
