<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;

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

Route::get('/', function () {
    return view('items.index');
});

Route::middleware('auth','verified')->group(function () {
    Route::get('/mypage/profile', [ProfileController::class, 'edit']);
    Route::post('/mypage',[ProfileController::class,'update']);
});

Route::get('/login',[LoginController::class, 'create']);
Route::post('/login',[LoginController::class, 'store']);
