<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\VerifikasiController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Models\Mahasiswa;

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

Route::get('/',  function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
});





//Admin
Route::get('/login/admin', [LoginController::class, 'showAdminLoginForm']);
Route::post('/login/admin', [LoginController::class, 'adminLogin']);
Route::post('/updatePasswordAdm',[ChangePasswordController::class, 'updatePasswordAdm'])->name('updatePasswordAdm');
Route::group(['middleware' => 'auth:admin'], function () {
    //Route for Dashboard
    Route::get('/admin', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    //put -> karena butuh method untuk update
    //verif{id} -> parameter untuk menjalankan function di controllernya
    //updatestatus -> nama method baru di controller
    //name -> alias yang dipake untuk manggil di route
    
    
    //Route for Verification
    Route::get('/verif_prestasi', [StatusController::class, 'indexPrestasi'])->name('index.prestasi');
    Route::put('/acc_prestasi/{id_prestasi}', [StatusController::class, 'updatePrestasiStatus'])->name('verif.updatePrestasiStatus');
    Route::put('/tolak_prestasi/{id_prestasi}', [StatusController::class, 'rejectPrestasi'])->name('verif.rejectPrestasi');
    

    Route::get('/verif_project', [StatusController::class, 'indexProject'])->name('index.project');
    Route::put('/acc_project/{id_project}', [StatusController::class, 'updateProjectStatus'])->name('verif.updateProjectStatus');
    Route::put('/tolak_project/{id_project}', [StatusController::class, 'rejectProject'])->name('verif.rejectProject');
    
    Route::get('/verif_jurnal', [StatusController::class, 'indexJurnal'])->name('index.jurnal');
    Route::put('/acc_jurnal/{id_jurnal}', [StatusController::class, 'updateJurnalStatus'])->name('verif.updateJurnalStatus');
    Route::put('/tolak_jurnal/{id_jurnal}', [StatusController::class, 'rejectJurnal'])->name('verif.rejectJurnal');

    Route::get('/verif_kegiatan', [StatusController::class, 'indexKegiatan'])->name('index.kegiatan');
    Route::put('/acc_kegiatan/{id_kegiatan}', [StatusController::class, 'updateKegiatanStatus'])->name('verif.updateKegiatanStatus');
    Route::put('/tolak_kegiatan/{id_kegiatan}', [StatusController::class, 'rejectKegiatan'])->name('verif.rejectKegiatan');

    //Route for kelola_mahasiswa
    Route::resource('/kelola_mahasiswa', MahasiswaController::class);
    //Route::get('/fakultas/{id}/prodi', [MahasiswaController::class, 'findProdi'])->name('mahasiswa.findProdi');
    
});

//Mahasiswa
Route::get('/login/mahasiswa', [LoginController::class, 'showMahasiswaLoginForm']);
Route::post('/login/mahasiswa', [LoginController::class, 'mahasiswaLogin']);
Route::get('/register/mahasiswa', [RegisterController::class, 'showMahasiswaRegisterForm']);
Route::post('/register/mahasiswa', [RegisterController::class, 'createMahasiswa']);
Route::post('/updatePasswordMhs',[ChangePasswordController::class, 'updatePasswordMhs'])->name('updatePasswordMhs');
Route::put('/updateProfile/{id}',[MahasiswaController::class, 'updateProfile'])->name('tambahFoto');


Route::group(['middleware' => 'auth:mahasiswa'], function () {
    //Route for Dashboard
    Route::get('/mahasiswa', [DashboardMahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    // Route::view('/mahasiswa', 'mahasiswa/dashboard');
    
    //Route for Prestasi
    route::resource('/prestasi', PrestasiController::class);
   
    // Route for Projects
    Route::resource('/project', ProjectController::class);
    
    // Route for Jurnal
    Route::resource('/jurnal', JurnalController::class);
    
    // Route for Kegiatan
    Route::resource('/kegiatan', KegiatanController::class);

    //Route for Verifikasi
    Route::resource('/verifikasi', VerifikasiController::class);

});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/test', function () {
    return view('test');
});
