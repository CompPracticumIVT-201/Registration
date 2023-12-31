<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


Route::view('/main', "main")->name('main');
Route::view('/home', 'home')->middleware(['auth', 'verified'])->name('home');
Route::view('/login', 'login')->middleware('guest')->name('login');
Route::get('/email/verify', fn()=>view('email_verify'))->name('verify');
Route::get('/email/verify/already-success', fn()=>view('email_already_verify'))->name('verify');
Route::view('/email/verify/notice', 'email_verify_notice')->middleware('auth')->name('verification.notice');


