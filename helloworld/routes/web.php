<?php

use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome')->name('welcome');
Route::view('/', 'landing.index')->name('index');
Route::view('/about', 'landing.about')->name('about');