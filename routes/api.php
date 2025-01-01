<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

    Route::middleware(['auth:sanctum'])->group(function(){
        Route::resource('books',BookController::class)->except('update','show');
        Route::post('books/{book}',[BookController::class,'update']);
        Route::get('search',[BookController::class,'searchResults'])->name('book.search');
    });
