<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\SmsSupport\Http\Controllers\Api\V1\SmsController;

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

Route::get('/v1/send-sms' , [SmsController::class , 'index']);
Route::post('/v1/send-sms' , [SmsController::class , 'store']);
