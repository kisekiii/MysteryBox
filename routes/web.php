<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BoxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PrizeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SettingController;
use App\Http\Middleware\EnsureTicketIsValid;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MysteryBoxController;
use App\Http\Controllers\MysteryBoxPrizeController;


// MysteryBox
Route::get('/', [MysteryBoxController::class, 'index'])->name('mysterybox.index');
Route::get('/allprizes', [MysteryBoxController::class, 'allPrizes'])->name('mysterybox.allprizes');
Route::post('/mysterybox/check', [MysteryBoxController::class, 'check'])->name(name: 'mysterybox.check');
Route::get('/mysterybox/open/{code}', [MysteryBoxController::class, 'open'])->name(name: 'mysterybox.open');
Route::post('/mysterybox/claim/{code}', [MysteryBoxController::class, 'claim'])->name(name: 'mysterybox.claim');
Route::get('/mysterybox/history/{code}', [MysteryBoxController::class, 'history'])->name('mysterybox.history');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Ticket (dashboard/ticket/...)
    Route::prefix('ticket')->name('ticket.')->group(function () {
        Route::get('/', [TicketController::class, 'index'])->name('index');
        Route::get('/create', [TicketController::class, 'create'])->name('create');
        Route::post('/', [TicketController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [TicketController::class, 'edit'])->name('edit');
        Route::put('/{id}', [TicketController::class, 'update'])->name('update');
        Route::delete('/{id}', [TicketController::class, 'destroy'])->name('destroy');
    });

    // Prize (dashboard/prize/...)
    Route::prefix('prize')->name('prize.')->group(function () {
        Route::get('/', [PrizeController::class, 'index'])->name('index');
        Route::get('/create', [PrizeController::class, 'create'])->name('create');
        Route::post('/', [PrizeController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PrizeController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PrizeController::class, 'update'])->name('update');
        Route::delete('/{id}', [PrizeController::class, 'destroy'])->name('destroy');
    });

    // Box (dashboard/box/...)
    Route::prefix('box')->name('box.')->group(function () {
        Route::get('/', [BoxController::class, 'index'])->name('index');
        Route::get('/create', [BoxController::class, 'create'])->name('create');
        Route::post('/', [BoxController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BoxController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BoxController::class, 'update'])->name('update');
        Route::delete('/{id}', [BoxController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('setting')->name('setting.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::get('/create', [SettingController::class, 'create'])->name('create');
        Route::post('/store', [SettingController::class, 'store'])->name('store');
        Route::get('/{setting}/edit', [SettingController::class, 'edit'])->name('edit');
        Route::put('/{setting}/update', [SettingController::class, 'update'])->name('update');
    });

    // User (dashboard/user/...)
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::put('/update', [UserController::class, 'updates'])->name('update');
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

