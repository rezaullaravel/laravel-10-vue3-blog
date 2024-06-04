<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',function(){
    return view('welcome');
});

//admin

Route::get('/login/admin',[AdminController::class,'adminLoginForm']);
Route::post('/admin/login',[AdminController::class,'adminPostLogin'])->name('admin.post.login');



Route::middleware(['admin'])->group(function () {
    Route::get('admin/{any}',[AdminController::class,'adminDashboard'])->where('any','.*');
    Route::get('/admin/dashboard',[AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/a-dmin/logout',[AdminController::class,'adminLogout'])->name('admin.logout');

    //categories
    Route::get('/a-dmin/categories',[CategoryController::class,'index']);
    Route::post('/a-dmin/store/category',[CategoryController::class,'store']);
    Route::get('/category/edit/{id}',[CategoryController::class,'edit']);
    Route::post('/update/category/{id}',[CategoryController::class,'update']);
    Route::get('/category/delete/{id}',[CategoryController::class,'delete']);


    //blog
    Route::get('/a-dmin/blogs',[BlogController::class,'index']);
    Route::get('/get/all/categories',[BlogController::class,'categories']);
    Route::post('/a-dmin/store/blog',[BlogController::class,'store']);
    Route::get('/get/BlogBy/Id/{id}',[BlogController::class,'getBlogById']);
    Route::post('/update/blog/{id}',[BlogController::class,'update']);
    Route::get('/blog/delete/{id}',[BlogController::class,'delete']);

});


