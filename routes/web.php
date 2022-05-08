<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PrestasiController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TestController;

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
Route::group(['middleware' => 'auth:admin'], function () {
    Route::view('/admin', 'admin/dashboard');
});

//Mahasiswa
Route::get('/login/mahasiswa', [LoginController::class, 'showMahasiswaLoginForm']);
Route::post('/login/mahasiswa', [LoginController::class, 'mahasiswaLogin']);
Route::get('/register/mahasiswa', [RegisterController::class, 'showMahasiswaRegisterForm']);
Route::post('/register/mahasiswa', [RegisterController::class, 'createMahasiswa']);

Route::group(['middleware' => 'auth:mahasiswa'], function () {
    Route::view('/mahasiswa', 'mahasiswa/dashboard');
    Route::view('/verifikasi', 'mahasiswa/verifikasi');
    Route::view('/test3', 'mahasiswa/prestasi/test');
    
    //Route for Prestasi
    route::resource('/prestasi', PrestasiController::class);

    // Route for Projects
    Route::resource('/project', ProjectController::class);
});

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/test', function () {
    return view('test');
});
