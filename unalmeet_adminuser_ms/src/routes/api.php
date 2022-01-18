<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\AuthController;

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

//public routes
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);

//protecte routes 
Route::group (['middleware'=>['auth:sanctum']], function (){
    //aca van los las funciones que puede hacer un usuario
    Route::get('/show',[AuthController::class,'show']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::post('/update',[AuthController::class,'update']);
    
});
