<?php

use Illuminate\Support\Facades\Route;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

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

Route::get('/', [HomeController::class, 'index']);

Route::match(['get', 'post'], '/login', [AuthController::class, 'login']);
Route::match(['get', 'post'], '/daftar', [AuthController::class, 'register']);

Route::get('/admin', [AdminController::class, 'getBadanUsaha']);
Route::post('/admin/search', [AdminController::class, 'searchBadanUsaha']);
Route::get('/admin/deleteAll', [AdminController::class, 'deleteAllBadanUsaha']);
Route::post('/admin/import', [AdminController::class, 'importExcel']);
Route::get('/admin/export', [AdminController::class, 'exportExcel']);