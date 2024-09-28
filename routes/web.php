<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DriveController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('auth.login');
});


// Admin Routes

Route::post('adminLogin', [AdminController::class, 'login'])->name('Admin.login');
Route::get('adminloginPage', [AdminController::class, 'loginPage'])->name('admin.loginPage');
Route::get('adminHomePage', [AdminController::class, 'index'])->name('admin.home')->middleware('auth:admin');


// Auth Routes
Auth::routes(
    [
    'verify' => true,
]
);

//Home Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('GoTo401', [HomeController::class, 'GoTo401'])->name('GoTo401');


//=============================================================
//                        User Section
//=============================================================
// Route::middleware('verified')->group(function () {


// });


Route::middleware(['auth'])->group(function () {

    Route::prefix('drives')->group(function () {
        Route::get('index', [DriveController::class, 'index'])->name('drive.index');
        Route::get('create', [DriveController::class, 'create'])->name('drive.create');
        Route::post('store', [DriveController::class, 'store'])->name('drive.store');

        Route::get('show/{id}', [DriveController::class, 'show'])->name('drive.show');
        Route::get('edit/{id}', [DriveController::class, 'edit'])->name('drive.edit');
        Route::post('update/{id}', [DriveController::class, 'update'])->name('drive.update');
        Route::get('destroy/{id}', [DriveController::class, 'destroy'])->name('drive.destroy');
        Route::get('download/{id}', [Drivecontroller::class, 'download'])->name('drive.download');

        //public routes

        Route::get('public', [DriveController::class, 'publicFiles'])->name('drive.public');

        //change private
        Route::get('change/{id}', [DriveController::class, 'changeStatus'])->name('drive.change');

        //show Public Files
        Route::get('showpublic/{id}', [DriveController::class, 'showPublicFiles'])->name('drive.showpublic');

        // show all drives for one user
        Route::get('allDrives', [DriveController::class, 'allDrives'])->name('drive.allDrives')->middleware('ruleOne');
    });
});
