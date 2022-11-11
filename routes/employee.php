<?php

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

use App\Http\Controllers\Employee\ActivityLogController;
use App\Http\Controllers\Employee\ApplicantController;
use App\Http\Controllers\Employee\ContactProfileController;
use App\Http\Controllers\Employee\CourseController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\DocumentController;
use App\Http\Controllers\Employee\FaqController;
use App\Http\Controllers\Employee\GroupController;
use App\Http\Controllers\Employee\ProfileController;
use App\Http\Controllers\Employee\SelectionTestController;
use App\Http\Controllers\Employee\SettingController;
use App\Http\Controllers\Employee\TestController;
use Illuminate\Support\Facades\Route;

Route::get('dashboard', DashboardController::class)->name('dashboard');

Route::get('profile', ProfileController::class)->name('profile');

Route::get('courses/{course}/clone', [CourseController::class, 'edit'])->name('courses.clone');
Route::resource('courses', CourseController::class)->only(['index', 'create', 'edit']);

Route::resource('settings', SettingController::class)->only(['index']);

Route::get('documents/{document}/clone', [DocumentController::class, 'edit'])->name('documents.clone');
Route::resource('documents', DocumentController::class)->only(['index', 'create', 'edit']);

Route::resource('contact-profiles', ContactProfileController::class)->only(['index', 'create', 'edit']);

Route::resource('tests', TestController::class)->only(['index', 'create', 'edit']);

Route::resource('faq', FaqController::class)->only(['index', 'create', 'edit']);

Route::group(['prefix' => 'applicants/{applicant}'], function () {
    Route::resource('selection-tests', SelectionTestController::class)->only(['index', 'show']);
    Route::get('{slug}', [ApplicantController::class, 'edit'])
        ->name('applicants.edit')
        ->where('slug', 'profile|career|motivation|documents|interviews|contracts');
});

Route::resource('applicants', ApplicantController::class)->only(['index', 'create']);

Route::prefix('settings')->name('settings.')->group(function () {
    Route::prefix('fields/{tab:slug}')->name('fields.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/create', [SettingController::class, 'create'])->name('create');
        Route::get('/edit/{field}', [SettingController::class, 'edit'])->name('edit');
        Route::get('/clone/{field}', [SettingController::class, 'edit'])->name('clone');
    });

    Route::prefix('groups/{tab:slug}')->name('groups.')->group(function () {
        Route::get('/', [GroupController::class, 'index'])->name('index');
        Route::get('/create', [GroupController::class, 'create'])->name('create');
        Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('edit');
        Route::get('/clone/{group}', [GroupController::class, 'edit'])->name('clone');
    });
});

Route::prefix('logs')->middleware(['role:'.ROLE_ADMIN])->name('logs.')->group(function () {
    Route::get('/applicants', [ActivityLogController::class, 'applicants'])->name('applicants');
    Route::get('/courses', [ActivityLogController::class, 'courses'])->name('courses');
    Route::get('/documents', [ActivityLogController::class, 'documents'])->name('documents');
    Route::get('/tests', [ActivityLogController::class, 'tests'])->name('tests');
    Route::get('/groups', [ActivityLogController::class, 'groups'])->name('groups');
    Route::get('/settings', [ActivityLogController::class, 'settings'])->name('settings');
    Route::get('/contact-profiles', [ActivityLogController::class, 'contactProfiles'])->name('contact-profiles');
    Route::get('/faq', [ActivityLogController::class, 'faq'])->name('faq');
});

Route::prefix('groups/{tab:slug}')->name('groups.')->group(function () {
    Route::get('/', [GroupController::class, 'index'])->name('index');
});
