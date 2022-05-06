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
use App\Http\Controllers\ApplicatedOffersController;
use App\Http\Controllers\UsersApiController;
use App\Http\Controllers\CompaniesApiController;
use App\Http\Controllers\ProfessionalAreaApiController;

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
Route::apiResource('tickets/{tid}/comments', CommentController::class);
Route::apiResource('notifications', NotificationController::class);
Route::apiResource('posts', PostController::class);
Route::apiResource('offers', OfferController::class);
Route::apiResource('offers/{oid}/applicatedOffers', ApplicatedOffersController::class);
Route::apiResource('users', UsersApiController::class);
Route::apiResource('companies', CompaniesApiController::class);
Route::apiResource('professionalarea', ProfessionalAreaApiController::class);