<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillPostController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


Route::get('/skill-posts', [SkillPostController::class, 'index'])->name('skill-posts.index');
Route::get('/skill-posts/{skillPost}', [SkillPostController::class, 'show'])->name('skill-posts.show');


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

Route::post('/register', function (Request $request) {
    // validate incoming data
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'string', 'min:6', 'confirmed'],
    ]);

    // create user (password will be hashed automatically because of the cast in User model) :contentReference[oaicite:2]{index=2}
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => $data['password'],
    ]);

    // log them in
    Auth::login($user);

    // redirect to home (or wherever you want)
    return redirect('/home');
});

// Projects routes
Route::get('/projects', function () {
    return view('projects.index');
})->name('projects.index');


