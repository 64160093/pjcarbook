<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ReqDocumentController;

// เส้นทางสำหรับหน้าแรก
Route::get('/home', [HomeController::class, 'index'])->name('home');


// เส้นทางสำหรับการยืนยันตัวตน
Auth::routes();


// แก้ไขโปนไฟล์
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
Route::get('/', [CalendarController::class, 'show']);

Route::middleware(['auth'])->group(function () {
    Route::get('/reqdocument', function () {
        return view('ReqDocument');
    })->name('reqdocument.form');

    Route::get('/reqdocument/create', [ReqDocumentController::class, 'create'])->name('reqdocument.create');
    Route::post('/reqdocument/store', [ReqDocumentController::class, 'store'])->name('reqdocument.store');
});

Route::get('/documents', [ReqDocumentController::class, 'index'])->name('documents.index');
