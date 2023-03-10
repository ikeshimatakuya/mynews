<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CharacterController;
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


Route::controller(NewsController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::get('news/create', 'add')->name('news.add');
    Route::post('news/create', 'create')->name('news.create');
    Route::get('news', 'index')->name('news.index');
    Route::get('news/edit', 'edit')->name('news.edit');
    Route::post('news/edit', 'update')->name('news.update');
    Route::get('news/delete', 'delete')->name('news.delete');
});

use App\Http\Controllers\NewsController as PublicNewsController;
Route::get('/', [PublicNewsController::class, 'index'])->name('news.index');



Route::controller(ProfileController::class)->prefix("admin")->name('admin.')->middleware('auth')->group(function(){
    //  Controllerのアクションに割り当てる
    Route::get("profile/create", "add")->name('profile.add');
    Route::post("profile/create", "create")->name('profile.create');
    Route::get('profile', 'index')->name('profile.index');
    Route::get('profile/edit', 'edit')->name('profile.edit');
    Route::post('profile/edit', 'update')->name('profile.update');
    Route::get('profile/delete', 'delete')->name('profile.delete');
});

use App\Http\Controllers\ProfileController as PublicProfileController;
Route::get('/profile', [PublicProfileController::class, 'index'])->name('profile.index');



Route::controller(CharacterController::class)->prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    Route::get('character/create', 'add')->name('character.add');
    Route::post('character/create', 'create')->name('character.create');
    Route::get('character','index')->name('character.index');
    Route::get('character/edit', 'edit')->name('character.edit');
    Route::post('character/edit','update')->name('character.update');
    Route::get('character/delete', 'delete')->name('character.delete');
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
