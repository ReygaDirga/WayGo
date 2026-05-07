<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\SavedController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;

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
})->name('home');


Route::get('/profile', function () {
    return view('pages.profile');
});