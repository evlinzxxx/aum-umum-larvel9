@extends('layouts.app')
<link rel="icon" href="/frontend2/dream.svg" />

@section('content')
<body>
    <div id="app">

        <h1 class="mt-5 text-center">
            Registrasi Sebagai
          </h1>
<div class="text-center">
          <a class="" href="{{ route('siswa.register-view') }}">
            <div class="w-56 items-center flex mt-5">
                <img
                src="/frontend2/student.svg"
                alt="UserRegister"
                width="450px"
                height="300px"
              />
            </a>

        <a class="" href="{{ route('guru.register-view') }}">
            <img
                  src="/frontend2/teachers.svg"
                  alt="TeacherRegister"
                  width="450px"
                  height="300px"
                />
            </a>
        </div>

    </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
@endsection
