<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubscriptionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test',[UserController::class,'test']);
Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);

Route::get('user/{id}',[UserController::class,'info']);

Route::post('user/{user_id}/subscription/{subscription_id}/',[UserSubscriptionController::class,'store']);
Route::put('user/{user_id}/subscription/{subscription_id}',[UserSubscriptionController::class,'update']);
Route::delete('user/{user_id}/subscription/{subscription_id}',[UserSubscriptionController::class,'destroy']);

Route::post('user/{user_id}/transaction',[UserSubscriptionController::class,'transaction']);
