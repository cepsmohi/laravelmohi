<?php

use App\Livewire\Users\Userindex;
use Illuminate\Support\Facades\Route;

Route::as('admin.')
    ->prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('users', Userindex::class)
            ->middleware('permission:users')
            ->name('users');
    });
