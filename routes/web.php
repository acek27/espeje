<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Rekening\SubkegiatanController;
use App\Http\Controllers\Rekening\UraianController;
use App\Http\Controllers\General\SpjController;
use App\Http\Controllers\General\RevisiController;
use App\Http\Controllers\General\AnggaranController;
use App\Http\Controllers\PermissionController;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
//Permission
    Route::get('/permission/data', [PermissionController::class, 'anyData'])->name('permission.anydata');
    Route::delete('/permission/{id}/delete', [PermissionController::class, 'delete'])->name('permission.delete');
    Route::resource('permission', PermissionController::class);
//Home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Sub Kegiatan
    Route::get('/subkegiatan/data', [SubkegiatanController::class, 'anyData'])->name('subkegiatan.data');
    Route::resource('subkegiatan', SubkegiatanController::class);

//Uraian
    Route::get('/uraian/data', [UraianController::class, 'anyData'])->name('uraian.data');
    Route::get('/uraian/filter/{kode_rek}', [UraianController::class, 'filter'])->name('uraian.filter');
    Route::resource('/uraian', UraianController::class);

//SPJ
    Route::get('/spj/data/{status}/more', [SpjController::class, 'more'])->name('spj.more');
    Route::post('/spj/listuraian/', [SpjController::class, 'listuraian'])->name('spj.uraian');
    Route::post('/spj/rat/', [SpjController::class, 'rat'])->name('spj.rat');
    Route::put('/spj/jenis/{id}', [SpjController::class, 'jenis'])->name('spj.jenis');
    Route::get('/spj/data', [SpjController::class, 'anyData'])->name('spj.data');
    Route::get('/spj/moredata', [SpjController::class, 'moredata'])->name('spj.moredata');
    //upload
    Route::get('/spj/upload/{document}', [SpjController::class, 'upload'])->name('spj.upload');
    Route::post('/spj/upload/{document}', [SpjController::class, 'storeDoc'])->name('spj.storeDoc');
    Route::get('/spj/laporan/file/{document}', [SpjController::class, 'file'])->name('spj.file');
    Route::post('/spj/upload/', [SpjController::class, 'deleteDoc'])->name('spj.deleteDoc');
    Route::resource('/spj', SpjController::class);

    Route::post('/laportugas/upload/', 'Assignment\Tenagatik\LaportugasController@deleteDocument')->name('laportugas.deleteDoc');
//Revisi
    Route::resource('/revisi', RevisiController::class);

//Anggaran
    Route::resource('/anggaran', AnggaranController::class);
});
