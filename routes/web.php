<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\KategoriController;

////Home Page
//Route::get('/', [HomeController::class, 'index'])->name('home');
//
////Product Pages (with route prefix)
//Route::prefix('category')->group(function () {
//    Route::get('/food-beverage', [ProductController::class, 'foodBeverage'])->name('products.food-beverage');
//    Route::get('/beauty-health', [ProductController::class, 'beautyHealth'])->name('products.beauty-health');
//    Route::get('/home-care', [ProductController::class, 'homeCare'])->name('products.home-care');
//    Route::get('/baby-kid', [ProductController::class, 'babyKid'])->name('products.baby-kid');
//});
//
////User Profile Page
//Route::get('/user/{id}/name/{name}', [UserController::class, 'show'])->name('user.profile');
//
////Sales/POS Page
//Route::get('/sales', [SalesController::class, 'index'])->name('sales');

//Level Page
Route::get('/level', [LevelController::class, 'index']); 

//Kategori Page
Route::get('/kategori', [KategoriController::class, 'index']); 

//User Page
Route::get('/user', [UserController::class, 'index']); 


Route::get('/greeting');
