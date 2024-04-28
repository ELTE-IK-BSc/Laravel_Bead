<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\ContestController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ProfileController;
use App\Models\Contest;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
})->name('main');

Route::middleware('auth')->group(function () {
    Route::resource('characters', CharacterController::class);
    Route::resource('contests', ContestController::class);
    Route::get('/contest/{id}/{attacktype}', [ContestController::class, 'attack'])->name('contest.attack');
    Route::middleware('\App\Http\Middleware\IsAdmin')->group(function () {
        Route::resource('places', PlaceController::class);
    });
});

Route::get('/characters/', [CharacterController::class, 'index'])->middleware(['auth', 'verified'])->name('characters');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
