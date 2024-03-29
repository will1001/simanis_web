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
Route::get('/privacyPolicy', [HomeController::class, 'privacyPolicy']);
Route::get('/SuratRekomendasi/{user_id}', [HomeController::class, 'tampil_surat']);
Route::get('/downloadSurat/{user_id}', [HomeController::class, 'download_surat']);
Route::get('/chartDetail/{chartId}/{title}/sjfi834t3htg84ht3ht98034ht3ht3h4t8h24th82h4t2sbf3287r9823gr934gr3sjfi834t3htg84ht3ht98034ht3ht3h4t8h24th82h4t2sbf3287r9823gr934gr3/{filter_chart}', [HomeController::class, 'chartDetail'])->name('chartDetail');
Route::post('/chartDetail/search', [HomeController::class, 'chartDetailSearch'])->name('chartDetail_search');
Route::post('/surveyChart/{id}', [HomeController::class, 'surveyChart'])->name('surveyChart');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/daftar', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/changePassword/{pages}', [AuthController::class, 'changePassword'])->name('changePassword');
//new
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/admin-dashboard/setting', [AdminController::class, 'setting'])->name('admin-dashboard.setting');
    Route::get('/admin-dashboard/setting-surat', [AdminController::class, 'settingSuratNew'])->name('admin-dashboard.setting-surat');
    Route::get('/admin-dashboard/daftar-akun', [AdminController::class, 'daftarAkun'])->name('admin-dashboard.daftar-akun');
    Route::get('/admin-dashboard/daftar-pengajuan-dana', [AdminController::class, 'daftarPengajuanDana'])->name('admin-dashboard.daftar-pengajuan-dana');
    Route::get('/admin-dashboard/history-pengajuan-dana', [AdminController::class, 'historyPengajuanDana'])->name('admin-dashboard.history-pengajuan-dana');
    Route::get('/admin-dashboard/setting-akun', [AdminController::class, 'settingAkun'])->name('admin-dashboard.setting-akun');
});
//end enw
Route::get('/admin/{pages}/{subPages?}/{id?}', [AdminController::class, 'index'])->name('admin');
Route::post('/admin/search', [AdminController::class, 'searchBadanUsaha'])->name('admin_search');
Route::post('/admin/searchUser', [AdminController::class, 'searchUser'])->name('admin_search_user');
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
Route::get('/ntbmall/updateDataLokasi', [PerdaganganController::class, 'updateDataLokasi']);
Route::get('/ntbmall/updateDataKategori', [PerdaganganController::class, 'updateDataKategori']);
Route::post('/ntbmall/buatToko', [PerdaganganController::class, 'buatToko']);
Route::get('/ojk/{pages}/{subPages?}/{id?}', [OjkController::class, 'index'])->name('ojk');

Route::match(['get', 'post'], '/form/{userType}/{id?}', [FormController::class, 'badan_usaha']);
Route::get('/form/badan_usaha/delete/{id}', [FormController::class, 'deleteBadanUsahaById']);


Route::post('/ajukan_dana', [MemberController::class, 'ajukan_dana'])->name('ajukan_dana');
Route::post('/ajukan_produk', [MemberController::class, 'ajukan_produk'])->name('ajukan_produk');
Route::get('/user/hapus_produk/{id}', [MemberController::class, 'hapus_produk'])->name('hapus_produk');
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
