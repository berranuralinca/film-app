<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/movies');

Route::resource('movies', MovieController::class);

Route::post('/movies/{movie}/comments', [CommentController::class, 'store'])->name('comments.store');

Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
