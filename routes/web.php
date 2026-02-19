<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CreditController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AdminPostController;

use App\Http\Controllers\Admin\AdminCreditController;

    use Illuminate\Support\Str;

// Credit Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/credits', [CreditController::class, 'index'])->name('credits.index');
    Route::get('/credits/purchase', [CreditController::class, 'showPurchaseForm'])->name('credits.purchase');
    Route::post('/credits/purchase', [CreditController::class, 'purchase'])->name('credits.purchase.submit');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/credits', AdminCreditController::class)->names([
        'index' => 'admin.credits.index',
        'create' => 'admin.credits.create',
        'store' => 'admin.credits.store',
        'show' => 'admin.credits.show',
        'edit' => 'admin.credits.edit',
        'update' => 'admin.credits.update',
        'destroy' => 'admin.credits.destroy',
    ]);

    // Approve / Reject actions
    Route::post('/credits/{credit}/approve', [AdminCreditController::class, 'approve'])
        ->name('admin.credits.approve');
    Route::post('/credits/{credit}/reject', [AdminCreditController::class, 'reject'])
        ->name('admin.credits.reject');
});


// Home Route
use App\Http\Controllers\HomeController;

use App\Models\Blog;

// use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/fetch-article', [HomeController::class, 'fetchBlogs']); // AJAX request for blogs



Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');

use App\Http\Controllers\LiveScoreController;

// Route::get('/live-scores', [LiveScoreController::class, 'index']);


// Correcting the syntax and fixing the spelling error
Route::view('/categories', 'categories')->name('categories');
Route::view('/contact', 'contact')->name('contact'); // Fixed spelling
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::view('/about', 'about')->name('about');


Route::view('/about', 'about')->name('about');
Route::view('/privacy-policy', 'privacy')->name('privacy');
Route::view('/other', 'other')->name('other');


Route::middleware(['auth'])->group(function () {
        Route::get('/profile/edit', [AuthController::class, 'editProfile'])->name('profile.edit');
        Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::post('/profile', [AuthController::class, 'updatePassword'])->name('profile.update.password');
        Route::get('/profile/user', [AuthController::class, 'profile'])->name('profile');

    
    Route::post('/profile/update-photo', [AuthController::class, 'updateProfilePhoto'])->name('profile.update.photo');

});
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserController;

Route::get('/profile/{username}', [UserProfileController::class, 'show'])->name('profile.show');
Route::get('/user/{username}', [UserController::class, 'publicProfile'])->name('user.profile');


Route::get('/ads.txt', function () {
    return response(
        "google.com, pub-1777386434970264, DIRECT, f08c47fec0942fa0",
        200,
        ['Content-Type' => 'text/plain']
    );
});




// Guest Routes (Login & Register)
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Only Authenticated Users)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/callback/google', [AuthController::class, 'handleGoogleCallback']);



// Bloging Posts 





Route::middleware(['auth'])->group(function () {
    Route::get('/article-list', [BlogController::class, 'index'])->name('blogs.index'); // List Blogs
    Route::get('/article/create', [BlogController::class, 'create'])->name('blogs.create'); // Create Blog Form
    Route::post('/article', [BlogController::class, 'store'])->name('blogs.store'); // Store Blog

    Route::get('/article/{blog}', [BlogController::class, 'show'])->name('blogs.show'); // Show Single Blog

    Route::get('/article/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit'); // Edit Blog Form
    Route::put('/article/{blog}', [BlogController::class, 'update'])->name('blogs.update'); // Update Blog

    Route::delete('/article/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy'); // Delete Blog
});

Route::get('/articles', [BlogController::class, 'allBlogs'])->name('blogs.all');

// use App\Http\Controllers\BlogController;

Route::get('/article/{slug}', [BlogController::class, 'show'])->name('blogs.show');




Route::post('/blogs/{id}/like', [LikeController::class, 'toggleLike'])->middleware('auth');
Route::post('/blogs/{id}/comment', [CommentController::class, 'store'])->middleware('auth');

use App\Http\Controllers\BookmarkController;

Route::middleware(['auth'])->group(function () {
    Route::post('/blogs/{blog}/bookmark', [BookmarkController::class, 'toggleBookmark'])->name('bookmark.toggle');
    Route::get('/user/bookmarks', [BookmarkController::class, 'getUserBookmarks'])->name('user.bookmarks');
});
// follow controller 

use App\Http\Controllers\FollowController;

Route::post('/follow-toggle', [FollowController::class, 'toggleFollow'])->name('follow.toggle');


// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // ✅ Import Auth

Route::post('/notifications/read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return response()->json(['status' => 'success']);
})->name('notifications.read')->middleware('auth');










                         // Admin Panel Routes

         

// use App\Http\Controllers\AdminController;

// use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});



         Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
             Route::resource('/artical', AdminBlogController::class)->names([
                 'index' => 'admin.blogs.index',
                 'create' => 'admin.blogs.create',
                 'store' => 'admin.blogs.store',
                 'show' => 'admin.blogs.show',
                 'edit' => 'admin.blogs.edit',
                 'update' => 'admin.blogs.update',
                 'destroy' => 'admin.blogs.destroy',
             ]);
         });
         

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/article', AdminPostController::class)->names('admin.blogs');
});


use App\Http\Controllers\Admin\AdminCategoryController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/categories', AdminCategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
});


use App\Http\Controllers\Admin\AdminUserController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/users', AdminUserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
});

use App\Http\Controllers\Admin\AdminContactController;

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::resource('/contacts', AdminContactController::class)->names([
        'index' => 'admin.contacts.index',
        'show' => 'admin.contacts.show',
        'destroy' => 'admin.contacts.destroy',
    ]);
    
    Route::post('/contacts/{contact}/reply', [AdminContactController::class, 'sendReply'])
         ->name('admin.contacts.reply');
});



// ✅ All specific routes go here first...

// 🟡 Redirect old /articale/{slug} URLs to new format
Route::get('/articale/{slug}', function ($slug) {
    // Attempt to find blog that ends with the old slug (assumes full slug format: category/slug)
    $blog = \App\Models\Blog::where('slug', 'like', "%/$slug")->first();

    if ($blog) {
        return redirect('/' . $blog->slug, 301); // Permanent redirect
    }

    abort(404); // If not found, return 404
});

// ✅ Place this LAST to avoid route collision with everything else
Route::get('/{slug}', [BlogController::class, 'show2'])
    ->where('slug', '.*')
    ->name('blogs.details');

