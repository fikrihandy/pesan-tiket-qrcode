<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AdminController;

//Home
Route::get('/', [GameController::class, 'index'])->name('home');

//Game Detail
Route::get('/games/{id}', [GameController::class, 'show'])->name('games.show');

//Admin
Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/games/create', [GameController::class, 'create'])->name('admin.games.create');
    Route::post('/admin/games', [GameController::class, 'store'])->name('admin.games.store');
    Route::get('/admin/scan', [AdminController::class, 'showScanForm'])->name('admin.scan');
    Route::post('/admin/update-order-status', [AdminController::class, 'updateOrderStatus'])->name('admin.update_order_status');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});

//Users
// Route untuk menampilkan form register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Route untuk proses register
Route::post('/register', [RegisterController::class, 'register']);

// Route untuk menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Route untuk proses login
Route::post('/login', [LoginController::class, 'login']);

// Route untuk melihat profil, terbuka untuk semua
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');

// Route untuk mengedit dan mengupdate profil, hanya untuk pengguna yang terautentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/my-tickets', [OrderController::class, 'myTickets'])->name('my.tickets');
    Route::get('/ticket/{id}', [OrderController::class, 'ticketDetail'])->name('ticket.detail');
});

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/not_logged_in', function () {
    return view('not_logged_in');
})->name('not_logged_in');

Route::post('/finalize_checkout', [OrderController::class, 'finalizeCheckout'])->name('finalize_checkout');



