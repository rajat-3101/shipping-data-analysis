<?php

use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware'=> ["auth"]], function(){

    Route::resource('organisation-management', App\Http\Controllers\ShipManagementController::class);
    Route::resource('ship-management', App\Http\Controllers\ShipManagementController::class);
});
