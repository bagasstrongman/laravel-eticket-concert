<?php

use App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Api\Main;
use App\Http\Controllers\Api\Error;
use App\Http\Controllers\Api\Audit;
use App\Http\Controllers\Api\Admin;
use App\Http\Controllers\Api\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LandingController;

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

/*
|--------------------------------------------------------------------------
| Public Route
|--------------------------------------------------------------------------
|
| You can list public API for any user in here. These routes are not guarded
| by any authentication system. In other words, any user can access it directly.
| Remember not to list anything of importance, use authenticate route instead.
*/

Route::get('/', [LandingController::class, 'index'])->name('landing.index');

/*
|--------------------------------------------------------------------------
| Unauthenticated Route
|--------------------------------------------------------------------------
|
| You can list public API for any user in here. These routes are meant
| to be used for guests and are not guarded by any authentication system.
| Remember not to list anything of importance, use authenticate route instead.
*/

Route::middleware('guest')->group(function() {
    Route::apiResource('login', Auth\LoginController::class, ['only' => ['store']]);
    Route::apiResource('register', Auth\RegisterController::class, ['only' => ['store']]);
});

/*
|--------------------------------------------------------------------------
| Authenticated Route
|--------------------------------------------------------------------------
|
| In here you can list any route for authenticated user. These routes
| are meant to be used privately since the access is exclusive to authenticated
| user who had obtained their sanctum token from login API!
*/

Route::middleware('auth:sanctum')->group(function() {
    Route::apiResource('logout', Auth\LogoutController::class, ['only' => ['store']]);

    // Main Route
    Route::prefix('main')->middleware('role:user')->group(function() {
        Route::apiResource('payment', Main\PaymentController::class, ['only' => ['store']]);
        Route::apiResource('concert', Main\ConcertController::class, ['only' => ['index','show']]);
        Route::apiResource('transaction', Main\TransactionController::class, ['only' => ['index','show']]);
    });

    // Profile Route
    Route::prefix('profile')->group(function() {
        Route::apiResource('account', Profile\AccountController::class, ['only' => ['index','update']]);
    });

    // Admin Route
    Route::prefix('admin')->middleware('role:superadmin|admin')->group(function() {
        Route::apiResource('company', Admin\CompanyController::class);
        Route::apiResource('concert', Admin\ConcertController::class);
        Route::apiResource('account', Admin\AccountController::class);
        Route::apiResource('transaction', Admin\TransactionController::class);
        Route::apiResource('application', Admin\ApplicationController::class, ['only' => ['index','update']]);
    });
    
    // Audit Route
    Route::prefix('audit')->middleware('role:superadmin')->group(function() {
        Route::apiResource('query', Audit\QueryController::class, ['only' => ['index']]);
        Route::apiResource('system', Audit\SystemController::class, ['only' => ['index']]);
        Route::apiResource('auth', Audit\AuthController::class, ['only' => ['index','show']]);
        Route::apiResource('model', Audit\ModelController::class, ['only' => ['index','show']]);
    });
});

/*
|--------------------------------------------------------------------------
| Fallback Route
|--------------------------------------------------------------------------
| 
| Please don't touch the code below unless you know what you're doing.
| Also keep in mind to put this code at the bottom of the route for any route
| listed below this code will not function or listed properly.
*/

Route::any('{any}', [Error\FallbackController::class, 'index'])->where('any', '.*');