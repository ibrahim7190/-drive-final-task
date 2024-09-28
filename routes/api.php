<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\DriveAPICOntroller;
use App\Http\Controllers\DriveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::post('register', [AuthAPIController::class, 'register']); // Register User

Route::post('login', [AuthAPIController::class, 'login'])->name('login');  // Login User


Route::middleware("auth:sanctum")->group(function () {

    Route::get('drives', [DriveAPICOntroller::class, 'index']);

    Route::post('drives', [DriveAPICOntroller::class, 'store']);

    Route::post('drives/{id}', [DriveAPICOntroller::class, 'update']);

    Route::delete('drives/{id}', [DriveAPICOntroller::class, 'delete']);

    Route::get('logout', [AuthAPIController::class, 'logout']);   // Log out the user
});



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
