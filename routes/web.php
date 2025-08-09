<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CIIController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\VesselManagementController;

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware'=> ["auth"]], function(){

   
    Route::resource('organization-management', OrganizationController::class);
    Route::resource('vessel-management', VesselManagementController::class);
    Route::resource('noon-report', App\Http\Controllers\NoonReportController::class);
    Route::resource('voyage', App\Http\Controllers\VoyageController::class);
    Route::get('cii-rating', [CIIController::class, 'index']);
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
});
