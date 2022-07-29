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
// /api/posts
Route::get('posts', 'Api\PostController@index');
Route::get('posts/{slug}', 'Api\PostController@show');

// api/categories
Route::get('categories', 'Api\CategoryController@index');
// api/categories/{slug}
Route::get('categories/{slug}', 'Api\CategoryController@show');

// api/tags/{slug}
Route::get('tags/{slug}', 'Api\TagController@show');

// POST: api/comments/{post_id} oppure api/comments
Route::post('comments/{post_id}', 'Api\CommentController@store');