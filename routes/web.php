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


Route::controller(NewsController::class)->prefix("admin")->group(function(){
    Route::get("news/create", "add")->middleware('auth');
});

// 3. 「http://XXXXXX.jp/XXX というアクセスが来たときに、 AAAControllerのbbbというAction に渡すRoutingの設定」を書いてみてください
Route::controller(AAAController::class)->group(function(){
    Route::get('XXX','bbb');
});


// 4. 【応用】 前章でAdmin/ProfileControllerを作成し、add Action, edit Actionを追加しました。
//     web.phpを編集して、admin/profile/create にアクセスしたら ProfileController の add Action に、admin/profile/edit にアクセスしたら 
//     ProfileController の edit Action に割り当てるように設定してください
// laravel07課題 ログインしていない状態で/admin/profile/create,/admin/profile/create にアクセスが来たらログイン画面にリダイレクトされるようにする


Route::controller(ProfileController::class)->prefix("admin")->group(function(){
    //  Controllerのアクションに割り当てる
    Route::get("profile/create", "add")->middleware('auth');
    Route::get("profile/edit", "edit")->middleware('auth');
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
