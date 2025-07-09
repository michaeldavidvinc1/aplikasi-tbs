<?php

use App\Http\Middleware\CheckRole;
use App\Livewire\Admin\HargaTbs;
use App\Livewire\Admin\LaporanBulanan;
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
use Illuminate\Support\Facades\Storage;
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
        Route::get('/', \App\Livewire\Petani\Dashboard::class)->name('petani.dashboard');
        Route::get('kirim-penawaran', KirimPenawaran::class)->name('petani.kirim.penawaran');
        Route::get('riwayat-penawaran', RiwayatPenawaran::class)->name('petani.riwayat.penawaran');
        Route::get('riwayat-pembayaran', RiwayatPembayaran::class)->name('petani.riwayat.pembayaran');
        Route::get('invoice', Invoice::class)->name('petani.salur');
    });

    Route::prefix('koperasi')->middleware('CheckRole:KOPERASI')->group(function () {
        Route::get('/', \App\Livewire\Pabrik\Dashboard::class)->name('koperasi.dashboard');
        Route::get('penawaran-masuk', PenawaranMasuk::class)->name('koperasi.penawaran.masuk');
        Route::get('transaksi-aktif', TransaksiAktif::class)->name('koperasi.transaksi.aktif');
        Route::get('riwayat-pembelian', RiwayatPembelian::class)->name('koperasi.riwayat.pembelian');
    });

    Route::prefix('admin')->middleware('CheckRole:ADMIN')->group(function () {
        Route::get('/', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
        Route::get('harga-tbs', HargaTbs::class)->name('admin.harga.tbs');
        Route::get('user', ManajemenUser::class)->name('admin.manajemen.user');
        Route::get('semua-penawaran', SemuaPenawaran::class)->name('admin.semua.penawaran');
        Route::get('semua-transaksi', SemuaTransaksi::class)->name('admin.semua.transaksi');
        Route::get('semua-invoice', SemuaInvoice::class)->name('admin.semua.invoice');
        Route::get('laporan-bulanan', LaporanBulanan::class)->name('admin.laporan.bulanan');
    });

    Route::prefix('pimpinan')->middleware('CheckRole:PIMPINAN')->group(function () {
        Route::get('/', \App\Livewire\Pimpinan\Dashboard::class)->name('pimpinan.dashboard');
        Route::get('semua-penawaran', \App\Livewire\Pimpinan\SemuaPenawaran::class)->name('pimpinan.semua.penawaran');
        Route::get('semua-transaksi', \App\Livewire\Pimpinan\SemuaTransaksi::class)->name('pimpinan.semua.transaksi');
        Route::get('semua-invoice', \App\Livewire\Pimpinan\SemuaInvoice::class)->name('pimpinan.semua.invoice');
    });

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
