 <?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HasilIndividuController;
use App\Http\Controllers\HasilKelompokController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KategoriMasalahController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\LembarJawabanController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\TingkatanController;
use App\Models\HasilIndividu;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'preventBackHistory'], function () {


    Route::get('/', function () {
        return view('layouts.frontend');
    });

    Route::get('/register', [RegisterController::class, 'registerAs'])->name('register');
    Route::get('/guru/register', [RegisterController::class, 'showGuruRegisterForm'])->name('guru.register-view');
    Route::post('/guru/register', [RegisterController::class, 'createGuru'])->name('guru.register');
    Route::get('/siswa/register', [RegisterController::class, 'showSiswaRegisterForm'])->name('siswa.register-view');
    Route::post('/siswa/register', [RegisterController::class, 'createSiswa'])->name('siswa.register');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/postLogin', [LoginController::class, 'login'])->name('postLogin');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/admin/home', [DashboardController::class, 'indexAdmin'])->middleware('auth:admin')->name('admin.home');
    
    Route::get('/siswa/home', [HomeController::class, 'index'])->middleware('auth:user')->name('siswa.home');
    
    Route::get('/home', [DashboardController::class, 'index'])->middleware('auth:guru')->name('home');
    
    Route::middleware('auth:guru')->name('dashboard.')->prefix('dashboard')->group(function () {
        Route::middleware('auth:guru')->group(function () {
            Route::resource('siswa', SiswaController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
            Route::resource('kategori', KategoriMasalahController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::resource('pertanyaan', PertanyaanController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::get('/guru/show/{guru}', [GuruController::class, 'showGuru'])->name('show.guru');
            Route::get('/hasilIndividu/index', [HasilIndividuController::class, 'index'])->name('hasilIndividu.index');
            Route::get('/hasilIndividu/{user}', [HasilIndividuController::class, 'showGuru'])->name('hasilIndividu.show');
            Route::post('/cetakPdf/{user}', [HasilIndividuController::class, 'cetakGuru'])->name('hasilIndividu.cetakPdf');
            Route::get('/hasilKelompok/pilih', [HasilKelompokController::class, 'pilih'])->name('hasilKelompok.pilih');
            Route::get('/hasilKelompok/pilihShow', [HasilKelompokController::class, 'pilihShow'])->name('hasilKelompok.pilihShow');
            Route::get('/hasilKelompok/hitung', [HasilKelompokController::class, 'hitung'])->name('hasilKelompok.hitung');
            Route::get('/hasilKelompok/show/{sekolah}/{tingkatan}/{jurusan}/{kelas}', [HasilKelompokController::class, 'show'])->name('hasilKelompok.show');
            Route::get('/hasilKelompok/index', [HasilKelompokController::class, 'index'])->name('hasilKelompok.index');
            Route::post('/hasilKelompok/destroy/{sekolah}/{tingkatan}/{jurusan}/{kelas}', [HasilKelompokController::class, 'cetakPdf'])->name('hasilKelompok.cetakPdf');
            Route::delete('/hasilKelompok/destroy/{sekolah}/{tingkatan}/{jurusan}/{kelas}', [HasilKelompokController::class, 'destroy'])->name('hasilKelompok.destroy');
            Route::get('/ubahPassword/{guru}', [ChangePasswordController::class, 'ubahPasswordGuru'])->name('ubahPassword');
            Route::post('/updatePassword/{guru}', [ChangePasswordController::class, 'updatePasswordGuru'])->name('updatePassword');
        });
    });


    Route::middleware('auth:admin')->name('dashboard.')->prefix('dashboard')->group(function () {
        Route::middleware('auth:admin')->group(function () {
            Route::resource('guru', GuruController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
            Route::get('/index', [SiswaController::class, 'indexAdmin'])->name('index.siswa');
            Route::get('/siswa/edit/{siswa}', [SiswaController::class, 'editAdmin'])->name('edit.siswa');
            Route::put('/siswa/update/{siswa}', [SiswaController::class, 'updateAdmin'])->name('update.siswa');
            Route::get('/siswa/show/{siswa}', [SiswaController::class, 'showAdmin'])->name('show.siswa');
            Route::delete('/siswa/delete/{siswa}', [SiswaController::class, 'destroyAdmin'])->name('destroy.siswa');
            Route::resource('sekolah', SekolahController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::resource('tingkatan', TingkatanController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::resource('jurusan', JurusanController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
            Route::resource('kelas', KelasController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
        });
    });

    Route::middleware('auth:user')->name('user.')->prefix('user')->group(function () {
        Route::middleware('auth:user')->group(function () {
            Route::get('/show/{user}', [SiswaController::class, 'showSiswa'])->name('show');
            Route::get('/edit/{user}', [SiswaController::class, 'editSiswa'])->name('edit');
            Route::put('/update/{user}', [SiswaController::class, 'updateSiswa'])->name('update');
            Route::get('/test/{user}', [LembarJawabanController::class, 'start'])->name('test');
            Route::post('/assign/{user}', [LembarJawabanController::class, 'assign'])->name('assign');
            Route::get('/end', [LembarJawabanController::class, 'end'])->name('end');
            Route::get('/hasil', [HasilIndividuController::class, 'hitung'])->name('hitung');
            Route::get('/endPage', [HasilIndividuController::class, 'endPage'])->name('endPage');
            Route::get('/hasilAkhir', [HasilIndividuController::class, 'show'])->name('hasilAkhir');
            Route::post('/cetakPdf/{user}', [HasilIndividuController::class, 'cetak'])->name('cetakPdf');
            Route::get('/ubahPassword/{user}', [ChangePasswordController::class, 'ubahPassword'])->name('ubahPassword');
            Route::post('/updatePassword/{user}', [ChangePasswordController::class, 'updatePassword'])->name('updatePassword');
            Route::delete('/hapusTest/{user}', [SiswaController::class, 'hapusTest'])->name('hapusTest');
        });
    });
});
