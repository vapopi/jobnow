<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\MenuCompanyController;
use App\Http\Controllers\RouteChatAppController;
use App\Http\Controllers\RouteMyNetworkController;
use App\Http\Controllers\RouteOffersController;
use App\Http\Controllers\RoutePostsController;
use App\Http\Controllers\RouteTicketsController;

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
    if(Auth::user())
    {
        return view('dashboard');
    }
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
Route::resource('/companies/menu', MenuCompanyController::class)->middleware(['auth', 'roles: 4', 'verified']);
Route::resource('/companies', CompanyController::class)->middleware(['auth', 'roles: 1, 4', 'verified']);
Route::resource('/premium', PremiumController::class)->middleware(['auth', 'roles: 1,4', 'verified']);
Route::resource('/security/accounts', AccountController::class)->middleware(['auth', 'roles: 1', 'verified']);
Route::resource('/security', SecurityController::class)->middleware(['auth', 'roles: 1', 'verified']);
Route::resource('/chatapp', RouteChatAppController::class)->middleware(['auth', 'roles: 3, 4', 'verified']);
Route::resource('/mynetwork', RouteMyNetworkController::class)->middleware(['auth', 'roles: 4', 'verified']);
Route::resource('/offers', RouteOffersController::class)->middleware(['auth', 'roles: 4', 'verified']);
Route::resource('/posts', RoutePostsController::class)->middleware(['auth', 'roles: 3, 4', 'verified']);
Route::resource('/tickets', RouteTicketsController::class)->middleware(['auth', 'roles: 2, 4', 'verified']);


// Middleware rutas User
Route::resource('/users', UserController::class)->only([

    'index', 'create', 'store', 'destroy'

])->middleware(['auth', 'roles: 1', 'verified']);

Route::resource('/users', UserController::class)->only([

    'create', 'store'

])->middleware('guest');

Route::resource('/users', UserController::class)->only([

    'edit', 'update', 'destroy'

])->middleware(['auth', 'verified']);