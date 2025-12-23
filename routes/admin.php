<?php

use App\Livewire\Users\Usercreate;
use App\Livewire\Users\Userindex;
use App\Livewire\Users\Usershow;
use Illuminate\Support\Facades\Route;

Route::as('admin.')
    ->prefix('admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('users', Userindex::class)
            ->middleware('permission:users')
            ->name('users');
        Route::get('users/create', Usercreate::class)
            ->middleware('permission:users.create')
            ->name('users.create');
        Route::get('users/show/{user}', Usershow::class)
            ->middleware('permission:users.show')
            ->name('users.show');
    });
