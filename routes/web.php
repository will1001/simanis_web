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
Route::get('/chartDetail/{filter}/{chartId}/{title}', [HomeController::class, 'chartDetail'])->name('chartDetail');
Route::post('/chartDetail/search', [HomeController::class, 'chartDetailSearch'])->name('chartDetail_search');
Route::post('/surveyChart/{id}', [HomeController::class, 'surveyChart'])->name('surveyChart');

Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/daftar', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/admin/{pages}', [AdminController::class, 'index'])->name('admin');
Route::post('/admin/search', [AdminController::class, 'searchBadanUsaha'])->name('admin_search');
Route::get('/admin/delete/deleteAll', [AdminController::class, 'deleteAllBadanUsaha'])->name('admin_delete_all');
Route::post('/admin/data/import', [AdminController::class, 'importExcel']);
Route::get('/admin/data/export', [AdminController::class, 'exportExcel']);
Route::post('/admin/slideshow/{id}', [AdminController::class, 'gantiSlide']);
Route::post('/admin/survei/{id}', [AdminController::class, 'gantiLinksurvei']);

Route::get('/member/{pages}/{subPages?}/{id?}', [MemberController::class, 'index'])->name('member');
Route::get('/perbankan/{pages}/{subPages?}', [PerbankanController::class, 'index']);
Route::get('/koperasi/{pages}/{subPages?}', [KoperasiController::class, 'index'])->name('koperasi');
Route::get('/perdagangan/{pages}/{subPages?}', [PerdaganganController::class, 'index'])->name('perdagangan');
Route::get('/ojk/{pages}/{subPages?}', [OjkController::class, 'index'])->name('ojk');

Route::match(['get', 'post'], '/form/{userType}/{id?}', [FormController::class, 'badan_usaha']);
Route::get( '/form/badan_usaha/delete/{id}', [FormController::class, 'deleteBadanUsahaById']);
