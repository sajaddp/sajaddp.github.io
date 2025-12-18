<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/courses', 'courses.index')->name('courses.index');
Route::view('/videos', 'videos.index')->name('videos.index');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
