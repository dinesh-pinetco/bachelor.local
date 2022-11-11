<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\GovernmentFormController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SelectionTestController;
use App\Http\Controllers\StudySheetController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;

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

Route::get('/', RegisterController::class)->name('index')->middleware('guest');

Route::get('moodle', [TestController::class, 'moodle']);
Route::get('fetch-result', [TestController::class, 'fetchResult']);
Route::get('test/{slug}/{email?}', [TestController::class, 'testMail']);
Route::get('test-study-sheet/{user}', [TestController::class, 'studySheetForm']);
Route::get('test-government-form/{user}', [TestController::class, 'governmentForm']);

Route::view('study-programs', 'study-programs')->name('study-programs');

Route::prefix('secret')->middleware(['role:'.ROLE_EMPLOYEE.'|'.ROLE_ADMIN.'|'.ROLE_SUPER_ADMIN])->group(function () {
    Route::get('logs', [LogViewerController::class, 'index']);
    Route::resource('backups', DatabaseBackupController::class)->only('index', 'show', 'create');
    Route::get('preview/backup/{file}', [DatabaseBackupController::class, 'preview'])->name('preview.backup');
});

Route::middleware(['signed'])->group(function () {
    Route::get('/study-sheet/{user}', StudySheetController::class)->name('study-sheet');
    Route::get('/government-form/{user}', GovernmentFormController::class)->name('government-form');
});

Route::middleware(['auth:sanctum', 'verified', 'role:'.ROLE_APPLICANT])->group(function () {
    Route::get('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::prefix('application/{tab:slug}')->name('application.')->group(function () {
        Route::get('/', ApplicationController::class)->name('index');
    });

    route::prefix('support')->group(function () {
        Route::get('contact-us', ContactUsController::class)->name('contact-us.index');
        Route::post('contact-us', [ContactUsController::class, 'store'])->name('contact-us.mail');

        Route::get('faq', FaqController::class)->name('faq.index');
    });

    Route::get('documents', DocumentController::class)->name('documents.index');
    Route::get('selection-test', [SelectionTestController::class, 'index'])->name('selection-test.index');

    Route::get('submit-application', [ApplicationController::class, 'submitApplication'])->name('submit-application');
});
Route::view('imprint', 'privacy_policy')->name('privacy_policy');
Route::view('datenschutz', 'data_protection')->name('data_protection');
