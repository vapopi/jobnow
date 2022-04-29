<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\RoleController;

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

Route::get('/', function (Request $request) {
    return view('auth.login');
 });
 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/roles', RoleController::class)->middleware(['auth', 'roles: 1', 'verified']);
Route::resource('/users', UserController::class);
Route::resource('/companies', CompanyController::class)->middleware(['auth', 'roles: 1. 4', 'verified']);
Route::resource('/security', SecurityController::class)->middleware(['auth', 'roles: 1', 'verified']);
Route::resource('/premium', PremiumController::class)->middleware(['auth', 'roles: 4', 'verified']);

// Middleware rutas User
Route::resource('/users', UserController::class)->only([

    'index', 'create', 'store', 'destroy'

])->middleware(['auth', 'roles: 1', 'verified']);

Route::resource('/users', UserController::class)->only([

    'create', 'store'

])->middleware('guest');

Route::resource('/users', UserController::class)->only([

    'edit', 'update'

])->middleware(['auth', 'verified']);