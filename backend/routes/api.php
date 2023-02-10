<?php

use App\Http\Controllers\api\v1\diaryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'v1'], function(){
    Route::get('/diary/list/{id}', [diaryController::class, 'listUserPosts']);
    Route::apiResource('diary', diaryController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [UserController::class, 'register']);
Route::post('login',[UserController::class, 'login']);

Route::middleware('auth:api')->get('/user', function(Request $request){
    return $request->user();
});
