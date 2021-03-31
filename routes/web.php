<?php

use App\Http\Controllers\shortenerController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/home', [shortenerController::class, 'index'])->middleware(["auth"]);
Route::post('/home', [shortenerController::class, 'store'])->middleware(["auth"])->name("store");
Route::get('/{prefix}', [shortenerController::class, 'goto']);
