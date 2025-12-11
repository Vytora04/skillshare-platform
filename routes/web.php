<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillPostController;
use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


Route::get('/skill-posts', [SkillPostController::class, 'index'])->name('skill-posts.index');
// Create + Store (authenticated) - placed before the parameter route to avoid route conflicts
Route::get('/skill-posts/create', [SkillPostController::class, 'create'])->name('skill-posts.create')->middleware('auth');
Route::post('/skill-posts', [SkillPostController::class, 'store'])->name('skill-posts.store')->middleware('auth');
Route::get('/skill-posts/{skillPost}', [SkillPostController::class, 'show'])->name('skill-posts.show');
Route::delete('/skill-posts/{skillPost}', [SkillPostController::class, 'destroy'])->name('skill-posts.destroy')->middleware(['auth', \App\Http\Middleware\IsModerator::class]);


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

    // create user (password will be hashed automatically because of the cast in User model)
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        // Hash the password before storing it so Auth::attempt() works correctly
        'password' => Hash::make($data['password']),
    ]);

    // Redirect to login page instead of auto-signing in
    return redirect()->route('login')->with('success', 'Account created successfully! Please sign in.');
});

// ... existing code ...

// 1. Handle the Login Form Submission
Route::post('/login', function (Request $request) {
    // Validate the input
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Try to log the user in
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        // Redirect to home upon success
        return redirect()->intended('home');
    }

    // If login fails, go back with an error
    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});

// 2. Handle Logout
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Projects routes
Route::get('/projects', function () {
    return view('projects.index');
})->name('projects.index');

// Admin area (example) - protect with auth and IsAdmin middleware
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware([\App\Http\Middleware\IsAdmin::class, 'auth'])->name('admin.dashboard');

// Admin user management routes
Route::middleware(['web', \App\Http\Middleware\IsAdmin::class, 'auth'])->prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [AdminController::class, 'listUsers'])->name('index');
    Route::get('/{user}', [AdminController::class, 'showUser'])->name('show');
    Route::patch('/{user}/toggle-role', [AdminController::class, 'toggleRole'])->name('toggle-role');
    Route::delete('/{user}', [AdminController::class, 'deleteUser'])->name('destroy');
});

// Temporary test route to verify server-side logout without the form (GET)
Route::get('/logout-test', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});


