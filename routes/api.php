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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');

Route::group(['middleware' => ['auth:api']], function () {
    Route::resource('/users', 'Api\UserController');
    Route::resource('/posts', 'Api\PostController');

    Route::get('/posts/{post}/comments', 'Api\CommentController@getPostComments');

    Route::get('/users/{user}/comments', 'Api\CommentController@getUserComments');

    Route::post('/posts/{post}/comments', 'Api\CommentController@commentOnPost');
    
});