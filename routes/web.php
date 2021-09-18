<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LogController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Laravel\Fortify\Http\Controllers\EmailVerificationNotificationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;

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

$enableViews = config('fortify.views', true);
if ($enableViews) {
    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])->middleware(['auth'])->name('verification.notice');
}
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['auth', 'signed', 'throttle:6,1'])->name('verification.verify');
Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => config('settings.prefix', 'admin'),], function () {

    Route::get('/', [AdminController::class, 'index'])->middleware('PermissionCheck:dashboard,read')->name('dashboard');
    Route::get('dashboard', [AdminController::class, 'index'])->middleware('PermissionCheck:dashboard,read')->name('dashboard');

    /* Users */
    Route::group(['prefix' => 'users'], function (){
        Route::get('/', [UserController::class, 'index'])->middleware('PermissionCheck:users,read')->name('users.index');
        Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
        Route::get('/{id}', [UserController::class, 'destroy'])->whereNumber('id')->middleware('PermissionCheck:users,delete')->name('users.destroy');
        Route::get('/create', [UserController::class, 'create'])->middleware('PermissionCheck:users,create')->name('users.create');
        Route::post('/', [UserController::class, 'store'])->middleware('PermissionCheck:users,store')->name('users.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->whereNumber('id')->middleware('PermissionCheck:users,edit')->name('users.edit');
        Route::put('/{id}', [UserController::class, 'update'])->whereNumber('id')->middleware('PermissionCheck:users,update')->name('users.update');
    });

    /* Roles */
    Route::group(['prefix' => 'roles'], function (){
        Route::get('/', [RoleController::class, 'index'])->middleware('PermissionCheck:roles,read')->name('roles.index');
        Route::get('/{id}', [RoleController::class, 'destroy'])->whereNumber('id')->middleware('PermissionCheck:roles,delete')->name('roles.destroy');
        Route::get('/create', [RoleController::class, 'create'])->middleware('PermissionCheck:roles,create')->name('roles.create');
        Route::post('/', [RoleController::class, 'store'])->middleware('PermissionCheck:roles,store')->name('roles.store');
        Route::get('/{id}/edit', [RoleController::class, 'edit'])->whereNumber('id')->middleware('PermissionCheck:roles,edit')->name('roles.edit');
        Route::put('/{id}', [RoleController::class, 'update'])->whereNumber('id')->middleware('PermissionCheck:roles,update')->name('roles.update');
    });

    /* Logs */
    Route::get('logs', [LogController::class, 'index'])->middleware('PermissionCheck:logs,read')->name('logs.index');

    /* Activities */
    Route::group(['prefix' => 'activities'], function (){
        Route::get('/', [ActivityController::class, 'index'])->middleware('PermissionCheck:activities,read')->name('activities.index');
        Route::get('/{id}', [ActivityController::class, 'destroy'])->whereNumber('id')->middleware('PermissionCheck:activities,delete')->name('activities.destroy');
        Route::get('/delete', [ActivityController::class, 'deleteAll'])->middleware('PermissionCheck:activities,delete')->name('activities.deleteAll');
    });

});
