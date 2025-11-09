<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HalamanController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profil', [HalamanController::class, 'profil']);
Route::get('/galeri', [HalamanController::class, 'galeri']);
Route::get('/kontak', [HalamanController::class, 'kontak']);
