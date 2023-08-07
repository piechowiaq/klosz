<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RegistryController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\RegistryController as UserRegistryController;
use App\Http\Controllers\User\ReportController;
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

Route::get('/{user}/navigate', [DashboardController::class, 'navigate'])->name('user.navigate');

Route::middleware('user.authorize')->namespace('User')->name('user.')->group(static function (): void {


    Route::get('/{company}/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/{company}/registries', [UserRegistryController::class, 'index'])->name('registries.index');
    Route::get('/{company}/registries/{registry}', [UserRegistryController::class, 'show'])->name('registries.show');
    Route::get('/{company}/registries/{registry}/reports/create', [ReportController::class, 'create'])->name('reports.create');
    Route::post('/{company}/registries/{registry}/reports', [ReportController::class, 'store'])->name('reports.store');


});


require_once __DIR__ . '/fortify.php';
