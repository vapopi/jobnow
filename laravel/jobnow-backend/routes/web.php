<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\PremiumController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('/users', UserController::class);
Route::resource('/companies', CompanyController::class);
Route::resource('/security', SecurityController::class);
Route::resource('/premium', PremiumController::class);

//Middleware rutas User
// Route::get('users', [UserController::class, 'index'])->middleware(['auth', 'roles: 1']);
// Route::get('users/create', [UserController::class, 'create'])->middleware(['auth', 'roles: 1']);
// Route::get('users/create', [UserController::class, 'create'])->middleware('guest');
// Route::post('users', [UserController::class, 'store'])->middleware(['auth', 'roles: 1']);
// Route::post('users', [UserController::class, 'store'])->middleware('guest');
// Route::get('users/{user}', [UserController::class, 'show'])->middleware(['auth', 'roles: 1']);
// Route::get('users/{user}/edit', [UserController::class, 'edit'])->middleware(['auth']);
// Route::put('users/{user}', [UserController::class, 'update'])->middleware(['auth']);
// Route::delete('users/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'roles: 1']);

// //Middleware rutas Company
// Route::get('/companies', [UserController::class, 'index'])->middleware(['auth', 'roles: 1']);
// Route::get('/companies/create', [UserController::class, 'create'])->middleware(['auth', 'roles: 1']);
// Route::get('/companies/create', [UserController::class, 'create'])->middleware('guest');
// Route::post('/companies', [UserController::class, 'store'])->middleware(['auth', 'roles: 1']);
// Route::post('/companies', [UserController::class, 'store'])->middleware('guest');
// Route::get('/companies/{company}', [UserController::class, 'show'])->middleware(['auth', 'roles: 1']);
// Route::get('/companies/{company}/edit', [UserController::class, 'edit'])->middleware(['auth']);
// Route::put('/companies/{company}', [UserController::class, 'update'])->middleware(['auth']);
// Route::delete('/companies/{company}', [UserController::class, 'destroy'])->middleware(['auth', 'roles: 1']);

// //Middleware rutas Security
// Route::get('/security', [SecurityController::class, 'index'])->middleware(['auth', 'roles: 1']);

// //Middleware rutas Premium
// Route::get('/premium', [PremiumController::class], 'index')->middleware(['auth', 'roles: 4, 5']);