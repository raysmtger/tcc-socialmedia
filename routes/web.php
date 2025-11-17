<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\OrganizerController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return Auth::check()
        ? redirect()->route('organizer')
        : redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/organizer', [OrganizerController::class, 'index'])->name('organizer');
  
    Route::get('/ideas/create', [IdeaController::class, 'create'])->name('ideas.create');
    Route::post('/ideas', [IdeaController::class, 'store'])->name('ideas.store');
    Route::get('/ideas/{idea}/edit', [IdeaController::class, 'edit'])->name('ideas.edit');
    Route::put('/ideas/{idea}', [IdeaController::class, 'update'])->name('ideas.update');
    Route::delete('/ideas/{idea}', [IdeaController::class, 'destroy'])->name('ideas.destroy');
    Route::delete('/ideas/{idea}/remove-image', [IdeaController::class, 'removeImage'])
    ->name('ideas.remove-image');
  
    Route::get('/assistente-ia', [PromptController::class, 'index'])->name('prompt.index');
    Route::get('/assistente-ia/historico', [PromptController::class, 'history'])->name('prompt.history');
    
    // Legendas
    Route::get('/assistente-ia/criar/legenda', [PromptController::class, 'createCaption'])->name('prompt.create.caption');
    Route::post('/assistente-ia/criar/legenda', [PromptController::class, 'storeCaption'])->name('prompt.store.caption');
    
    // Paleta de Cores
    Route::get('/assistente-ia/criar/paleta', [PromptController::class, 'createPalette'])->name('prompt.create.palette');
    Route::post('/assistente-ia/criar/paleta', [PromptController::class, 'storePalette'])->name('prompt.store.palette');
    
    // Ideias de Conteúdo
    Route::get('/assistente-ia/criar/ideias', [PromptController::class, 'createIdeas'])->name('prompt.create.ideas');
    Route::post('/assistente-ia/criar/ideias', [PromptController::class, 'storeIdeas'])->name('prompt.store.ideas');
    
    // Hashtags
    Route::get('/assistente-ia/criar/hashtags', [PromptController::class, 'createHashtags'])->name('prompt.create.hashtags');
    Route::post('/assistente-ia/criar/hashtags', [PromptController::class, 'storeHashtags'])->name('prompt.store.hashtags');
    
    // Call-to-Action
    Route::get('/assistente-ia/criar/cta', [PromptController::class, 'createCTA'])->name('prompt.create.cta');
    Route::post('/assistente-ia/criar/cta', [PromptController::class, 'storeCTA'])->name('prompt.store.cta');
    
    // Ações em Prompts (ANTES da rota genérica)
    Route::post('/assistente-ia/{id}/favoritar', [PromptController::class, 'toggleFavorite'])->name('prompt.favorite');
    Route::delete('/assistente-ia/{id}', [PromptController::class, 'destroy'])->name('prompt.destroy');
    
    // Visualizar Resultado (SEMPRE POR ÚLTIMO)
    Route::get('/assistente-ia/{id}', [PromptController::class, 'show'])->name('prompt.show');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//breeze
require __DIR__.'/auth.php';