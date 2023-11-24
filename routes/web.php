<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Models\Category;

Route::get('/', [CategoryController::class,"view"]);

Route::get('/signin', [UserController::class,"signin"]);
Route::get('/signup', [UserController::class,"signup"]);
Route::get('/signout', [UserController::class,"signout"]);
Route::get('/admin', [UserController::class,"admin"]);

Route::post('/signin/valid', [UserController::class,"signin_valid"]);
Route::post('/signup/valid', [UserController::class,"signup_valid"]);

Route::get('/articlesView/{id}', [ArticleController::class,"view"]);
Route::get('/sortOne/{id}', [ArticleController::class,"view"]);
Route::get('/sortTwo/{id}', [ArticleController::class,"sortTwo"]);

Route::get('/articleView/{id}', [ArticleController::class,"viewArticle"]);

Route::post('/addComment', [CommentController::class,"addComment"]);
Route::post('/delComment/{id}', [CommentController::class,"delComment"]);

Route::post('/delArticle/{id}', [ArticleController::class,"delArticle"]);
Route::post('/delCategory/{id}', [CategoryController::class,"delCategory"]);

Route::get('/admin', [ArticleController::class,"view"]);

Route::get('/addNew', [CategoryController::class,"addViewGo"]);

Route::post('/addCategory', [CategoryController::class,"addCategory"]);
Route::post('/addArticle', [ArticleController::class,"addArticle"]);

Route::get('/profile', [UserController::class,"profile"]);

Route::post('/redactProfile', [UserController::class,"redactProfile"]);
