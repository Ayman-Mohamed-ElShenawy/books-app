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
    Route::get('searchbooks/{book}',[BookController::class,'show'])->name('books.show');
    Route::get('noresults',function(){
        return view('noresults');
    });
});

Route::middleware(['auth.basic'])->group(function(){
    Route::get('books',function(){
        return view('show-books');
    });
    Route::get('newbook',function(){
        return view('addbook');
    });
   
});

Route::fallback(function () {
    abort('404'); // Returns the 404 view
});