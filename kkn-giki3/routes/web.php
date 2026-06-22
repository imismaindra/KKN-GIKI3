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
use App\Models\Banner;

Route::get('/', function () {
    $banners = Banner::where('is_active', true)->orderBy('order')->get();
    $articles = \App\Models\Article::where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();
    $galleries = \App\Models\Gallery::with('images')->latest()->get();
    $testimonials = \App\Models\Testimonial::approved()->latest()->get();
    $extracurriculars = \App\Models\Extracurricular::latest()->get();
    
    // Fetch and sort majors
    $majors = \App\Models\Major::orderBy('name')->get();
    
    // Fetch facilities
    $facilities = \App\Models\Facility::latest()->get();
    
    // Fetch and sort teachers based on predefined positions
    $predefined = \App\Models\Teacher::getPredefinedPositions();
    $teachers = \App\Models\Teacher::all()->sort(function ($a, $b) use ($predefined) {
        $posA = array_map('trim', explode(',', $a->position));
        $posB = array_map('trim', explode(',', $b->position));
        
        $priorityA = 999;
        foreach ($posA as $p) {
            $idx = array_search($p, $predefined);
            if ($idx !== false && $idx < $priorityA) {
                $priorityA = $idx;
            }
        }
        
        $priorityB = 999;
        foreach ($posB as $p) {
            $idx = array_search($p, $predefined);
            if ($idx !== false && $idx < $priorityB) {
                $priorityB = $idx;
            }
        }
        
        if ($priorityA !== $priorityB) {
            return $priorityA <=> $priorityB;
        }
        
        $posStringA = implode(', ', $posA);
        $posStringB = implode(', ', $posB);
        $posComp = strcasecmp($posStringA, $posStringB);
        if ($posComp !== 0) {
            return $posComp;
        }
        
        return strcasecmp($a->name, $b->name);
    })->values();

    return view('welcome', compact(
        'banners', 'articles', 'galleries', 'testimonials', 'extracurriculars', 
        'majors', 'facilities', 'teachers'
    ));
});

// Public Contact Form submission
Route::post('/kontak', [\App\Http\Controllers\PublicContactController::class, 'store'])->name('contact.store');

// Public Article Routes
Route::get('/berita-artikel', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/berita-artikel/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');

// Public Testimonial Routes
Route::get('/testimoni/tulis', [\App\Http\Controllers\PublicTestimonialController::class, 'create'])->name('testimonials.create.public');
Route::post('/testimoni/tulis', [\App\Http\Controllers\PublicTestimonialController::class, 'store'])->name('testimonials.store.public');

// Public Extracurricular Routes
Route::get('/ekstrakurikuler', [\App\Http\Controllers\ExtracurricularController::class, 'index'])->name('ekstrakurikuler.index');

// Public Teacher/Staff Routes
Route::get('/guru-staff', [\App\Http\Controllers\PublicTeacherController::class, 'index'])->name('teachers.index.public');

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
