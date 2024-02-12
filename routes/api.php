<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['middleware' => ['api','checkPassword','changeLang']],function (){

    Route::get('get',[CategoryController::class,'index']);
    Route::get('getDataById',[CategoryController::class,'getDataById']);
    Route::post('changeStatus',[CategoryController::class,'changeStatus']);



Route::group([ 'prefix'=>'admin',  'middleware' => ['api','checkPassword','changeLang']],function (){

    Route::get('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);


    });

});

Route::group(['prefix'=>'user','middleware'=>'assignGuard:user_api'],function () {

    Route::post('user_profile', function () {

        return Auth::user();
    });



Route::group(['prefix'=>'user'],function (){

    Route::post('login_user',[AuthController::class,'userLogin']);
    });
});

