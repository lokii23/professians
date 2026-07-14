<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MessageController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTE
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| STUDENT ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [ExamController::class, 'index'])
        ->name('dashboard');

    // Exam preview (enter passkey page)
    Route::get('/exam/{id}', [ExamController::class, 'preview'])
        ->name('exam.preview');

    // Check passkey
    Route::post('/check-passkey', [ExamController::class, 'checkPasskey'])
        ->name('exam.check');

    // (NEXT STEP - for later)
    // Take exam page
    Route::get('/exam/take/{id}', [ExamController::class, 'take'])
        ->name('exam.take');
        
    Route::post('/exam/submit', [ExamController::class, 'submitExam'])
        ->name('exam.submit');

    Route::get('/live-exams', [ExamController::class, 'liveExams'])
        ->name('live.exams');

    Route::get('/exam-success', function () {
        return view('student.exam_success');})->name('exam.success');   
    Route::get(
        '/student/result',
        [ExamController::class, 'studentResults']
    )->name('student.result');

    Route::get(
        '/student/result/{id}',
        [ExamController::class, 'viewStudentResult']
    )->name('student.result.view');

    Route::get('/student/faculty', function () {
        return view('student.faculty');
    })->name('student.faculty');
    Route::get('/student/attendance', function () {
        return view('student.attendance');
    })->name('student.attendance');
    
    });

Route::middleware(['auth'])->group(function () {

    Route::get('/messages', [MessageController::class, 'index'])
        ->name('messages.index');

    Route::get('/messages/{user}', [MessageController::class, 'show'])
        ->name('messages.show');

    Route::post('/messages/send', [MessageController::class, 'send'])
        ->name('messages.send');
});

Route::middleware('auth')->group(function () {

    Route::get('/my-profile', [ProfileController::class, 'index'])
        ->name('profile.index');

    Route::post('/my-profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

        Route::post('/change-password', [ProfileController::class, 'changePassword'])
    ->name('profile.password');

});
/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [ExamController::class, 'admin'])
            ->name('admin.dashboard');

        Route::get('/exams', [ExamController::class, 'exams'])
            ->name('admin.exams');

        Route::get('/create-exam',[ExamController::class, 'create'])
            ->name('admin.create-exam');

        Route::post('/store-exam', [ExamController::class, 'store'])
            ->name('admin.store-exam');

        Route::put('/update-exam/{id}', [ExamController::class, 'update'])
            ->name('admin.update-exam');

        Route::delete('/delete-exam/{id}', [ExamController::class, 'destroy'])
            ->name('admin.delete-exam');

        Route::post('/toggle-exam/{id}', [ExamController::class, 'toggleExam'])
            ->name('admin.toggle-exam');

        Route::get('/results/{id}',[ExamController::class, 'results'])
            ->name('admin.results');

        // QUESTIONS MANAGEMENT
        Route::get('/questions/{id}', [ExamController::class, 'questionsPage'])
            ->name('admin.questions');

        Route::get('/questions/{id}/add', [ExamController::class, 'showAddQuestion'])
            ->name('admin.show-add-question');

        Route::post('/questions/store', [ExamController::class, 'storeQuestions'])
            ->name('admin.store-question');
    
        Route::put('/questions/update/{id}', [ExamController::class, 'updateQuestion'])
            ->name('admin.update-question');

        Route::delete('/questions/delete/{id}', [ExamController::class, 'deleteQuestion'])
            ->name('admin.delete-question');

        // SECTIONS
        Route::get('/sections', [AdminController::class, 'sections'])
            ->name('admin.sections');
            

        Route::get('/sections/{course}', [AdminController::class, 'studentsBySection'])
            ->name('admin.sections.show');

        Route::post('/questions/correct-answer/{id}',[ExamController::class, 'updateCorrectAnswer'])
            ->name('admin.correct-answer');

        Route::get('/review-result/{id}',[ExamController::class, 'reviewResult'])
            ->name('admin.review-result');

        Route::post('/recheck-answer/{id}',[ExamController::class, 'recheckAnswer'])
            ->name('admin.recheck-answer');

        Route::post(
            '/admin/toggle-result/{id}',
            [ExamController::class, 'toggleResult']
        )->name('admin.toggle-result');

        Route::post(
            '/admin/exam/{id}/shuffle',
            [ExamController::class, 'toggleShuffle']
        )->name('admin.exam.shuffle');

        Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])
            ->name('admin.users.update');

        Route::post('/admin/users/{id}/disable',
            [AdminController::class, 'disableUser'])
            ->name('admin.users.disable');

        Route::post('/admin/users/{id}/enable',
        [AdminController::class, 'enableUser'])
        ->name('admin.users.enable');


        Route::post(
            '/admin/exams/{id}/copy',
            [ExamController::class, 'copyExam']
        )->name('admin.copy-exam');

        Route::get(
            '/admin/results/{id}/export',
            [AdminController::class,'exportResults']
        )->name('admin.results.export');

    });

Route::get('/explore-ccs', function () {
    return view('student.explore-ccs');
})->name('student.explore');
/*
|--------------------------------------------------------------------------
| AUTH ROUTES (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';