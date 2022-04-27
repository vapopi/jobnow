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
Route::apiResource('groups', GroupController::class);
Route::apiResource('groups/{gid}/messages', MessageController::class);
Route::apiResource('tickets', TicketController::class);
Route::apiResource('tickets/{tid}/comments', CommentController::class);
Route::apiResource('notifications', NotificationController::class)->middleware('auth');
Route::apiResource('posts', PostController::class);
Route::apiResource('offers', OfferController::class);

//Middleware rutas API Group
Route::get('api/groups', 'GroupController@index')->middleware(['auth', 'roles: 1, 4, 5']);
Route::post('api/groups', 'GroupController@store')->middleware(['auth', 'roles: 1, 4, 5']);
Route::get('api/groups/{group}', 'GroupController@show')->middleware(['auth', 'roles: 1, 4, 5']);
Route::put('api/groups/{group}', 'GroupController@update')->middleware(['auth', 'roles: 1, 4, 5']);
Route::delete('api/groups/{group}', 'GroupController@destroy')->middleware(['auth', 'roles: 1, 4, 5']);

//Middleware rutas API Message
Route::get('api/groups/{gid}/messages/{message}', 'MessageController@index')->middleware(['auth', 'roles: 1, 3, 4, 5']);
Route::post('api/groups/{gid}/messages', 'MessageController@store')->middleware(['auth', 'roles: 1, 4, 5']);
Route::get('api/groups/{gid}/messages/{message}', 'MessageController@show')->middleware(['auth', 'roles: 1, 3, 4, 5']);
Route::put('api/groups/{gid}/messages/{message}', 'MessageController@update')->middleware(['auth', 'roles: 1, 4, 5']);
Route::delete('api/groups/{gid}/messages/{message}', 'MessageController@destroy')->middleware(['auth', 'roles: 1, 3, 4, 5']);

//Middleware rutas API Ticket
Route::get('api/tickets', 'TicketController@index')->middleware(['auth', 'roles: 1, 2']);
Route::post('api/tickets', 'TicketController@store')->middleware(['auth', 'roles: 1, 5']);
Route::get('api/tickets/{ticket}', 'TicketController@show')->middleware(['auth', 'roles: 1, 2, 5']);
Route::put('api/tickets/{ticket}', 'TicketController@update')->middleware(['auth', 'roles: 1, 2, 5']);
Route::delete('api/tickets/{ticket}', 'TicketController@destroy')->middleware(['auth', 'roles: 1']);

//Middleware rutas API Comment
Route::get('api/tickets/{tid}/comments', 'CommentController@index')->middleware(['auth', 'roles: 2, 5']);
Route::post('api/tickets/{tid}/comments', 'CommentController@store')->middleware(['auth', 'roles: 2, 5']);
Route::get('api/tickets/{tid}/comments/{comment}', 'CommentController@show')->middleware(['auth', 'roles: 2, 5']);
Route::put('api/tickets/{tid}/comments/{comment}', 'CommentController@update')->middleware(['auth', 'roles: 2, 5']);
Route::delete('api/tickets/{tid}/comments/{comment}', 'CommentController@destroy')->middleware(['auth', 'roles: 2, 5']);

//Middleware rutas API Post
Route::get('api/posts', 'PostController@index')->middleware(['auth', 'roles: 1, 4, 5']);
Route::post('api/posts', 'PostController@store')->middleware(['auth', 'roles: 1, 4, 5']);
Route::get('api/posts/{post}', 'PostController@show')->middleware(['auth', 'roles: 1, 3, 4, 5']);
Route::put('api/posts/{post}', 'PostController@update')->middleware(['auth', 'roles: 1, 4, 5']);
Route::delete('api/posts/{post}', 'PostController@destroy')->middleware(['auth', 'roles: 1, 3, 4, 5']);

//Middleware rutas API Offer
Route::get('api/offers', 'OfferController@index')->middleware(['auth', 'roles: 1, 5']);
Route::post('api/offers', 'OfferController@store')->middleware(['auth', 'roles: 1, 4']);
Route::get('api/offers/{offer}', 'OfferController@show')->middleware(['auth', 'roles: 1, 4, 5']);
Route::put('api/offers/{offer}', 'OfferController@update')->middleware(['auth', 'roles: 1, 4']);