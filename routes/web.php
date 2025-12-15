<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
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

// Email Verification Routes
Route::middleware('auth')->group(function () {
    Route::get('/email/verify', [VerificationController::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('/email/verification-notification', [VerificationController::class, 'resend'])->name('verification.resend');
});

// Password Reset Routes
Route::get('/forgot-password', [PasswordResetController::class, 'requestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.password.edit');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Invitation routes
Route::middleware('auth')->group(function () {
    Route::get('/invitations', [InvitationController::class, 'index'])->name('invitations.index');
    Route::post('/skill-posts/{skillPost}/invite', [InvitationController::class, 'store'])->name('invitations.store');
    Route::post('/invitations/{invitation}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');
    Route::post('/invitations/{invitation}/reject', [InvitationController::class, 'reject'])->name('invitations.reject');
    Route::delete('/invitations/{invitation}', [InvitationController::class, 'cancel'])->name('invitations.cancel');
});

// Project routes
Route::middleware('auth')->prefix('projects')->name('projects.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProjectController::class, 'index'])->name('index');
    Route::post('/from-invitation/{invitation}', [\App\Http\Controllers\ProjectController::class, 'createFromInvitation'])->name('create-from-invitation');
    Route::get('/{project}', [\App\Http\Controllers\ProjectController::class, 'show'])->name('show');
    Route::post('/{project}/tasks', [\App\Http\Controllers\ProjectController::class, 'storeTask'])->name('tasks.store');
    Route::post('/{project}/tasks/{task}/toggle', [\App\Http\Controllers\ProjectController::class, 'toggleTask'])->name('tasks.toggle');
});

// Messaging routes
Route::middleware('auth')->prefix('messages')->name('messages.')->group(function () {
    Route::get('/', [\App\Http\Controllers\MessageController::class, 'index'])->name('index');
    Route::get('/{user}', [\App\Http\Controllers\MessageController::class, 'show'])->name('show');
    Route::post('/{conversation}', [\App\Http\Controllers\MessageController::class, 'store'])->name('store');
});

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


