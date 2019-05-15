<?php

use Illuminate\Http\Request;

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

Route::group([
    'middleware' => ['auth:api'],
    'namespace' => 'Api',
], function() {
    // update API token
    Route::put('todo/update_token', 'TodoController@updateToken');

    // todo destroy all
    Route::delete('todo/destroy_all', 'TodoController@destroyAll');

    // todo resource
    Route::resource('todo', 'TodoController');
});
