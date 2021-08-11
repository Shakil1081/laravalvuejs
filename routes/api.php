<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Bookable;
use App\Http\Controllers\Api\BookAbleController;
use App\Http\Controllers\Api\BookableAvailabilityController;
use App\Http\Controllers\Api\BookableReviewController;
use App\Http\Controllers\Api\ReviewController;




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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bookable', [BookAbleController::class,'index']);

Route::get('/bookable/{id}', [BookAbleController::class,'show']);

Route::get('/bookable/{id}/availability', BookableAvailabilityController::class)
->name('book.availability.check');

Route::get('bookable/{id}/reviews', BookableReviewController::class)
->name('bookable.review.index');

//Route::get('reviews', [ReviewController::class, 'show']);
Route::apiResource('reviews', ReviewController::class)->only(['show']);
