<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MainSliderController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\MediaCenterController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\TeacherApplicationController;
use App\Http\Controllers\Api\PricingPlanController;

Route::get('/settings', [SettingController::class, 'index']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);

Route::get('/courses', [CourseController::class, 'index']);
Route::get('/course-categories', [CourseController::class, 'categories']);
Route::get('/pricing-plans', [PricingPlanController::class, 'index']);
Route::get('/courses/{id}', [CourseController::class, 'show']);

Route::get('/media-center', [MediaCenterController::class, 'index']);

Route::get('/certificates', [CertificateController::class, 'index']);
Route::get('/certificates/{id}', [CertificateController::class, 'show']);

Route::get('/main-sliders', [MainSliderController::class, 'index']);
Route::get('/staff', [StaffController::class, 'index']);
Route::get('/staff/{id}', [StaffController::class, 'show']);

Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);

Route::post('/contacts', [ContactController::class, 'store']);
Route::post('/teacher-applications', [TeacherApplicationController::class, 'store']);
