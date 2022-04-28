<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\OfferController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//apiResources
Route::apiResource('messages', MessageController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('tickets/{tid}/comments', CommentController::class)->middleware(['auth', 'roles: 2, 4', 'verified']);
Route::apiResource('notifications', NotificationController::class)->middleware('auth', 'verified');
Route::apiResource('posts', PostController::class);
Route::apiResource('offers', OfferController::class)->middleware('auth', 'roles: 1, 4', 'verified');

// //Middleware rutas API Message
Route::apiResource('messages', MessageController::class)->only([

    'index', 'show', 'destroy'

])->middleware('auth', 'roles: 1, 3, 4', 'verified');

Route::apiResource('messages', MessageController::class)->only([

    'store', 'update'

])->middleware('auth', 'roles: 1, 4', 'verified');

// //Middleware rutas API Ticket

Route::apiResource('tickets', TicketController::class)->only([

    'index'

])->middleware(['auth', 'roles: 1, 2', 'verified']);

Route::apiResource('tickets', TicketController::class)->only([

    'store'

])->middleware(['auth', 'roles: 1, 4', 'verified']);

Route::apiResource('tickets', TicketController::class)->only([

    'show', 'update'

])->middleware(['auth', 'roles: 1, 2, 4', 'verified']);

Route::apiResource('tickets', TicketController::class)->only([

    'destroy'

])->middleware(['auth', 'roles: 1', 'verified']);

//Middleware rutas API Post
Route::apiResource('posts', PostController::class)->only([

    'index', 'store', 'update'

])->middleware(['auth', 'roles: 1, 4', 'verified']);

Route::apiResource('posts', PostController::class)->only([

    'show', 'destroy'

])->middleware(['auth', 'roles: 1, 2, 4', 'verified']);