<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\CommentApiController;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\TagApiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class,"register"]);
Route::post('/login', [AuthController::class,"login"]);

Route::middleware(["auth:sanctum"])->group(function()
{
Route::post("/logout",[AuthController::class,"logout"]);


Route::post('/comments/{post}', [CommentApiController::class,"store"]);
Route::get('/comments/{id}', [CommentApiController::class,"show"]);
Route::put('/comments/{id}', [CommentApiController::class,"update"]);
Route::delete('/comments/{id}', [CommentApiController::class,"destroy"]);


Route::get('/posts', [PostApiController::class,"index"]);
Route::post('/posts', [PostApiController::class,"store"]);
Route::get('/posts/{id}', [PostApiController::class,"show"]);
Route::put('/posts/{id}', [PostApiController::class,"update"]);
Route::delete('/posts/{id}', [PostApiController::class,"destroy"]);

Route::get('/categories', [CategoryApiController::class,"index"]);
Route::post('/categories', [CategoryApiController::class,"store"]);
Route::get('/categories/{id}', [CategoryApiController::class,"show"]);
Route::put('/categories/{id}', [CategoryApiController::class,"update"]);
Route::delete('/categories/{id}', [CategoryApiController::class,"destroy"]);

Route::get('/tags', [TagApiController::class,"index"]);
Route::post('/tags', [TagApiController::class,"store"]);
Route::get('/tags/{id}', [TagApiController::class,"show"]);
Route::put('/tags/{id}', [TagApiController::class,"update"]);
Route::delete('/tags/{id}', [TagApiController::class,"destroy"]);
});