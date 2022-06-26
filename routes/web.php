<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\MediaLibraryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;
use ILluminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[PageController::class,"index"])->name("page.index");
Route::get("/detail/{slug}",[PageController::class,"show"])->name("page.detail");

Route::middleware("auth")->group(function(){
    Route::resource('post',PostController::class);
    Route::resource("dashboard",DashboardController::class);
    Route::resource("media",MediaLibraryController::class);
    Route::resource("gallery",GalleryController::class);
    Route::resource("tag",TagController::class);
    Route::get("dashboard/post/list",[DashboardController::class,"lists"])->name("dashboard.list");
    Route::get("profile/edit",[ProfileController::class,"edit"])->name("profile.edit");
    Route::get("profile/edit-password",[ProfileController::class,"epassword"])->name("profile.epassword");
    Route::post("profile/update",[ProfileController::class,"update"])->name("profile.update");
    Route::post("profile/update-password",[ProfileController::class,"changePassword"])->name("profile.changepassword");

});



Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
