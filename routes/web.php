<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\AktivitasController;
use App\Http\Controllers\Penyewa\AlatController;
use App\Http\Controllers\Penyewa\SewaController;
use App\Http\Controllers\Penyewa\PaymentController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\PenyewaanController;



Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Webhook Midtrans (di luar middleware auth & dikecualikan dari CSRF)
|--------------------------------------------------------------------------
*/
Route::post('/payment/callback', [PaymentController::class, 'callback'])
    ->name('payment.callback');

Route::middleware(['auth'])->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Redirect Dashboard Sesuai Role
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('Admin')) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->hasRole('Petugas')) {
            return redirect()->route('petugas.dashboard');
        }

        if ($user->hasRole('Penyewa')) {
            return redirect()->route('penyewa.dashboard');
        }

        if ($user->hasRole('Owner')) {
            return redirect()->route('owner.dashboard');
        }

        abort(403, 'Role belum memiliki halaman tujuan.');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Dashboard Per Role
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('admin.dashboard');

    Route::get('/petugas/dashboard', [DashboardController::class, 'petugas'])
        ->name('petugas.dashboard');

    Route::get('/penyewa/dashboard', [DashboardController::class, 'penyewa'])
        ->name('penyewa.dashboard');

    Route::get('/owner/dashboard', [DashboardController::class, 'owner'])
        ->name('owner.dashboard');


    /*
    |--------------------------------------------------------------------------
    | Laporan
    |--------------------------------------------------------------------------
    */
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->middleware('can:laporan.index')
        ->name('laporan.index');

    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])
        ->middleware('can:laporan.cetak')
        ->name('laporan.cetak');

    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])
        ->middleware('can:laporan.export')
        ->name('laporan.export');

    Route::get('/owner/laporan', function () {
        return redirect()->route('laporan.index');
    })->middleware('can:laporan.index')->name('owner.laporan.index');


    /*
    |--------------------------------------------------------------------------
    | Aktivitas Sistem
    |--------------------------------------------------------------------------
    */
    Route::get('/aktivitas', [AktivitasController::class, 'index'])
        ->middleware('can:aktivitas.index')
        ->name('aktivitas.index');


    /*
    |--------------------------------------------------------------------------
    | Admin Resource
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('users', UserController::class)
                ->except(['show'])
                ->middleware('can:user.index');

            Route::resource('roles', RoleController::class)
                ->except(['show'])
                ->middleware('can:role.index');

            Route::resource('permissions', PermissionController::class)
                ->except(['show'])
                ->middleware('can:permission.index');

            Route::resource('kategoris', KategoriController::class)
                ->except(['show'])
                ->middleware('can:kategori.index');

            Route::resource('barangs', BarangController::class)
                ->except(['show'])
                ->middleware('can:barang.index');
        });


     /*
    |--------------------------------------------------------------------------
    | Penyewaan dan Pengembalian
    |--------------------------------------------------------------------------
    */
    Route::get('/petugas/penyewaan', [PenyewaanController::class, 'index'])
        ->middleware('can:penyewaan.index')
        ->name('petugas.penyewaan.index');

    Route::get('/petugas/penyewaan/{penyewaan}/edit', [PenyewaanController::class, 'edit'])
        ->middleware('can:penyewaan.edit')
        ->name('petugas.penyewaan.edit');

    Route::put('/petugas/penyewaan/{penyewaan}', [PenyewaanController::class, 'update'])
        ->middleware('can:penyewaan.edit')
        ->name('petugas.penyewaan.update');

    Route::get('/petugas/pengembalian', [PengembalianController::class, 'index'])
        ->middleware('can:pengembalian.index')
        ->name('petugas.pengembalian.index');


    /*
    |--------------------------------------------------------------------------
    | Penyewa
    |--------------------------------------------------------------------------
    */
    Route::get('/penyewa/alat', [AlatController::class, 'index'])
        ->middleware('can:alat.index')
        ->name('penyewa.alat.index');

    Route::get('/penyewa/sewa/{barang}', [SewaController::class, 'create'])
        ->middleware('can:sewa.create')
        ->name('penyewa.sewa.create');

    Route::post('/penyewa/sewa/{barang}', [SewaController::class, 'store'])
        ->middleware('can:sewa.create')
        ->name('penyewa.sewa.store');

    Route::get('/penyewa/riwayat', [SewaController::class, 'riwayat'])
        ->middleware('can:sewa.riwayat')
        ->name('penyewa.sewa.riwayat');

    Route::get('/penyewa/pembayaran/{penyewaan}', [PaymentController::class, 'checkout'])
        ->middleware('can:sewa.create')
        ->name('penyewa.pembayaran.checkout');

    Route::post('/penyewa/pembayaran/{penyewaan}/cek-status', [PaymentController::class, 'refreshStatus'])
    ->middleware('can:sewa.create')
    ->name('penyewa.pembayaran.cekStatus');

    Route::get('/penyewa/pembayaran/{penyewaan}/bukti', [PaymentController::class, 'bukti'])
    ->middleware('can:sewa.create')
    ->name('penyewa.pembayaran.bukti');

Route::get('/penyewa/pembayaran/{penyewaan}/bukti/pdf', [PaymentController::class, 'buktiPdf'])
    ->middleware('can:sewa.create')
    ->name('penyewa.pembayaran.buktiPdf');
});

require __DIR__.'/auth.php';
