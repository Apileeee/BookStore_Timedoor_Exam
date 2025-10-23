<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', [BookController::class, 'index'])->name('books.index');
Route::get('/top-authors', [BookController::class, 'topAuthors'])->name('books.top');
Route::get('/add-rating', [BookController::class, 'createRating'])->name('books.add');
Route::post('/add-rating', [BookController::class, 'storeRating'])->name('books.store');
Route::get('/books-by-author/{authorId}', [BookController::class, 'getBooksByAuthor']);
