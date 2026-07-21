<?php
// This file is where you may define all of the routes that are handled
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;

Route::get('/test-id', function () {
    App::setLocale('id');
    return view('welcome');
});

Route::post('/change-language', [ProfileController::class,'changeLanguage'])
    ->name('change.language');

//Next Button in preferences page
Route::get('/done', fn() => view('authentication.done'))
    ->name('done')
    ->middleware('auth');

//Next button in page create profile
Route::get('/preferences', [ProfileController::class, 'preferences'])
    ->name('preferences')
    ->middleware('auth');

Route::post('/preferences/store', [ProfileController::class, 'preferencesStore'])
    ->name('preferences.store')
    ->middleware('auth');
    
// Buat Profile
Route::get('/profile/create',  fn() => view('authentication.CreateProfile'))
    ->name('profile.create')
    ->middleware('auth');

Route::post('/profile/store', [ProfileController::class, 'store'])
    ->name('profile.store')
    ->middleware('auth');
    
// Routes Google Login
Route::get('/auth/google',          [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Navbar Routes
Route::get('/saved', [SavedController::class, 'index'])->name('trips');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);

// itinerary
Route::prefix('/itinerary')->group(function () {
    Route::get('/', [ItineraryController::class, 'index'])->name('itinerary');
    Route::post('/itinerary-detail', [ItineraryController::class, 'itineraryDetail'])->name('itinerary-detail');
});

// Profile
Route::prefix('/profile')->group(function () {

    Route::get('', [ProfileController::class, 'index'])->name('profile');
    Route::get('/edit', [ProfileController::class, 'editProfilePage'])->name('editprofile');
    Route::post('/edit', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::get('/change-password', [ProfileController::class, 'changePasswordPage'])->name('changepassword');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('profile.changepassword');
});

// Blog
Route::prefix('/blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog-detail/{id}', [BlogController::class, 'BlogDetail'])->name('blog-detail');
    Route::get('/create-blog', [BlogController::class, 'createBlog'])->name('create-blog');
    Route::post('/create-blog', [BlogController::class, 'storeBlog'])->name('store-blog');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/saved/{uuid}', [SavedController::class, 'detail'])->middleware('auth');
Route::get('/saved/{uuid}/pdf', [SavedController::class, 'exportPdf'])->name('pdf_export');