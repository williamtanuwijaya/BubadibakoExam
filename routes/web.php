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

Route::prefix('admin')->group(function() {

    //middleware "auth"
    Route::group(['middleware' => ['auth']], function () {

        //route dashboard
        Route::get('/dashboard', App\Http\Controllers\Admin\DashboardController::class)->name('admin.dashboard');

        //route resource lessons
        Route::resource('/lessons', \App\Http\Controllers\Admin\mata_pelajaranController::class, ['as' => 'admin']);

        //route resource classrooms
        Route::resource('/classrooms', \App\Http\Controllers\Admin\KelasController::class, ['as' => 'admin']);

        //route student import
        Route::get('/students/import', [\App\Http\Controllers\Admin\SiswaController::class, 'import'])->name('admin.students.import');

        //route student store import
        Route::post('/students/import', [\App\Http\Controllers\Admin\SiswaController::class, 'storeImport'])->name('admin.students.storeImport');

        //route resource students
        Route::resource('/students', \App\Http\Controllers\Admin\SiswaController::class, ['as' => 'admin']);

        //route resource exams
        Route::resource('/exams', \App\Http\Controllers\Admin\UjianController::class, ['as' => 'admin']);

        //custom route for create question exam
        Route::get('/exams/{exam}/questions/create', [\App\Http\Controllers\Admin\UjianController::class, 'createQuestion'])->name('admin.exams.createQuestion');

        //custom route for store question exam
        Route::post('/exams/{exam}/questions/store', [\App\Http\Controllers\Admin\UjianController::class, 'storeQuestion'])->name('admin.exams.storeQuestion');

        //custom route for edit question exam
        Route::get('/exams/{exam}/questions/{question}/edit', [\App\Http\Controllers\Admin\UjianController::class, 'editQuestion'])->name('admin.exams.editQuestion');

        //custom route for update question exam
        Route::put('/exams/{exam}/questions/{question}/update', [\App\Http\Controllers\Admin\UjianController::class, 'updateQuestion'])->name('admin.exams.updateQuestion');

        //custom route for destroy question exam
        Route::delete('/exams/{exam}/questions/{question}/destroy', [\App\Http\Controllers\Admin\UjianController::class, 'destroyQuestion'])->name('admin.exams.destroyQuestion');

        //route student import
        Route::get('/exams/{exam}/questions/import', [\App\Http\Controllers\Admin\UjianController::class, 'import'])->name('admin.exam.questionImport');

        //route student import
        Route::post('/exams/{exam}/questions/import', [\App\Http\Controllers\Admin\UjianController::class, 'storeImport'])->name('admin.exam.questionStoreImport');

        //route resource exam_sessions
        Route::resource('/exam_sessions', \App\Http\Controllers\Admin\SesiUjianController::class, ['as' => 'admin']);

        //custom route for enrolle create
        Route::get('/exam_sessions/{exam_session}/enrolle/create', [\App\Http\Controllers\Admin\SesiUjianController::class, 'createEnrolle'])->name('admin.exam_sessions.createEnrolle');

        //custom route for enrolle store
        Route::post('/exam_sessions/{exam_session}/enrolle/store', [\App\Http\Controllers\Admin\SesiUjianController::class, 'storeEnrolle'])->name('admin.exam_sessions.storeEnrolle');

        //custom route for enrolle destroy
        Route::delete('/exam_sessions/{exam_session}/enrolle/{exam_group}/destroy', [\App\Http\Controllers\Admin\SesiUjianController::class, 'destroyEnrolle'])->name('admin.exam_sessions.destroyEnrolle');

        //route index reports
        Route::get('/reports', [\App\Http\Controllers\Admin\LaporanController::class, 'index'])->name('admin.reports.index');

        //route index reports filter
        Route::get('/reports/filter', [\App\Http\Controllers\Admin\LaporanController::class, 'filter'])->name('admin.reports.filter');

        //route index reports export
        Route::get('/reports/export', [\App\Http\Controllers\Admin\LaporanController::class, 'export'])->name('admin.reports.export');
    });
});

//route homepage
Route::get('/', function () {

    //cek session student
    if(auth()->guard('student')->check()) {
        return redirect()->route('student.dashboard');
    }

    //return view login
    return \Inertia\Inertia::render('Pelajar/Login/Index');
});

//login students
Route::post('/students/login', \App\Http\Controllers\Pelajar\LoginController::class)->name('student.login');

//prefix "student"
Route::prefix('student')->group(function() {

    //middleware "student"
    Route::group(['middleware' => 'student'], function () {

        //route dashboard
        Route::get('/dashboard', App\Http\Controllers\Pelajar\DashboardController::class)->name('student.dashboard');

        //route exam confirmation
        Route::get('/exam-confirmation/{id}', [App\Http\Controllers\Pelajar\UjianController::class, 'confirmation'])->name('student.exams.confirmation');

        //route exam start
        Route::get('/exam-start/{id}', [App\Http\Controllers\Pelajar\UjianController::class, 'startExam'])->name('student.exams.startExam');

        //route exam show
        Route::get('/exam/{id}/{page}', [App\Http\Controllers\Pelajar\UjianController::class, 'show'])->name('student.exams.show');

        //route exam update duration
        Route::put('/exam-duration/update/{grade_id}', [App\Http\Controllers\Pelajar\UjianController::class, 'updateDuration'])->name('student.exams.update_duration');

        //route answer question
        Route::post('/exam-answer', [App\Http\Controllers\Pelajar\UjianController::class, 'answerQuestion'])->name('student.exams.answerQuestion');

        //route exam end
        Route::post('/exam-end', [App\Http\Controllers\Pelajar\UjianController::class, 'endExam'])->name('student.exams.endExam');

        //route exam result
        Route::get('/exam-result/{exam_group_id}', [App\Http\Controllers\Pelajar\UjianController::class, 'resultExam'])->name('student.exams.resultExam');
    });

});
