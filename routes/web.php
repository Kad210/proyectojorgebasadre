<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\SitioBloqueadoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WhitelistController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('profesores', ProfesorController::class)->parameters(['profesores' => 'profesor']);
    Route::resource('clases', ClaseController::class); // <-- AÑADE ESTA LÍNEA
    Route::get('/clases/{clase}/sitios', [SitioBloqueadoController::class, 'index'])->name('sitios.index');
    Route::post('/clases/{clase}/sitios', [SitioBloqueadoController::class, 'store'])->name('sitios.store');
    Route::delete('/sitios/{sitio}', [SitioBloqueadoController::class, 'destroy'])->name('sitios.destroy');
    Route::get('/clases/{clase}/sitios', [SitioBloqueadoController::class, 'index'])->name('sitios.index');
    Route::get('/reportes/sitios-bloqueados', [ReportController::class, 'exportSitiosBloqueados'])->name('reportes.sitios.export');
    Route::get('/whitelist', [WhitelistController::class, 'index'])->name('whitelist.index');
    Route::post('/whitelist', [WhitelistController::class, 'store'])->name('whitelist.store');
    Route::delete('/whitelist/{listaBlanca}', [WhitelistController::class, 'destroy'])->name('whitelist.destroy');
});

require __DIR__.'/auth.php';
