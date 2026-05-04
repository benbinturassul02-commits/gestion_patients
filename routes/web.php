<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezvousController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin', function () {
    return "Bienvenue Admin";
})->middleware(['auth', 'role:admin']);

Route::get('/medecin', function () {
    return "Bienvenue Médecin";
})->middleware(['auth', 'role:medecin']);

Route::get('/secretaire', function () {
    return "Bienvenue Secrétaire";
})->middleware(['auth', 'role:secretaire']);

Route::get('/infirmier', function () {
    return "Bienvenue Infirmier";
})->middleware(['auth', 'role:infirmier']);

Route::get('/patient', function () {
    return "Bienvenue Patient";
})->middleware(['auth', 'role:patient']);

Route::middleware(['auth', 'role:admin,secretaire'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('rendezvous', RendezvousController::class);
});

require __DIR__.'/auth.php';
