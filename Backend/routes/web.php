<?php

use App\Http\Controllers\Admin\CategoryCrudController;
use App\Http\Controllers\Admin\PostCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use Illuminate\Support\Facades\Route;

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

Route::get('/posts', function () {
    return view('pages.info');
});
Route::get('/',[PostCrudController::class,'getPost']);
Route::get('/post/{id}', [PostCrudController::class, 'getPostById']);
Route::get('/category',[CategoryCrudController::class,'getCategory']);
Route::put('admin/user/profileUpdate',[UserCrudController::class,'update']);
Route::post('/admin/user/importToDatabase',[UserCrudController::class,'importToDb']);