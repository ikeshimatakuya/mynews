<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

// ->name って何してんの？
Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
    Route::get('news', 'index')->name('news.index');
    Route::get('news/edit', 'edit')->name('news.edit');
    Route::post('news/edit', 'update')->name('news.update');
    Route::get('news/delete', 'delete')->name('news.delete');
});


Route::controller(ProfileController::class)->prefix("admin")->name('admin.')->middleware('auth')->group(function(){
    //  Controllerのアクションに割り当てる
    Route::get("profile/create", "add")->name('profile.add');
    Route::post("profile/create", "create")->name('profile.create');
    Route::get('profile', 'index')->name('profile.index');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile/delete', 'delete')->name('profile.delete');
});


/*
Route::controller(ProfileController::class)->prefix("admin")->group(function(){
    //  Controllerのアクションに割り当てる
    Route::get("profile/create", "add")->middleware('auth');
});

Route::controller(ProfileController::class)->prefix("admin")->group(function(){
    //  Controllerのアクションに割り当てる
    Route::get("profile/edit", "edit")->middleware('auth');
});
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
