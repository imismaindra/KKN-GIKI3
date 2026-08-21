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
use App\Http\Controllers\Admin\ExtracurricularController;
use App\Http\Controllers\Admin\ProfileController;
use App\Models\Banner;

Route::get('/sitemap.xml', function () {
    $articles = \App\Models\Article::where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->get();

    return response()->view('sitemap', compact('articles'))->header('Content-Type', 'text/xml');
});

Route::get('/', function () {
    $banners = Banner::where('is_active', true)->orderBy('order')->get();
    $articles = \App\Models\Article::where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();
    $galleries = \App\Models\Gallery::with('images')->latest()->get();
    $testimonials = \App\Models\Testimonial::approved()->latest()->get();
    $extracurriculars = \App\Models\Extracurricular::latest()->get();
    $majors = \App\Models\Major::orderBy('name')->get();
    $facilities = \App\Models\Facility::latest()->get();
    $teachers = \App\Models\Teacher::sorted();

    return view('welcome', compact(
        'banners', 'articles', 'galleries', 'testimonials', 'extracurriculars', 
        'majors', 'facilities', 'teachers'
    ));
});

// Public Contact Form submission
Route::post('/kontak', [\App\Http\Controllers\PublicContactController::class, 'store'])->name('contact.store')->middleware('throttle:5,1');

// Public Article Routes
Route::get('/berita-artikel', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/berita-artikel/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Public Testimonial Routes
Route::get('/testimoni/tulis', [\App\Http\Controllers\PublicTestimonialController::class, 'create'])->name('testimonials.create.public');
Route::post('/testimoni/tulis', [\App\Http\Controllers\PublicTestimonialController::class, 'store'])->name('testimonials.store.public')->middleware('throttle:5,1');

// Public Extracurricular Routes
Route::get('/ekstrakurikuler', [\App\Http\Controllers\ExtracurricularController::class, 'index'])->name('extracurriculars.index.public');

// Public Teacher/Staff Routes
Route::get('/guru-staff', [\App\Http\Controllers\PublicTeacherController::class, 'index'])->name('teachers.index.public');

// Public Gallery Routes
Route::get('/galeri', [\App\Http\Controllers\PublicGalleryController::class, 'index'])->name('galleries.index.public');
Route::get('/galeri/{id}', [\App\Http\Controllers\PublicGalleryController::class, 'show'])->name('galleries.show.public');

// Admin Authentication Routes (Guest)
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');

});

// Protected Admin Routes (Auth + Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Ganti Password/Email)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/settings', [SettingController::class, 'edit'])->name('settings.edit');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Modul CRUD Admin
    Route::patch('banners/{banner}/toggle-active', [BannerController::class, 'toggleActive'])->name('banners.toggle-active');
    Route::resource('banners', BannerController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('teachers', TeacherController::class);
    Route::resource('extracurriculars', ExtracurricularController::class);
    Route::resource('articles', ArticleController::class);
    Route::resource('galleries', GalleryController::class);
    Route::patch('testimonials/{testimonial}/toggle-approval', [TestimonialController::class, 'toggleApproval'])->name('testimonials.toggle-approval');
    Route::resource('testimonials', TestimonialController::class);
    Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
});
