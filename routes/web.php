<?php

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

//prefix "admin"
Route::prefix('admin')->group(function() {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('/dashboard', \App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');
        Route::resource('/mata_pelajaran', \App\Http\Controllers\Admin\mata_pelajaranController::class, ['as' => 'admin']);
        Route::resource('/kelas', \App\Http\Controllers\Admin\KelasController::class, ['as' => 'admin']);
        Route::get('/students/import', [\App\Http\Controllers\Admin\SiswaController::class, 'import'])->name('admin.students.import');
        Route::post('/students/import', [\App\Http\Controllers\Admin\SiswaController::class, 'storeImport'])->name('admin.students.storeImport');
        Route::resource('/students', \App\Http\Controllers\Admin\SiswaController::class, ['as' => 'admin']);
    });
});

