<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;

use App\Http\Controllers\RegistryController;
use App\Http\Controllers\User\RegistryController as UserRegistryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::middleware('admin.authorize')->group(static function (): void {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('roles', RoleController::class);
    Route::put('roles/{role}/restore', [RoleController::class, 'restore'])->name('roles.restore');
    Route::resource('permissions', PermissionController::class);
    Route::put('permissions/{permission}/restore', [PermissionController::class, 'restore'])->name('permissions.restore');
    Route::resource('users', UserController::class);
    Route::put('users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::resource('companies', CompanyController::class);
    Route::put('companies/{company}/restore', [CompanyController::class, 'restore'])->name('companies.restore');
    Route::resource('registries', RegistryController::class);
    Route::put('registries/{registry}/restore', [RegistryController::class, 'restore'])->name('registries.restore');

});


Route::middleware('user.authorize')->namespace('User')->name('user.')->group(static function (): void {

    Route::get('/{user}/navigate', [DashboardController::class, 'navigate'])->name('navigate');
    Route::get('/{company}/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/{company}/registries', [UserRegistryController::class, 'index'])->name('registries.index');
//    Route::resource('/{company}/reports', 'ReportController');
//    Route::get('/{company}/reports/{report}/download', 'ReportController@download')->name('reports.download');
//


});


require_once __DIR__ . '/fortify.php';
