<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

//Регистрация
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('/forgot-password',[UserController::class, 'forgotPassword']);

//Личный Кабинет
    Route::middleware('auth:sanctum')->group( function () {
        Route::get('/profile',[UserController::class, 'index']);
        Route::put('/profile/profileUpdate',[UserController::class, 'profileUpdate']);
        Route::put('/profile/change-password',[UserController::class, 'updatePassword']);
        Route::post('logout', [AuthController::class, 'logout']);

    //Избранное
        Route::get('/favorite',[FavoriteController::class, 'show']);
        Route::post('favorite/add/{product}', [FavoriteController::class, 'add']);
        Route::delete('favorite/delete/{product}', [FavoriteController::class, 'delete']);

    //Оформление заказа
        Route::get('/order/history', [OrderController::class, 'history']);
        Route::post('/order/accept', [OrderController::class, 'accept']);
    });
//Корзина
Route::get('/cart', [CartController::class,'show']);
Route::post('/cart/update', [CartController::class,'update']);


//Продукт
Route::get('/product/{id}', [ProductController::class, 'show']);
Route::get('/analogs/{id}', [ProductController::class, 'analogs']);
Route::get('/new-product', [ProductController::class, 'new']);
Route::get('/bestsellers', [ProductController::class, 'best']);
Route::get('/sale', [ProductController::class, 'sale']);

//Категории
Route::get('/categories', [CategoryController::class, 'categories']);
Route::get('/category/{id}',[CategoryController::class, 'category']);
Route::get('/category',[CategoryController::class, 'allProducts']);
Route::get('/category/search',[CategoryController::class, 'search']);

//Поиск
Route::get('/products/{search}',[CategoryController::class, 'search']);

//Контент
Route::get('/main-content',[ContentController::class, 'mainContent']);
Route::get('/benefit', [ContentController::class, 'benefit']);
Route::get('/first-block',[ContentController::class, 'firstBlock']);
Route::get('/second-block',[ContentController::class, 'secondBlock']);
Route::get('/footer-contact',[ContentController::class, 'footerContact']);
Route::get('/footer-content',[ContentController::class, 'footerContent']);
Route::get('/addresses',[ContentController::class, 'addresses']);
Route::get('/slider', [ContentController::class, 'slider']);

