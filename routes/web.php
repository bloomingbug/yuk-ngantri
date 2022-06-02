<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SesiPerkuliahanController;
use App\Http\Controllers\PesertaSesiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\LoginController;

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

// Redirect Login
Route::get('/', [AuthenticatedSessionController::class, 'create'])->middleware('guest');

// Route Dashboard
Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'datalengkap'])->name('dashboard');

// User Umum
Route::get('/users/create', [UserController::class, 'create'])->middleware('admin');
Route::get('/users/{user:slug}', [UserController::class, 'show']);
Route::get('/users/{user:slug}/edit', [UserController::class, 'edit']);
Route::put('/users/{user:slug}', [UserController::class, 'update']);
Route::get('/matkul-admin', [MatkulController::class, 'indexAdmin'])->middleware('admin');
Route::get('/matkul', [MatkulController::class, 'index'])->middleware('datalengkap');
Route::get('/matkul/create', [MatkulController::class, 'create'])->middleware('admin');
Route::get('/matkul/{matkul:slug}', [MatkulController::class, 'show'])->middleware('datalengkap');
Route::get('/sesi-perkuliahan', [SesiPerkuliahanController::class, 'index'])->middleware('datalengkap');
Route::get('/peserta-sesi/{sesiPerkuliahan:slug}', [PesertaSesiController::class, 'show'])->middleware('datalengkap');
// End of Route User Umum

// Bukan Admin
Route::middleware(['notadmin', 'datalengkap'])->group(function () {
});
// End ofBukan Admin

// Mahasiswa
Route::middleware(['mahasiswa', 'datalengkap'])->group(function () {
    // Route Peserta Sesi/Absen
    Route::post('/peserta-sesi', [PesertaSesiController::class, 'store']);
    Route::put('/peserta-sesi/{pesertaSesi:id}', [PesertaSesiController::class, 'update']);
    Route::delete('/peserta-sesi/{pesertaSesi:id}', [PesertaSesiController::class, 'destroy']);
});
// End of Mahasiswa

// Dosen
Route::middleware(['dosen'])->group(function () {
    // Route Matkul
    Route::get('/matkul/mk-diampu/{user:slug}', [MatkulController::class, 'showMk'])->middleware('notadmin');
    Route::get('/matkul/{matkul:slug}/sesi', [MatkulController::class, 'sesi']);

    // Route Ruangan
    Route::get('/ruangan', [RuanganController::class, 'index']);
    Route::get('/ruangan/{ruangan:slug}', [RuanganController::class, 'show']);

    // Route Sesi Perkuliahan
    Route::get('/sesi-perkuliahan/create', [SesiPerkuliahanController::class, 'create']);
    Route::post('/sesi-perkuliahan', [SesiPerkuliahanController::class, 'store']);
    Route::get('/sesi-perkuliahan/{sesiPerkuliahan:slug}/edit', [SesiPerkuliahanController::class, 'edit']);
    Route::put('/sesi-perkuliahan/{sesiPerkuliahan:slug}', [SesiPerkuliahanController::class, 'update']);
    Route::delete('/sesi-perkuliahan/{sesiPerkuliahan:slug}', [SesiPerkuliahanController::class, 'destroy']);
});
// End of Dosen

// Admin
Route::middleware(['admin'])->group(function () {
    // Route User
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::delete('/users/{user:slug}', [UserController::class, 'destroy']);

    // Route Matkul
    Route::post('/matkul', [MatkulController::class, 'store']);
    Route::get('/matkul/{matkul:slug}/edit', [MatkulController::class, 'edit']);
    Route::put('/matkul/{matkul:slug}', [MatkulController::class, 'update']);
    Route::delete('/matkul/{matkul:slug}', [MatkulController::class, 'destroy']);

    // Route Jadwal
    Route::get('/jadwal', [JadwalController::class, 'index']);
    Route::get('/jadwal/create', [JadwalController::class, 'create']);
    Route::post('/jadwal', [JadwalController::class, 'store']);
    Route::get('/jadwal/{jadwal:slug}/edit', [JadwalController::class, 'edit']);
    Route::put('/jadwal/{jadwal:slug}', [JadwalController::class, 'update']);
    Route::delete('/jadwal/{jadwal:slug}', [JadwalController::class, 'destroy']);

    // Route Ruangan
    Route::post('/ruangan', [RuanganController::class, 'store']);
    Route::delete('/ruangan/{ruangan:slug}', [RuanganController::class, 'destroy']);

    // Route Kalender Akademik
    Route::get('/kalender', [KalenderController::class, 'index']);
    Route::get('/kalender/create', [KalenderController::class, 'create']);
    Route::post('/kalender', [KalenderController::class, 'store']);
    Route::get('/kalender/{imageContainer:slug}/edit', [KalenderController::class, 'edit']);
    Route::put('/kalender/{imageContainer:slug}', [KalenderController::class, 'update']);
    Route::delete('/kalender/{imageContainer:slug}', [KalenderController::class, 'destroy']);
});
// End ofAdmin

require __DIR__.'/auth.php';
