<?php

use App\Models\User;
use App\Models\Listing;
use illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

//all listings
Route::get('/', 
[ListingController::class, 'index']);

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update Listing
// destroy - Delete listing


// show create form
    Route::get('/listings/create',
     [ListingController::class, 'create'])->middleware('auth');

//store listing data
Route::post('/listings', 
 [ListingController::class, 'store'])->middleware('auth'); 

 //show edit form
Route::get('/listings/{listing}/edit', 
[ListingController::class, 'edit'])->middleware('auth');

//Update listing
Route::put('/listings/{listing}', 
[ListingController::class, 'update'])->middleware('auth');

//Delete listing
Route::delete('/listings/{listing}', 
[ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage',
[ListingController::class, 'manage'])->middleware('auth');


     //single listing
 Route::get('/listings/{listing}', 
 [ListingController::class, 'show']); 

 //show register form
Route::get('/register', 
[UserController::class, 'create'])->middleware('guest');

//create new user
Route::post('/users', 
[UserController::class, 'store']);

//logout user
Route::post('/logout', 
[UserController::class, 'logout'])->middleware('auth');

//show login form
Route::get('/login',
[UserController::class, 'login'])->name('login')->middleware('guest');

//login user
Route::post('/users/authenticate',
[UserController::class, 'authenticate']);

