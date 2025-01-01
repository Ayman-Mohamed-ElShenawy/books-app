<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('home');
});

Route::middleware(['guest'])->group(function(){

    Route::get('register',function(){
        return view('auth.register');
    });
    
    
    Route::get('login',function(){
        return view('auth.login');
    });
});

Route::middleware(['auth.basic'])->group(function(){
    Route::get('books',function(){
        return view('show-books');
    });

    Route::get('searchbooks/{book}',[BookController::class,'show'])->name('books.show');
    
    Route::get('newbook',function(){
        return view('addbook');
    });

});