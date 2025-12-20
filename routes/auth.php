<?php

use App\Http\Controllers\Auth\OtpAuthController;
use Illuminate\Support\Facades\Route;

Route::controller(OtpAuthController::class)
    ->group(function () {
        Route::get('/register', 'register')->name('register');
        Route::get('/login', 'showRequestForm')->name('login');
        Route::post('/login', 'requestOtp')->name('otp.request');
        Route::get('/verify', 'showVerifyForm')->name('otp.verify.form');
        Route::post('/verify', 'verifyOtp')->name('otp.verify');
        Route::post('/logout', 'logout')->name('logout');
    });


