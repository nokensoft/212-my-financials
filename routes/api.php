<?php

use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Support\Facades\Route;

// Dikonsumsi oleh beranda (Alpine.js) dan dapat dipakai umum. Prefix "/api".
Route::get('/posts', [PostController::class, 'index'])->name('api.posts');
Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories');
Route::get('/albums', [AlbumController::class, 'index'])->name('api.albums');
