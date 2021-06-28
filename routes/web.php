<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);

Route::get('/posts', [MainController::class, 'getPosts'])->name('posts');

Route::get('/post/{post}', [MainController::class, 'navigateToSocialNetworkPost']);

Route::get('/post-content/{post}', [MainController::class, 'socialNetworkPostContent'])->name('post-content');

Route::post('/database-seed', [MainController::class, 'seedDataBase'])->name('seed-database');
