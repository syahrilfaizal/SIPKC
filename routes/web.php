<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/form', function () {
    return view('layout.form');
})->name('form');

Route::get('/login', function () {
    return view('partials.login'); // Mengarahkan ke login.blade.php
})->name('login');

Route::get('/register', function () {
    return view('partials.register'); // Mengarahkan ke login.blade.php
})->name('register');