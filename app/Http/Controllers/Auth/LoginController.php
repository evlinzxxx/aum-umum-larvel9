<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
        $this->middleware('guest:guru')->except('logout');
    }

    public function showLoginForm()
    {
        return view('Auth.login', ['route' => route('login'), 'title' => 'Login']);
    }

    public function login(Request $request)
    {
        $tampung = $request->number;
        $password = $request->password;
        $hitung = strlen($tampung);

        if ($hitung == 10) {
            $nisn = $request->number;
            if (Auth::guard('user')->attempt(['nisn' => $nisn, 'password' => $password], $request->get('remember'))) {
                return redirect()->intended('/siswa/home');
            }
        } elseif ($hitung == 18) {
            $nip = $request->number;
            if (Auth::guard('guru')->attempt(['nip' => $nip, 'password' => $password], $request->get('remember'))) {
                return redirect()->intended('/home');
            }
        }

        return redirect('login')->with('failed', 'NISN / NIP atau Password Salah!');
    }

    public function logout()
    {
        if (Auth::guard('guru')->check()) {
            Auth::guard('guru')->logout();
        } elseif (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }

        return redirect('/');
    }
}
