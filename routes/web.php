<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StickerUserController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StickerUserController::class, 'myStickers'])
    ->middleware(['auth', 'verified'])
    ->name('myStickers');

Route::post('/update-sticker', [StickerUserController::class, 'updateSticker'])
    ->middleware(['auth', 'verified'])
    ->name('update-sticker');

Route::get('/exchanges', [StickerUserController::class, 'findStickers'])
->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

Route::post('logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

require __DIR__.'/auth.php';
