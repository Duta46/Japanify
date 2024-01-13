<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PaketSoalController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SoalUjianController;
use App\Http\Controllers\Admin\ReadingUjianController;
use App\Http\Controllers\Admin\LatihanSoalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    //Route for paket soal
    Route::group(['prefix' => 'PaketSoal'], function(){
        Route::get('/', [PaketSoalController::class, 'index'])->name('admin.paket-soal');

        Route::get('/create', [PaketSoalController::class, 'create'])->name('admin.paket-soal.create');
        Route::post('/store', [PaketSoalController::class, 'store'])->name('admin.paket-soal.store');

        Route::get('/show/{id}', [PaketSoalController::class, 'show'])->name('admin.paket-soal.show');

        Route::get('/edit/{id}', [PaketSoalController::class, 'edit'])->name('admin.paket-soal.edit');
        Route::put('/update/{id}', [PaketSoalController::class, 'update'])->name('admin.paket-soal.update');

        Route::delete('/destroy/{id}', [PaketSoalController::class, 'destroy'])->name('admin.paket-soal.destroy');
        });

        Route::group(['prefix' => 'Kategori'], function() {
            Route::get('/', [KategoriController::class, 'index'])->name('admin.kategori');

            Route::get('/create', [KategoriController::class, 'create'])->name('admin.kategori.create');
            Route::post('/store', [KategoriController::class, 'store'])->name('admin.kategori.store');

            Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
            Route::put('/update/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');

            Route::delete('/destroy/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
        });

        Route::group(['prefix' => 'SoalUjian'], function() {
            Route::get('/', [SoalUjianController::class, 'index'])->name('admin.ujian-soal');

            Route::get('/create', [SoalUjianController::class, 'create'])->name('admin.ujian-soal.create');
            Route::post('/store', [SoalUjianController::class, 'store'])->name('admin.ujian-soal.store');

            Route::get('/show/{id}', [SoalUjianController::class, 'show'])->name('admin.ujian-soal.show');

            Route::get('/edit/{id}', [SoalUjianController::class, 'edit'])->name('admin.ujian-soal.edit');
            Route::put('/update/{id}', [SoalUjianController::class, 'update'])->name('admin.ujian-soal.update');

            Route::delete('/destroy/{id}', [SoalUjianController::class, 'destroy'])->name('admin.ujian-soal.destroy');
            Route::get('/soal/{id}/delete-image', [SoalUjianController::class, 'deleteImage'])->name('admin.soal-ujian.delete_image');
            Route::get('soal/{id}/delete-audio', [SoalUjianController::class, 'deleteAudio'])->name('admin.soal-ujian.delete_audio');
        });

        Route::group(['prefix' => 'ReadingUjian'], function() {
            Route::get('/', [ReadingUjianController::class, 'index'])->name('admin.reading-ujian');

            Route::get('/create', [ReadingUjianController::class, 'create'])->name('admin.reading-ujian.create');
            Route::post('/store', [ReadingUjianController::class, 'store'])->name('admin.reading-ujian.store');

            Route::get('/show/{id}', [ReadingUjianController::class, 'show'])->name('admin.reading-ujian.show');

            Route::get('/edit/{id}', [ReadingUjianController::class, 'edit'])->name('admin.reading-ujian.edit');
            Route::put('/update/{id}', [ReadingUjianController::class, 'update'])->name('admin.reading-ujian.update');

            Route::delete('/destroy/{id}', [ReadingUjianController::class, 'destroy'])->name('admin.reading-ujian.destroy');
        });

        Route::group(['prefix' => 'LatihanSoal'], function() {
            Route::get('/', [LatihanSoalController::class, 'index'])->name('admin.latihan-soal');

            Route::get('/create', [LatihanSoalController::class, 'create'])->name('admin.latihan-soal.create');
            Route::post('/store', [LatihanSoalController::class, 'store'])->name('admin.latihan-soal.store');

            Route::get('/show/{id}', [LatihanSoalController::class, 'show'])->name('admin.latihan-soal.show');

            Route::get('/edit/{id}', [LatihanSoalController::class, 'edit'])->name('admin.latihan-soal.edit');
            Route::put('/update/{id}', [LatihanSoalController::class, 'update'])->name('admin.latihan-soal.update');

            Route::delete('/destroy/{id}', [LatihanSoalController::class, 'destroy'])->name('admin.latihan-soal.destroy');
            // Route::get('/soal/{id}/delete-image', [SoalUjianController::class, 'deleteImage'])->name('admin.soal-ujian.delete_image');
            // Route::get('soal/{id}/delete-audio', [SoalUjianController::class, 'deleteAudio'])->name('admin.soal-ujian.delete_audio');
        });
});
