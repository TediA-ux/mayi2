<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HobbyController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\ProfessionalBodyController;
use App\Http\Controllers\MemberController;

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

    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/profile/view', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/update', [ProfileController::class, 'update']);
    Route::post('/profile/password', [ProfileController::class, 'password']);
    Route::resource('parties', PartyController::class);
    Route::resource('districts', DistrictController::class);
    Route::get('/add/district/constituency/{id}', [DistrictController::class, 'addConstituency']);
    Route::post('/post/district/constituency', [DistrictController::class, 'postConstituency']);
    Route::get('/edit/constituency/{id}', [DistrictController::class, 'editConstituency']);
    Route::post('/update/district/constituency{id}', [DistrictController::class, 'updateConstituency']);
    Route::resource('hobbies', HobbyController::class);
    Route::resource('committees', CommitteeController::class);
    Route::resource('professions', ProfessionController::class);
    Route::resource('professional-bodies', ProfessionalBodyController::class);
    Route::resource('members', MemberController::class);
    Route::get('/district-constituencies/{id}', [MemberController::class, 'get_district_constituencies']);

});

Route::get('/php-info', function () {
    echo phpinfo();
});