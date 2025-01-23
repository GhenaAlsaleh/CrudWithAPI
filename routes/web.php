<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;


Route::middleware("guest")->group(function()
{

});
Route::get("/",[AuthController::class,"showLoginForm"])->name("login");
Route::post("/",[AuthController::class,"login"]);
Route::middleware("auth")->group(function()
{
    Route::post("/logout",[AuthController::class,"logout"])->name("logout");
    Route::resource('posts', PostController::class);
    Route::resource('comments', CommentController::class);
    Route::post('/{post}', [CommentController::class,"store"])->name("comments.store");
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::post('/', [TagController::class,"store"])->name("tags.store");
    Route::get('/users/dashboard', [UserController::class,"dashboard"])->name('users.dashboard');
    Route::get('/changeUserStatus/{status}/{id}', [UserController::class,"changeUserStatus"]);
    Route::get('/change-password/{user}', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::post('/change-password/{user}', [UserController::class, 'updatePassword'])->name('users.update-password');

});
