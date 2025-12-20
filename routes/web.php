<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SkillPostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrgVerificationController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\PasswordResetController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


// Skill Posts Route (Mock Data)
Route::get('/skill-posts', function (Request $request) {
    // 1. Generate Mock Data (24 items)
    $skillPosts = collect();
    $types = ['Offer', 'Need'];
    $categories = ['Design', 'Development', 'Marketing', 'Writing', 'Translation', 'Mentorship'];
    
    for ($i = 1; $i <= 24; $i++) {
        fake()->seed($i + 1000); // Distinct seed from projects
        
        $type = $types[array_rand($types)];
        $category = $categories[$i % count($categories)];
        
        $skillPosts->push([
            'id' => $i,
            'title' => ($type === 'Offer' ? 'Offering: ' : 'Looking for: ') . fake()->jobTitle(),
            'type' => $type,
            'category' => $category,
            // User Data
            'user_name' => fake()->name(),
            'user_avatar' => 'https://ui-avatars.com/api/?name=' . urlencode(fake()->name()) . '&background=random&color=fff',
            'location' => fake()->city() . ', ' . fake()->country(),
            'posted_ago' => rand(1, 14) . ' days ago',
            'description' => fake()->paragraph(2),
            // Badges
            'is_verified' => rand(0, 1) === 1,
            'response_rate' => rand(80, 100) . '%',
        ]);
    }

    // 2. Filter Logic
    
    // Search
    if ($search = $request->input('search')) {
        $skillPosts = $skillPosts->filter(function ($item) use ($search) {
            return stripos($item['title'], $search) !== false || 
                   stripos($item['description'], $search) !== false ||
                   stripos($item['user_name'], $search) !== false;
        });
    }

    // Filter by Type
    if ($type = $request->input('type')) {
        if ($type !== 'All Types') {
            $skillPosts = $skillPosts->where('type', $type);
        }
    }
    
    // Filter by Category
    if ($category = $request->input('category')) {
        if ($category !== 'All Categories') {
            $skillPosts = $skillPosts->where('category', $category);
        }
    }

    // 3. Sorting
    $sort = $request->input('sort', 'newest');
    
    if ($sort === 'relevance') {
        $skillPosts = $skillPosts->shuffle();
    } else {
        // Newest (Default) - Descending ID
        $skillPosts = $skillPosts->sortByDesc('id');
    }

    // 4. Pagination
    $perPage = $request->input('per_page', 6);
    if (!in_array($perPage, [3, 6, 9, 12])) {
        $perPage = 6; 
    }

    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
    $currentItems = $skillPosts->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $paginatedPosts = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentItems, 
        $skillPosts->count(), 
        $perPage, 
        $currentPage, 
        ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );

    $paginatedPosts->appends($request->all());

    return view('skill_posts.index', [
        'skillPosts' => $paginatedPosts,
        'perPage' => $perPage,
        'sortBy' => $sort,
        'search' => $search,
        'selectedType' => $type ?? 'All Types',
        'selectedCategory' => $category ?? 'All Categories'
    ]);
})->name('skill-posts.index');
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

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/mission', function () {
    return view('mission');
})->name('mission');

Route::get('/ngos', function () {
    return view('ngos');
})->name('ngos');

Route::get('/volunteers', function () {
    return view('volunteers');
})->name('volunteers');

Route::get('/partners', function () {
    return view('partners');
})->name('partners');

