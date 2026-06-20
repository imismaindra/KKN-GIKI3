<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\MajorController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Models\Banner;

Route::get('/', function () {
    $banners = Banner::orderBy('order')->get();
    $articles = \App\Models\Article::where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();
    return view('welcome', compact('banners', 'articles'));
});

// Public Article Routes
Route::get('/berita-artikel', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/berita-artikel/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Admin Authentication Routes (Guest)
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Protected Admin Routes (Auth)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Modul CRUD Admin
    Route::resource('banners', BannerController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
});
