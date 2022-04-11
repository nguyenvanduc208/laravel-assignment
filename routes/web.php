<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParentCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

Route::get('/', function (){
    return view('layout.master');
})->name('home');


Route::middleware('auth')->prefix('/parentcate')->name('parent-cate.')->group(function () {
    Route::get('/', [ParentCategoryController::class, 'index'])->name('index');
    Route::get('/add', [ParentCategoryController::class, 'add'])->name('add');
    Route::get('/edit/{id}', [ParentCategoryController::class, 'edit'])->name('edit');
     Route::get('/delete/{id}',[ParentCategoryController::class, 'delete'])->name('delete');
     Route::post('/save', [ParentCategoryController::class, 'save'])->name('save');
    
});

Route::middleware('auth')->prefix('/categories')->name('categories.')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('index');
    Route::get('/add', [CategoryController::class, 'add'])->name('add');
    Route::delete('delete/{cate}',[CategoryController::class, 'delete'])->name('delete');
    Route::post('/save', [CategoryController::class, 'save'])->name('save');
    Route::get('/edit/{id}',[CategoryController::class, 'edit'])->name('edit');
    
});

Route::middleware('auth')->prefix('/products')->name('products.')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/add', [ProductController::class, 'add'])->name('add');
    Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('edit');
    Route::post('/store', [ProductController::class, 'save'])->name('save');
    Route::delete('delete/{pro}',[ProductController::class, 'delete'])->name('delete');
 
});
Route::middleware('auth')->prefix('/users')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/add', [UserController::class, 'add'])->name('add');
    Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');
    Route::post('/store', [UserController::class, 'save'])->name('save');
    Route::delete('delete/{id}',[UserController::class, 'delete'])->name('delete');

    
});



//Login 
Route::get('/login' , [LoginController::class , 'index'])->name('login');
Route::post('/login' , [LoginController::class, 'login']);
Route::get('/logout' , [LoginController::class , 'logout'])->name('logout');
Route::get('/test', function (){
    return Hash::make('2082001');
});