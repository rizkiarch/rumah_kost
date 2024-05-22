<?php

use App\Http\Controllers\API\DashboardController as APIDashboardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KontakController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/perangkat', SettingController::class);
    Route::resource('/kontak', KontakController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('/laporan', LaporanController::class);
    Route::resource('/payment', PaymentController::class);
    Route::resource('/kost', KostController::class);
    Route::get('/api/kontak/{id}', 'App\Http\Controllers\KontakController@getJsonKontak')->name('api.kontak');
    Route::get('api/dashboard', [APIDashboardController::class, 'getDashboardData']);
});
Route::middleware(['AdminMiddleware'])->group(function () {
    Route::resource('/user', UserController::class)->middleware('auth', 'admin');
});

route::resource('/test', TestController::class);

require __DIR__ . '/auth.php';
