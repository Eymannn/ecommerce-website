<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    return view('welcome', ['products' => $products]);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'customer'])->name('dashboard');

Route::get('/product/{id}', function ($id) {
    $product = Product::findOrFail($id);


    return view('product-page', ['product' => $product]);
})->name('product-page');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
    Route::post('/favorites/add', [FavoriteController::class, 'addToFavorite'])->name('add.favorite');
});

Route::middleware('seller')->group(function () {
    Route::get('/dashboard/seller', function () {

       
        $products = Auth::user()->products()->get();

        return view('sellerDashboard', ['products' => $products]);
    })->name('sellerDashboard');
    Route::get('/add/product', [ProductController::class, 'create'])->name('add.product');
    Route::post('/add/product', [ProductController::class, 'store'])->name('store.product');
});


Route::get('/products/{category}', function ($category) {

    $products = Product::where('category', $category)->get();


    return view('product-by-category', ['products' => $products]);
})->name('product-by-category');

Route::get('/register', function () {
    return view('whatareyou');
});


Route::middleware('customer')->group(function () {
});
Route::get('/dashboard/d/', function () {
    if (Utils::isSeeler()) {

        return  redirect(route('sellerDashboard'));
    }
    return redirect('/dashboard');
});


require __DIR__ . '/auth.php';
