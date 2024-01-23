<?php

use Illuminate\Support\Facades\Route;
use Spatie\Permission\Middlewares\RoleMiddleware;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KampusController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\BeasiswaController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth', RoleMiddleware::class . ':admin'])->group(function () {
    // Route untuk halaman dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Route grup untuk master data
    Route::prefix('masterdata')->group(function () {
        Route::resource('kampus', KampusController::class)->only([
            'index', 'store', 'update', 'destroy'
        ])->names([
            'index' => 'masterdata.kampus.index',
            'store' => 'masterdata.kampus.store',
            'update' => 'masterdata.kampus.update',
            'destroy' => 'masterdata.kampus.destroy',
        ]);

        Route::resource('perusahaan', PerusahaanController::class)->only([
            'index', 'store', 'update', 'destroy'
        ])->names([
            'index' => 'masterdata.perusahaan.index',
            'store' => 'masterdata.perusahaan.store',
            'update' => 'masterdata.perusahaan.update',
            'destroy' => 'masterdata.perusahaan.destroy',
        ]);

        Route::resource('jurusan', JurusanController::class)->only([
            'index', 'store', 'update', 'destroy'
        ])->names([
            'index' => 'masterdata.jurusan.index',
            'store' => 'masterdata.jurusan.store',
            'update' => 'masterdata.jurusan.update',
            'destroy' => 'masterdata.jurusan.destroy',
        ]);

        Route::resource('jenjang', JenjangController::class)->only([
            'index', 'store', 'update', 'destroy'
        ])->names([
            'index' => 'masterdata.jenjang.index',
            'store' => 'masterdata.jenjang.store',
            'update' => 'masterdata.jenjang.update',
            'destroy' => 'masterdata.jenjang.destroy',
        ]);
    });

    // Route grup untuk beasiswa
    Route::resource('beasiswa', BeasiswaController::class)->only([
        'index', 'store', 'edit', 'destroy', 'create', 'update'
    ])->names([
        'index' => 'dashboard.beasiswa.index',
        'create' => 'dashboard.beasiswa.create',
        'store' => 'dashboard.beasiswa.store',
        'edit' => 'dashboard.beasiswa.edit',
        'update' => 'dashboard.beasiswa.update',
        'destroy' => 'dashboard.beasiswa.destroy',
    ]);

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('dashboard.users');
        Route::get('/verifikasi', [UserController::class, 'verifikasi'])->name('dashboard.users.verifikasi');
        Route::post('/verifikasi/{id}', [UserController::class, 'storeVerifikasi']);
        Route::post('/reject/{id}', [UserController::class, 'rejectVerifikasi']);
    });
    
});





