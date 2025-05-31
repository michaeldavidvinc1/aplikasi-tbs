<?php

use App\Http\Middleware\CheckRole;
use App\Livewire\Admin\HargaTbs;
use App\Livewire\Admin\ManajemenUser;
use App\Livewire\Admin\SemuaInvoice;
use App\Livewire\Admin\SemuaPenawaran;
use App\Livewire\Admin\SemuaTransaksi;
use App\Livewire\Pabrik\PenawaranMasuk;
use App\Livewire\Pabrik\RiwayatPembelian;
use App\Livewire\Pabrik\TransaksiAktif;
use App\Livewire\Petani\Invoice;
use App\Livewire\Petani\KirimPenawaran;
use App\Livewire\Petani\RiwayatPembayaran;
use App\Livewire\Petani\RiwayatPenawaran;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
        Route::get('riwayat-pembayaran', RiwayatPembayaran::class)->name('petani.riwayat.pembayaran');
        Route::get('invoice', Invoice::class)->name('petani.salur');
    });

    Route::prefix('koperasi')->middleware('CheckRole:KOPERASI')->group(function () {
        Route::get('penawaran-masuk', PenawaranMasuk::class)->name('koperasi.penawaran.masuk');
        Route::get('transaksi-aktif', TransaksiAktif::class)->name('koperasi.transaksi.aktif');
        Route::get('riwayat-pembelian', RiwayatPembelian::class)->name('koperasi.riwayat.pembelian');
    });

    Route::prefix('admin')->middleware('CheckRole:ADMIN')->group(function () {
        Route::get('harga-tbs', HargaTbs::class)->name('admin.harga.tbs');
        Route::get('user', ManajemenUser::class)->name('admin.manajemen.user');
        Route::get('semua-penawaran', SemuaPenawaran::class)->name('admin.semua.penawaran');
        Route::get('semua-transaksi', SemuaTransaksi::class)->name('admin.semua.transaksi');
        Route::get('semua-invoice', SemuaInvoice::class)->name('admin.semua.invoice');
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
