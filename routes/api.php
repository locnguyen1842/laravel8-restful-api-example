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

Route::group(['prefix' => 'v1'], function () {

    Route::get('/', function() {
        return response(['message' => 'Ping Pong']);
    });

    Route::post('/login', 'Api\Auth\ApiLoginController@login');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('/ping', function() {
            return response(['message' => 'Pong']);
        });

        Route::get('/logout', 'Api\Auth\ApiLoginController@logout');
    
        Route::get('/posts/{post}/comments', 'Api\CommentController@getPostComments');
    
        Route::get('/users/{user}/comments', 'Api\CommentController@getUserComments');
    
        Route::post('/posts/{post}/comments', 'Api\CommentController@commentOnPost');
    
        Route::put('/comments/{comment}', 'Api\CommentController@update');
        
        Route::resource('/users', 'Api\UserController');
        Route::resource('/posts', 'Api\PostController');
        Route::resource('/comments', 'Api\CommentController')->except(['index', 'store']);
    });

    Route::group(['prefix' => 'another'], function () {

        Route::post('/login', 'Api\Auth\AnotherLoginController@login');

        Route::group(['middleware' => ['auth:another-api']], function () {

            Route::get('/logout', 'Api\Auth\AnotherLoginController@logout');
        
            Route::get('/ping', function() {
                return response(['message' => 'Another Pong']);
            });
        });
    });
});