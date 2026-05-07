<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\GoogleController;

// Routes Google Login
Route::get('/auth/google',          [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

// Navbar Routes
Route::get('/itinerary', [ItineraryController::class, 'index'])->name('itinerary');
Route::get('/saved', [SavedController::class, 'index'])->name('trips');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/login', [LoginController::class, 'index'])->name('login');

// Start Planning Now Button Route
Route::get('/itinerary-start', [ItineraryController::class, 'index'])->name('start-itinerary');

Route::get('/', function () {
    return view('welcome');
});


Route::get('/profile', function () {
    return view('pages.profile');
});

Route::get('/blog_detail', [BlogController::class,'BlogDetail'])->name('blog-detail');
Route::get('/create_blog', [ProfileController::class,'CreateBlog'])->name('create-blog');