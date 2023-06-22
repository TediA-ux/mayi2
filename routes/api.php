<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserAuthController as UserAuthController;

use App\Http\Controllers\API\UserController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserAuthController::class,'register']);
Route::post('check-email', [UserAuthController::class,'checkEmail']);
Route::post('login', [UserAuthController::class,'login']);

//forgot password/reset
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);









Route::middleware('auth:api')->group (function() {
    Route::post('/user/logout', [UserAuthController::class, 'logOutUser'])->name('logout.user');

    Route::Resource('users', UserController::class);

});


