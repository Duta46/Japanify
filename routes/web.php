<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PaketSoalController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SoalUjianController;
use App\Http\Controllers\Admin\ReadingUjianController;
use App\Http\Controllers\Admin\LatihanSoalController;
use App\Http\Controllers\Admin\ReadingLatihanSoalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\KategoriTestController;

use App\Http\Controllers\User\AuthController;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\MenuController;
use App\Http\Controllers\User\LatihanSoalController as UserLatihanSoalController;
use App\Http\Controllers\User\UjianController;



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

//Route User
Route::get('/', function () {
    return view('user.home');
})->name('user.home');

Route::get('/informasi-test', function () {
    return view('user.informasi-test');
})->name('user.informasi-test');

Route::get('/statistic', function () {
    return view('user.statistic');
})->name('user.statistic');

Route::get('/login', [AuthController::class, 'index'])->name('user.login');
Route::post('/login', [AuthController::class, 'auth'])->name('login.auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('user.logout');

Route::get('/register', [RegisterController::class, 'index'])->name('user.register');
Route::post('/register', [RegisterController::class, 'store'])->name('user.register.store');

Route::group(['middleware' => [CheckRoleMiddleware::class . ':Super Admin|User']], function () {
Route::get('/menu', [MenuController::class, 'index'])->name('user.menu');
Route::get('/menu/{menu_id}', [MenuController::class, 'show'])->name('user.menu.show');

Route::get('/menu/{menu_id}/latihan-soal', [UserLatihanSoalController::class, 'index'])->name('user.latihan-soal');
Route::get('/latihan_soal/{kategori_id}/{soal_id}', [LatihanSoalController::class, 'soal'])->name('exercise');

Route::get('/menu/{menu_id}/ujian', [UjianController::class, 'index'])->name('user.ujian');
Route::get('/introduction/{id}', [UjianController::class, 'introduction'])->name('user.introduction');
Route::get('/exercise/{paketSoalId}/{soalId}', [UjianController::class, 'mulaiTest'])->name('mulaiTest');
Route::get('/result', [UjianController::class, 'result'])->name('result');
Route::post('/store-answer', [UjianController::class, 'storeAnswer'])->name('storeAnswer');
});


//Route Admin
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified', ])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/change-password', [ProfileController::class, 'change_password'])->name('changePassword');
    Route::post('/update-password', [ProfileController::class, 'update_password'])->name('updatePassword');

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

            Route::get('/soal/{id}/delete-image', [LatihanSoalController::class, 'deleteImage'])->name('admin.latihan-soal.delete_image');
            Route::get('soal/{id}/delete-audio', [LatihanSoalController::class, 'deleteAudio'])->name('admin.latihan-soal.delete_audio');
        });

        Route::group(['prefix' => 'ReadingLatihanSoal'], function() {
            Route::get('/', [ReadingLatihanSoalController::class, 'index'])->name('admin.reading-latihan-soal');

            Route::get('/create', [ReadingLatihanSoalController::class, 'create'])->name('admin.reading-latihan-soal.create');
            Route::post('/store', [ReadingLatihanSoalController::class, 'store'])->name('admin.reading-latihan-soal.store');

            Route::get('/show/{id}', [ReadingLatihanSoalController::class, 'show'])->name('admin.reading-latihan-soal.show');

            Route::get('/edit/{id}', [ReadingLatihanSoalController::class, 'edit'])->name('admin.reading-latihan-soal.edit');
            Route::put('/update/{id}', [ReadingLatihanSoalController::class, 'update'])->name('admin.reading-latihan-soal.update');

            Route::delete('/destroy/{id}', [ReadingLatihanSoalController::class, 'destroy'])->name('admin.reading-latihan-soal.destroy');
        });

        Route::group(['prefix' => 'KategoriTest'], function() {
            Route::get('/', [KategoriTestController::class, 'index'])->name('admin.kategori-test');

            Route::get('/create', [KategoriTestController::class, 'create'])->name('admin.kategori-test.create');
            Route::post('/store', [KategoriTestController::class, 'store'])->name('admin.kategori-test.store');

            Route::get('/edit/{id}', [KategoriTestController::class, 'edit'])->name('admin.kategori-test.edit');
            Route::put('/update/{id}', [KategoriTestController::class, 'update'])->name('admin.kategori-test.update');

            Route::delete('/destroy/{id}', [KategoriTestController::class, 'destroy'])->name('admin.kategori-test.destroy');
        });
});
