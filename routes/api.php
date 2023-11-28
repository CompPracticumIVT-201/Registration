<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VerifyEmailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/authors', "AuthorController@index")->name('author.index');
Route::get('/categories', "CategoryController@index")->name('category.index');
Route::post('/register', "RegisterController@store")->middleware('guest')->name('register.store');
Route::get('/user/login/{login}', "UserController@checkLoginFree");
Route::get('/user/email/{email}', "UserController@checkEmailFree");

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['signed'])
    ->name('verification.verify');
