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
    Route::post('/login', 'Api\AuthController@login');
    Route::group(['middleware' => ['auth:api']], function () {
    
        Route::get('/posts/{post}/comments', 'Api\CommentController@getPostComments');
    
        Route::get('/users/{user}/comments', 'Api\CommentController@getUserComments');
    
        Route::post('/posts/{post}/comments', 'Api\CommentController@commentOnPost');
    
        Route::put('/comments/{comment}', 'Api\CommentController@update');
        
        Route::resource('/users', 'Api\UserController');
        Route::resource('/posts', 'Api\PostController');
        Route::resource('/comments', 'Api\CommentController')->except(['index', 'store']);
    });
});