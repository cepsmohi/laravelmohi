<?php

use Illuminate\Support\Facades\Route;

Route::get('', fn() => view('welcome'))->name('welcome');

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('dashboard', fn() => view('dashboard'))->name('dashboard');
});
