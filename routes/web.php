<?php

use App\Http\Controllers\InicioController;
use App\Livewire\AdminUserPosts;
use App\Models\Post;
use Illuminate\Support\Facades\Route;



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/posts', AdminUserPosts::class)->name('dashboard');
});

Route::get('/{campo?}/{valor?}', [InicioController::class, 'index'])->name('inicio');
