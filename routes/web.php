<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\IsAdmin;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ReqDocumentController;

// เส้นทางสำหรับหน้าแรก
Route::get('/home', [HomeController::class, 'index'])->name('home');


// เส้นทางสำหรับการยืนยันตัวตน
Auth::routes();

// Routes ที่ต้องการให้เฉพาะแอดมินเข้าถึง
Route::group(['middleware' => ['admin']], function () {
    
});

// แก้ไขโปนไฟล์
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
Route::get('/', [CalendarController::class, 'show']);

Route::get('/reqdocument', [ReqDocumentController::class, 'create'])->name('reqdocument.create');
Route::post('/reqdocument', [ReqDocumentController::class, 'store'])->name('reqdocument.store');
Route::get('/get-amphoes/{provinceId}', [ReqDocumentController::class, 'getAmphoes']);
Route::get('/get-districts/{amphoeId}', [ReqDocumentController::class, 'getDistricts']);

Route::get('/documents', [ReqDocumentController::class, 'index'])->name('documents.index');
Route::get('/documents/create', [ReqDocumentController::class, 'create'])->name('documents.create');
Route::post('/documents', [ReqDocumentController::class, 'store'])->name('documents.store');
