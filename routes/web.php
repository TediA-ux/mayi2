<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/home', function () {
    return view('reset');
});

Route::post('/user/login', [UserAuthenticationController::class, 'loginUser'])
    ->name('login.custom');
Route::post('/user/logout', [UserAuthenticationController::class, 'logOutUser'])
    ->name('logout.user');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::post('/user/activate/{id}', [UserController::class, 'activate']);
    Route::post('/user/deactivate/{id}', [UserController::class, 'deactivate']);
    Route::get('/', [SiteController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile/view', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/password', [ProfileController::class, 'password']);
    Route::get('/profile/view', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/password', [ProfileController::class, 'password']);

//filter members route
    Route::get('/members/filter/mps', [MemberController::class, 'memberfilter']);

    //pages routes
    Route::get('/about', [PageController::class, 'about']);
    Route::get('/archive', [PageController::class, 'archive']);
    Route::get('/contact', [PageController::class, 'contact']);
    Route::get('/contact/form', [PageController::class, 'contact_form']);

});

Route::get('/php-info', function () {
    echo phpinfo();
});
