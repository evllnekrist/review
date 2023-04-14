<?php

use App\Http\Controllers\SatisfactionController;

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
    return view('welcome');
});
Route::get('/create-link/{id}',[SatisfactionController::class,'create_raih']);
Route::get('/satisfaction',[SatisfactionController::class,'display_add_form']);
Route::post('/satisfaction/submit',[SatisfactionController::class,'store']);