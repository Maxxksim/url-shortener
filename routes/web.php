<?php

use App\Http\Controllers\UrlController;
use App\Models\Url;
use Illuminate\Support\Facades\Route;

Route::get('/', [UrlController::class, 'index']);
Route::get('/{shorted_url}', [UrlController::class, 'redirectToOriginalUrl']);
Route::post('/url/create', [UrlController::class, 'createShortUrl']);
Route::delete('/url/{url}', [UrlController::class, 'deleteShortUrl']);

