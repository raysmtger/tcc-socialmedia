<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check()
        ? redirect('/organizer')
        : redirect('/login');
});

//rotas protegidas (só para autenticados)
Route::middleware(['auth'])->group(function () {

    Route::get('/organizer', [OrganizerController::class, 'index'])->name('organizer');

    Route::resource('ideas', IdeaController::class)->except(['show', 'create']);

    Route::get('/prompt', [PromptController::class, 'index'])->name('prompt.index');
    Route::post('/prompt/send', [PromptController::class, 'send'])->name('prompt.send');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/ideas', [IdeaController::class, 'index'])->name('ideas.index');
    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create'); 
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
    Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');
});
//autenticação do Breeze (login, register, logout, etc.)
require __DIR__.'/auth.php';
