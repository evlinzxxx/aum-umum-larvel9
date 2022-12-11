@include('components.frontend.script')

<body>
  <!-- ======= Header ======= -->
@include('components.frontend.navbar-frontend')

  <main class="main" id="main">

    @yield('main')

  </main><!-- End #main -->
  
  @yield('chart')

@include('components.frontend.footer-frontend')


</body>

</html>