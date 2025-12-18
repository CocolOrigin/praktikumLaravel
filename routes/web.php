<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'delete'])->name('profile.delete');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::middleware(['auth','admin'])->group(function () {
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'delete'])->name('books.delete');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
});

require __DIR__.'/auth.php';

Route::get('/profil', [HalamanController::class, 'halamanprofil']);
Route::get('/galeri', [HalamanController::class, 'halamangaleri']);
Route::get('/kontak', [HalamanController::class, 'halamankontak']);

// Route::get('/', [BookController::class, 'index'])->name('books.index');
// Route::get('/books/index', [BookController::class, 'index'])->name('books.index');
// Route::get('/books/show', [BookController::class, 'index'])->name('books.show');
// Route::get('/books/edit', [BookController::class, 'index'])->name('books.edit');
// Route::get('/books/delete', [BookController::class, 'index'])->name('books.delete');
// Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
// Route::post('/books', [BookController::class, 'store'])->name('books.store');
