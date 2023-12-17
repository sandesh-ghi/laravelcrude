<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

//Route::get('/', function () {
 //   return view('welcome');
//});
Route::GET('/',[ProductController::class,'index'])->name('products.index');
Route::GET('/products/create',[ProductController::class,'create'])->name('products.create');

Route::POST('/products/store',[ProductController::class,'store'])->name('products.store');

Route::GET('/products/{id}/edit',[ProductController::class,'edit']);
Route::PUT('/products/{id}/update',[ProductController::class,'update']);
Route::DELETE('/products/{id}/delete',[ProductController::class,'destroy']);

Route::GET('/products/{id}/show',[ProductController::class,'show']);






