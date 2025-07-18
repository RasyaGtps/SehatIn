<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $articles = App\Models\Article::latest()->take(3)->get();
    return view('welcome', compact('articles'));
})->name('welcome');

// About Page Route
Route::get('/about', function () {
    $articles = App\Models\Article::latest()->take(3)->get();
    return view('about', compact('articles'));
})->name('about');

// Authentication Routes
Route::get('/login', [AuthController::class, 'loginView'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerView'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Google Login Routes
Route::get('login/google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('login/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {
    // Profile Route
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/consultation', [App\Http\Controllers\ConsultationController::class, 'index'])->name('consultation.index');
    Route::post('/consultation/chat', [App\Http\Controllers\ConsultationController::class, 'chat'])->name('consultation.chat');
    Route::get('/education', [EducationController::class, 'index'])->name('education.index');
    Route::get('/education/article/{article}', [EducationController::class, 'show'])->name('education.article.show');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        
        // User Management
        Route::resource('users', UserController::class);
        
        // Article Management
        Route::resource('articles', AdminArticleController::class);
    });
});
