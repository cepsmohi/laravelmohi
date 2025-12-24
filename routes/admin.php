<?php

use App\Livewire\Roles\Roleindex;
use App\Livewire\Users\Usercreate;
use App\Livewire\Users\Userindex;
use App\Livewire\Users\Usershow;
use Illuminate\Support\Facades\Route;

Route::as('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'permission:users'])
    ->group(function () {
        Route::get('users', Userindex::class)
            ->name('users');
        Route::get('users/create', Usercreate::class)
            ->middleware('permission:users.create')
            ->name('users.create');
        Route::get('users/show/{user}', Usershow::class)
            ->middleware('permission:users.show')
            ->name('users.show');
    });

Route::as('admin.')
    ->prefix('admin')
    ->middleware(['auth', 'permission:roles'])
    ->group(function () {
        Route::get('roles', Roleindex::class)
            ->name('roles');
    });
