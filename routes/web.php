<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Website Publik (Frontend)
|--------------------------------------------------------------------------
*/
Route::get('/', [Frontend\HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [Frontend\HomeController::class, 'about'])->name('about');

Route::get('/destinasi', [Frontend\DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{destination}', [Frontend\DestinationController::class, 'show'])->name('destinations.show');

Route::get('/paket-tour', [Frontend\PackageController::class, 'index'])->name('packages.index');
Route::get('/paket-tour/{package}', [Frontend\PackageController::class, 'show'])->name('packages.show');

Route::get('/blog', [Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/kategori/{category}', [Frontend\BlogController::class, 'index'])->name('blog.category');
Route::get('/blog/{post}', [Frontend\BlogController::class, 'show'])->name('blog.show');

Route::get('/kontak', [Frontend\InquiryController::class, 'create'])->name('contact');
Route::post('/booking', [Frontend\InquiryController::class, 'store'])->middleware('throttle:10,1')->name('inquiries.store');

/*
|--------------------------------------------------------------------------
| Autentikasi
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| CMS Dashboard (/admin)
|--------------------------------------------------------------------------
| Semua user login (admin & editor) bisa mengelola konten.
| User management & pengaturan website khusus role admin.
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'active'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profil', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profil', [Admin\ProfileController::class, 'update'])->name('profile.update');

    // Content management
    Route::resource('destinations', Admin\DestinationController::class)->except('show');
    Route::resource('packages', Admin\PackageController::class)->except('show');
    Route::resource('posts', Admin\PostController::class)->except('show');
    Route::resource('categories', Admin\CategoryController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('testimonials', Admin\TestimonialController::class)->except('show');
    Route::resource('inquiries', Admin\InquiryController::class)->only(['index', 'show', 'update', 'destroy']);

    // Khusus administrator
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', Admin\UserController::class)->except('show');
        Route::get('/pengaturan', [Admin\SettingController::class, 'edit'])->name('settings.edit');
        Route::put('/pengaturan', [Admin\SettingController::class, 'update'])->name('settings.update');
    });
});
