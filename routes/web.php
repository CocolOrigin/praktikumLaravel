<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', [HalamanController::class, 'profil']);
Route::get('/galeri', [HalamanController::class, 'galeri']);
Route::get('/kontak', [HalamanController::class, 'kontak']);

Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
Route::get('/books/show', [BookController::class, 'index'])->name('books.show');
Route::get('/books/edit', [BookController::class, 'index'])->name('books.edit');
Route::get('/books/delete', [BookController::class, 'index'])->name('books.delete');
// Route::get('/author/show', [AuthorController::class, 'show']);
Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');

