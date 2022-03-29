<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rekening\SubkegiatanController;
use App\Http\Controllers\Rekening\UraianController;
use App\Http\Controllers\General\SpjController;
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
    return view('dashboard');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/subkegiatan/data', [SubkegiatanController::class, 'anyData'])->name('subkegiatan.data');
Route::resource('subkegiatan', SubkegiatanController::class);
Route::get('/uraian/data', [UraianController::class, 'anyData'])->name('uraian.data');
Route::get('/uraian/filter/{kode_rek}', [UraianController::class, 'filter'])->name('uraian.filter');
Route::resource('/uraian', UraianController::class);
Route::post('/spj/listuraian/{id}', [SpjController::class, 'listuraian'])->name('spj.uraian');
Route::resource('/spj', SpjController::class);
