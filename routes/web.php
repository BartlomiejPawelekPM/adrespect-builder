<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagePreviewController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/preview/{slug}', [PagePreviewController::class, 'show'])->name('pages.preview');