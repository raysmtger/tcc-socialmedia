<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/prompt', [PromptController::class, 'index']);
Route::post('/prompt/send', [PromptController::class, 'send']);

Route::get('/inspiration', [InspirationController::class, 'index']);

Route::get('/organizer', [OrganizerController::class, 'index']);
Route::post('/organizer/save', [OrganizerController::class, 'store']);

