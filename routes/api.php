<?php

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::fallback(function () {
    return response()->json([
        'message' => 'Unauthorized action.'], 404);
});

Route::group([
    'prefix' => 'events'
    ], function () {
        Route::get('/', 'EventController@events');
        Route::post('create', 'EventController@create');
        Route::post('bulk', 'EventController@bulk');
});