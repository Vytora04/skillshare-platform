<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
});

// Authentication routes (placeholder - will be replaced with proper auth)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');
    
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Projects routes
Route::get('/projects', function () {
    return view('projects.index');
})->name('projects.index');