Route::view('/legal', 'legal')->name('legal');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'role' => ['required', 'string', 'in:seeker,provider'],
    ]);

    // create user (password will be hashed automatically because of the cast in User model)
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        // Hash the password before storing it so Auth::attempt() works correctly
        'password' => Hash::make($data['password']),
        'roles' => [$data['role']], // Assign selected role
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
// Projects routes
Route::get('/projects', function (Request $request) {
    // 1. Generate Mock Data (24 items)
    $projects = collect();
    $categories = ['Education', 'Environment', 'Health', 'Technology', 'Community'];
    $locations = ['Remote', 'On-Site', 'Hybrid'];
    
    for ($i = 1; $i <= 24; $i++) {
        // Logic: Newer projects (higher ID) have more time. Older projects (lower ID) are expiring.
        // ID 1 -> ~2 days. ID 24 -> ~29 days.
        $daysLeft = max(1, min(30, intval(ceil($i * 1.2)))); 
        
        // Add subtle variation so it's not perfectly linear, but still deterministic
        if ($i % 3 == 0) $daysLeft -= 1;
        if ($i % 4 == 0) $daysLeft += 2;
        $daysLeft = max(1, min(30, $daysLeft)); // Clamp again

        // Deterministic seeding for fake data per iteration
        fake()->seed($i);
        
        $projects->push([
            'id' => $i,
            'title' => 'Project ' . $i . ': ' . fake()->catchPhrase(), 
            'ngo' => fake()->company(),
            'category' => $categories[$i % count($categories)], // Deterministic category
            'location' => $locations[$i % count($locations)],   // Deterministic location
            'image_color' => fake()->hexColor(),
            'sdg' => ($i % 17) + 1, // Deterministic SDG
            'deadline' => $daysLeft . ' days left',
            'days_left' => $daysLeft, 
            'hours' => rand(2, 10) . ' hrs/week',
            'description' => fake()->sentence(20),
            'tags' => ['Volunteer', 'Social Impact', 'SkillBridge']
        ]);
    }

    // 2. Handle Searching & Filtering
    // Filter by Search Term
    if ($search = $request->input('search')) {
        $projects = $projects->filter(function ($item) use ($search) {
            return stripos($item['title'], $search) !== false || 
                   stripos($item['ngo'], $search) !== false ||
                   stripos($item['description'], $search) !== false;
        });
    }

    // Filter by Category
    if ($category = $request->input('category')) {
        if ($category !== 'All Categories') {
            $projects = $projects->where('category', $category);
        }
    }

    // Filter by Location
    if ($location = $request->input('location')) {
        if ($location !== 'Location' && $location !== 'All Locations') {
            $projects = $projects->where('location', $location);
        }
    }

    // Filter by Urgent (if requested via link)
    if ($request->has('urgent')) {
        $projects = $projects->filter(function($item) {
             return intval($item['days_left']) < 10;
        });
    }

    // 3. Handle Sorting
    $sort = $request->input('sort', 'newest');
    
    if ($sort === 'deadline') {
        $projects = $projects->sortBy('days_left'); 
    } elseif ($sort === 'relevance') {
        $projects = $projects->shuffle();
    } else {
        // Newest (Default)
        $projects = $projects->sortByDesc('id');
    }

    // 4. Handle Pagination logic
    $perPage = $request->input('per_page', 3); 
    if (!in_array($perPage, [3, 6, 9])) {
        $perPage = 3; 
    }

    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage();
    $currentItems = $projects->slice(($currentPage - 1) * $perPage, $perPage)->all();
    $paginatedProjects = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentItems, 
        $projects->count(), 
        $perPage, 
        $currentPage, 
        ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );

    // Append all query params to pagination links so they persist
    $paginatedProjects->appends($request->all());

    return view('projects.index', [
        'projects' => $paginatedProjects, 
        'perPage' => $perPage, 
        'sortBy' => $sort,
        'search' => $search,
        'selectedCategory' => $category ?? 'All Categories',
        'selectedLocation' => $location ?? 'Location'
    ]);
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

// Organization verification routes
Route::middleware(['auth'])->group(function () {
    Route::get('/org-verification/create', [OrgVerificationController::class, 'create'])->name('org_verification.create');
    Route::post('/org-verification', [OrgVerificationController::class, 'store'])->name('org_verification.store');
    Route::get('/org-verification/{verification}', [OrgVerificationController::class, 'show'])->name('org_verification.show');
});

// Admin org verification routes
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/org-verifications', [OrgVerificationController::class, 'index'])->name('admin.org_verifications.index');
    Route::get('/org-verifications/{verification}/document', [OrgVerificationController::class, 'showDocument'])->name('admin.org_verifications.show_document');
    Route::post('/org-verifications/{verification}/approve', [OrgVerificationController::class, 'approve'])->name('admin.org_verifications.approve');
    Route::post('/org-verifications/{verification}/reject', [OrgVerificationController::class, 'reject'])->name('admin.org_verifications.reject');
});

// Temporary test route to verify server-side logout without the form (GET)
Route::get('/logout-test', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
});


