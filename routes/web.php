<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/', [HomeController::class, 'displayHome'])->name('home');


Route::get('/home',[HomeController::class, 'index']) ->name('display.home');
Route::get('single-product/{id}',[UserController::class,'displaySingleProduct'])->name('display.single.product');

// Route::get('/home',[HomeController::class, 'index'])->middleware('auth') ->name('home');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Product

});




Route::group(['prefix' =>'user', 'as' => 'user.','middleware' => ['auth','user']], function () {

    Route::get('/dashboard',[AdminController::class, 'index'])->name('dashboard');

});


Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard',[AdminController::class, 'index'])->name('dashboard');
    // User
    Route::get('/users/admin',[AdminController::class, 'displayAdmin'])->name('users.admin');
    Route::get('/users/user',[AdminController::class, 'displayUser'])->name('users.user');

    // Categories
    Route::get('/categories',[AdminController::class, 'displayCategories'])->name('categories');
    Route::get('/categories/create',[AdminController::class, 'createCategories'])->name('categories.create');
    Route::post('/categories/create',[AdminController::class, 'storeCategories'])->name('categories.store');
    Route::get('/categories/edit/{id}',[AdminController::class, 'editCategories'])->name('categories.edit');
    Route::post('/categories/edit/{id}',[AdminController::class, 'updateCategories'])->name('categories.update');
    Route::get('/categories/delete/{id}',[AdminController::class, 'deleteCategories'])->name('categories.delete');


    // Products
    Route::get('/products',[AdminController::class, 'displayProducts'])->name('products');
    Route::get('/products/create',[AdminController::class, 'createProducts'])->name('products.create');
    Route::post('/products/create',[AdminController::class, 'storeProducts'])->name('products.store');
    Route::get('/products/edit/{id}',[AdminController::class, 'editProducts'])->name('products.edit');
    Route::post('/products/edit/{id}',[AdminController::class, 'updateProducts'])->name('products.update');
    Route::get('/products/delete/{id}',[AdminController::class, 'deleteProducts'])->name('products.delete');


});

require __DIR__.'/auth.php';
