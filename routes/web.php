<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserControllers;

// Route::get('/', function () {
//     return view('welcome');
// });


// Show the registration form
Route::get('/', [UserControllers::class, 'index']);
Route::post('/', [UserControllers::class, 'store'])->name('users.store');
Route::get('/login', [UserControllers::class, 'loginForm'])->name('users.loginForm');
Route::post('/login', [UserControllers::class,'login'])->name('login');

Route::get('/home', [UserControllers::class, 'dataTabel'])->name('home.dataTabel');
Route::get('/register', [UserControllers::class, 'index'])->name('users.index');

Route::delete('/users/{id}', [UserControllers::class, 'delete'])->name('users.delete');
Route::get('/update/{id}/{full_name}/{email}/{phone}/{address}', [UserControllers::class, 'showUpdateForm'])->name('update');
Route::put('/users/{id}', [UserControllers::class, 'update'])->name('users.update');

Route::get('/logout', [UserControllers::class, 'logout'])->name('logout');
