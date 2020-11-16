<?php

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

Route::namespace('Api')->group(function () {
    Route::get('posts/{id}', 'PostController@show');

    Route::group([
        'prefix' => '{entity}/{id}/comments',
        'where' => [
            'entity' => '[A-Za-z]+',
            'id' => '[0-9]+',
        ],
        'middleware' => 'XSS',
    ], function () {
        Route::get('/', 'CommentController@show');
        Route::post('/', 'CommentController@store');
    });
});
