<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HalamanController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

// --- AUTH ROUTES (USER & ADMIN) ---
// Harus login dulu
Route::middleware(['auth', 'verified'])->group(function () {
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Route Profile (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User & Admin bisa melihat daftar buku dan detailnya
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
    Route::get('/authors/{author}', [AuthorController::class, 'show'])->name('authors.show');
});

// --- ADMIN ONLY ROUTES ---
// Hanya Admin yang bisa menambah, mengubah, dan menghapus
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    
    // Manajemen Buku
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::patch('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    // Jika ada route admin lainnya, taruh di sini...
});

require __DIR__.'/auth.php';

Route::get('/profil', [HalamanController::class, 'halamanprofil']);
Route::get('/galeri', [HalamanController::class, 'halamangaleri']);
Route::get('/kontak', [HalamanController::class, 'halamankontak']);
