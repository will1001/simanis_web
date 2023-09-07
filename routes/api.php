<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\IkmController;
use App\Http\Controllers\API\StatistikIkmController;
use App\Http\Controllers\API\DataMasterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/ikm', [IkmController::class, 'index']);
Route::get('/geospacial', [IkmController::class, 'geoSpacial']);
Route::get('statistik/ikm', [StatistikIkmController::class, 'index']);
Route::get('statistik/detail', [StatistikIkmController::class, 'detailChart']);
Route::get('master/kabupaten', [DataMasterController::class, 'getKabupaten']);
Route::get('master/kecamatan', [DataMasterController::class, 'getKecamatan']);
Route::get('master/kelurahan', [DataMasterController::class, 'getKelurahan']);
Route::get('master/cabang-industri', [DataMasterController::class, 'getCabangIndustri']);
Route::get('master/sub-cabang-industri', [DataMasterController::class, 'getSubCabangIndustri']);
