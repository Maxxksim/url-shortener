<?php

use App\Http\Controllers\UrlController;
use App\Models\Url;
use Illuminate\Support\Facades\Route;

Route::get('/', [UrlController::class, 'index']);
Route::post('/get-short-url', [UrlController::class, 'storeShortUrl'])->name('get-short-url');
Route::get('/{shorted_url}', [UrlController::class, 'redirectToOriginalUrl']);


