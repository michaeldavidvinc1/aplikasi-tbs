<?php

use App\Http\Middleware\CheckRole;
use App\Livewire\Petani\KirimPenawaran;
use App\Livewire\Petani\RiwayatPenawaran;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect('/login');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {

    Route::prefix('petani')->middleware('CheckRole:PETANI')->group(function () {
        Route::get('kirim-penawaran', KirimPenawaran::class)->name('petani.kirim.penawaran');
        Route::get('riwayat-penawaran', RiwayatPenawaran::class)->name('petani.riwayat.penawaran');
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
