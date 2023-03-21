<?php

use App\Http\Controllers\Api\ApplicantApplyToCompanyController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\SannaUserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('platform/login', [LoginController::class, 'login']);

Route::middleware(['auth:sanctum', 'role:'.ROLE_EMPLOYEE.'|'.ROLE_ADMIN])->group(function () {
    Route::get('sanna-users', [SannaUserController::class, 'index']);
    Route::get('sanna-users/{user}', [SannaUserController::class, 'show']);
    Route::post('sanna-sync', [SannaUserController::class, 'userSync']);

    Route::get('/platform/firmenportal/bewerber', [ApplicantApplyToCompanyController::class, 'index']);
    Route::get('/platform/firmenportal/bewerber/{user}', [ApplicantApplyToCompanyController::class, 'show']);
    Route::put('/platform/firmenportal/bewerber/{user}', [ApplicantApplyToCompanyController::class, 'applicantRejection']);

    // /platform/firmenportal/bewerbung
    // /platform/firmenportal/test
    // /platform/firmenportal/testablauf
    // /platform/firmenportal/testablauf/{id}
    // /platform/firmenportal/testergebnis/iqt
    // /platform/firmenportal/testablauf/vid
    // /platform/firmenportal/testtan

    Route::post('logout', [LoginController::class, 'logout']);

    Route::middleware(['auth:sanctum', 'role:'.ROLE_ADMIN])->post('admin-create', function (Request $request) {
        $validateData = $request->validate([
            'type' => ['required', 'in:admin,employee'],
            'first_name' => ['required', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'password' => ['required'],
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        $user = User::factory()->create(Arr::except($validateData, ['type']));
        $request->type == 'admin' ? $user->assignRole(ROLE_ADMIN) : $user->assignRole(ROLE_EMPLOYEE);

        return response()->json(['message' => __('Admin create successfully.')]);
    });
});

Route::get('test/queue', function () {
    \App\Jobs\TestJob::dispatch();

    return 'success';
});
