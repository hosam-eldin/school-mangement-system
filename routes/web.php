<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;


//--------------------admin auth route here------------------------
Route::group(['prefix' => 'admin', 'middleware' => ['guest.admin:admin']], function () {
    Route::get('/register', [AdminController::class, 'registerForm'])->name('admin.register');
    Route::post('/register', [AdminController::class, 'register'])->name('admin.store.register');
    Route::get('/login', [AdminController::class, 'loginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.store.login');
}); //--------------------------------------------------------------------
Route::post('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
//--------------------all admin route here---------------------------
Route::middleware(['auth.admin:admin', 'verified'])->group(function () {

    // Route::get('/admin/profile/{id}', [AdminProfileController::class, 'profile'])->name('admin.profile');
    // Route::get('/admin/profile/edit/{id}', [AdminProfileController::class, 'profileEdit'])->name('admin.profile.edit');
    // Route::post('/admin/profile/store/{id}', [AdminProfileController::class, 'profileStore'])->name('admin.profile.store');
    // Route::get('/admin/change-password/{id}', [AdminProfileController::class, 'changePassword'])->name('admin.change-password');
    // Route::post('/admin/update-password/{id}', [AdminProfileController::class, 'updatePassword'])->name('admin.update-password');

}); //--------------------------end admin all route-----------------------------------

Route::get('/', function () {
    return view('welcome');
});


//---------------------------------------user dashboard route here--------------------------------------
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
//-----------------------------------admin dashboard route here------------------------------
Route::middleware(['auth.admin:admin', 'verified'])->get('/admin/dashboard', function () {
    return view('/dashboard', ['guard' => 'admin']);
})->name('admin.dashboard');
//--------------------------------------end admin dashboard route-------------------------------------