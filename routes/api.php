<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiProvizorController;
use App\Http\Controllers\OuterMarketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::get('sold', [UserController::class, 'testSold']);
Route::get('kubok', [UserController::class, 'testKubok']);


Route::get('soldp', [UserController::class, 'testSoldp']);
Route::get('order', [UserController::class, 'testOrder']);
Route::get('medicine', [UserController::class, 'testMedicine']);
Route::get('user', [UserController::class, 'testUser']);


Route::get('sharq', [ApiController::class, 'sharqKingSold']);
Route::get('garb', [ApiController::class, 'garbKingSold']);
Route::get('date/{date}', [ApiController::class, 'dateKingSold']);

Route::get('history', [ApiController::class, 'history']);
Route::get('outer-market', [OuterMarketController::class, 'outerMarketAllApi']);


Route::get('region-district', [ApiProvizorController::class,'getRegionDistrict']);
