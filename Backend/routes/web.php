<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TagCrudController;
use App\Http\Controllers\Admin\PostCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use App\Http\Controllers\Admin\CategoryCrudController;

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
Route::get('/category/{category}',[CategoryCrudController::class,'getPostByCategory']);
Route::get('/',[PostCrudController::class,'getPost']);
Route::get('/article/{id}', [PostCrudController::class, 'getPostById']);
Route::put('admin/user/profileUpdate',[UserCrudController::class,'update']);
Route::post('/admin/user/importToDatabase',[UserCrudController::class,'importToDb']);
Route::put('/post-view/{id}', [PostCrudController::class, 'increaseViewer']);
Route::get('tag/{id}',[TagCrudController::class, 'getTagById']);
Route::get('/admin/dashboard',[PostCrudController::class, 'total']);
