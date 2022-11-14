<?php

use Illuminate\Support\Facades\Route;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PerbankanController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\PerdaganganController;
use App\Http\Controllers\OjkController;
use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/storageLink', function () {
    Artisan::call('storage:link');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/downloadSurat/{user_id}', [HomeController::class, 'download_surat']);
Route::post('/chartDetail/{chartId}/{title}', [HomeController::class, 'chartDetail'])->name('chartDetail');
Route::post('/chartDetail/search', [HomeController::class, 'chartDetailSearch'])->name('chartDetail_search');
Route::post('/surveyChart/{id}', [HomeController::class, 'surveyChart'])->name('surveyChart');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/daftar', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/changePassword/{pages}', [AuthController::class, 'changePassword'])->name('changePassword');

Route::get('/admin/{pages}/{subPages?}/{id?}', [AdminController::class, 'index'])->name('admin');
Route::post('/admin/search', [AdminController::class, 'searchBadanUsaha'])->name('admin_search');
Route::post('/admin/surat', [AdminController::class, 'settingSurat'])->name('setting_surat');
Route::post('/admin/search/pengajuanDana/{pages}', [AdminController::class, 'searchPengajuanDana'])->name('searchPengajuanDana');
Route::get('/admin/delete/deleteAll', [AdminController::class, 'deleteAllBadanUsaha'])->name('admin_delete_all');
Route::post('/kabupaten/delete/admin', [AdminController::class, 'deleteBadanUsahaPerKabupaten'])->name('admin_delete_per_kabupaten');
Route::post('/import/data/admin', [AdminController::class, 'importExcel'])->name('importExcel');
Route::get('/export/data/admin', [AdminController::class, 'exportExcel'])->name('exportExcel');
Route::get('/export/dana/perbankan', [PerbankanController::class, 'exportExcel']);
Route::get('/export/badan_usaha/perbankan/{id}', [PerbankanController::class, 'exportBadanUsahaByID']);
Route::get('/export/dana/koperasi', [KoperasiController::class, 'exportExcel']);
Route::get('/export/dana/ojk', [OjkController::class, 'exportExcel']);
Route::post('/admin/slideshow/{id}', [AdminController::class, 'gantiSlide']);
Route::post('/admin/survei/{id}', [AdminController::class, 'gantiLinksurvei']);
Route::get('/admin/user/password/reset/{id}', [AdminController::class, 'resetPasswordUser']);

Route::get('/member/{pages}/{subPages?}/{id?}', [MemberController::class, 'index'])->name('member');
Route::post('/member/data/pendukung', [MemberController::class, 'uploadDataPendukung']);
Route::get('/perbankan/{pages}/{subPages?}/{id?}', [PerbankanController::class, 'index']);
Route::get('/koperasi/{pages}/{subPages?}/{id?}', [KoperasiController::class, 'index'])->name('koperasi');
Route::get('/perdagangan/{pages}/{subPages?}/{id?}', [PerdaganganController::class, 'index'])->name('perdagangan');
Route::get('/ojk/{pages}/{subPages?}/{id?}', [OjkController::class, 'index'])->name('ojk');

Route::match(['get', 'post'], '/form/{userType}/{id?}', [FormController::class, 'badan_usaha']);
Route::get('/form/badan_usaha/delete/{id}', [FormController::class, 'deleteBadanUsahaById']);


Route::post('/ajukan_dana', [MemberController::class, 'ajukan_dana'])->name('ajukan_dana');
Route::post('/ajukan_produk', [MemberController::class, 'ajukan_produk'])->name('ajukan_produk');
Route::post('/dana/{id}/status/{status}', [AdminController::class, 'gantiStatusPengajuanDana']);
Route::post('/bank/dana/{id}/status/{status}', [PerbankanController::class, 'gantiStatusPengajuanDana']);
Route::post('/koperasi/dana/{id}/status/{status}', [KoperasiController::class, 'gantiStatusPengajuanDana']);
Route::post('/notifikasi/status/{userRole}/{recentPage}', [AdminController::class, 'gantiStatusNotifikasi']);
Route::post('/create/user', [AdminController::class, 'tambahUser']);
Route::get('/user/status/{id}/{status}', [AdminController::class, 'ubahStatusUser']);
Route::get('/user/delete/{id}', [AdminController::class, 'hapusUser']);
Route::post('/simulasi/angsuran', [PerbankanController::class, 'tambahSimulasiAngsuran']);
Route::post('/simulasi/angsuran/delete/{jumlah_dana}', [PerbankanController::class, 'hapusSimulasiAngsuran']);
Route::post('/simulasi/angsuran/edit/{id}', [PerbankanController::class, 'editSimulasiAngsuran']);
Route::post('/ganti/foto', [MemberController::class, 'ganti_foto'])->name('ganti_foto');
