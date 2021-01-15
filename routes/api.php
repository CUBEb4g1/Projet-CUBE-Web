<?php

use App\Http\Controllers\API\CategoryApiController;
use App\Http\Controllers\API\ResourceApiController;
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

// API Resources
Route::get('resources/{id}', [ResourceApiController::class, 'show']);
Route::get('resources/', [ResourceApiController::class, 'search']);
Route::get('resources/top/', [ResourceApiController::class, 'top']);

// API Category
Route::get("category/", [CategoryApiController::class, 'search']);



//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
