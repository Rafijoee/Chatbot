<?php

use App\Http\Controllers\DashboardController; // ✅ benar
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Chat\SingleChat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LogoutController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::post('/logout', LogoutController::class)->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chat/{id}', SingleChat::class)->name('chat.single');
});
