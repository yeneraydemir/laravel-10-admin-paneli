<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MemberController;





Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/genel-gorunum', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');
Route::get('/admin', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/register', [AdminController::class, 'register'])->name('admin.register');
Route::get('/admin/forgetpswrd', [AdminController::class, 'forgetpswrd'])->name('admin.forgetpswrd');
Route::post('/admin/login', [MemberController::class, 'login'])->name('admin.login.post');
Route::get('/admin/logout', [MemberController::class, 'logout'])->name('admin.logout.post');
Route::post('/admin/register', [MemberController::class, 'register'])->name('admin.register.post');

Route::get('/admin/kullanicilar', [UserController::class, 'index'])->name('admin.users.index')->middleware('auth');
Route::get('/admin/kullanicilar/{user}', [UserController::class, 'show'])->name('admin.users.show')->middleware('auth');
Route::post('/admin/kullanicilar/{user}', [UserController::class, 'updatePermissions'])->name('admin.users.updatepermissions')->middleware('auth');