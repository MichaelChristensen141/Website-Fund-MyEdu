<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PrestasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BeasiswaController;
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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/beasiswa/{id}', [HomeController::class, 'show_beasiswa'])->name('index.beasiswa.item');

Route::get('/crawling/beasiswa', [BeasiswaController::class, 'crawling'])->name('index.beasiswa.crawling');
Route::get('/crawling/beasiswa/{id}', [BeasiswaController::class, 'crawlingOne'])->name('index.beasiswa.crawlingOne');

Route::middleware('checkstatus','auth')->get('/beasiswa', [HomeController::class, 'list_beasiswa'])->name('index.beasiswa');
Route::middleware('checkstatus','auth')->get('/rekomendasi', [HomeController::class, 'rekomendasi_beasiswa'])->name('index.rekomendasi_beasiswa');

Route::get('/about', [HomeController::class, 'about'])->name('index.about');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/prestasi', [PrestasiController::class, 'store'])->name('prestasi.store');
    Route::put('/profile/prestasi/{id}', [PrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/profile/prestasi/{id}', [PrestasiController::class, 'destroy'])->name('prestasi.destroy');
});

require __DIR__ . '/auth.php';
