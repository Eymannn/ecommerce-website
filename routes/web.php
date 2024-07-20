<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::latest()->take(16)->get();
    return view('welcome', ['products' => $products]);
});
Route::get('/products' , function(){
    $products = Product::latest()->get();
    return view('products', ['products' => $products]);
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
    Route::get('/card', [CardController::class, 'index'])->name('card');
    Route::post('/card/add', [CardController::class, 'addToCard'])->name('add.card');
    Route::post('/card/remove', [CardController::class, 'removeFromCard'])->name('remove.card');
    Route::post('/favorites/remove', [FavoriteController::class, 'removeFromFavorite'])->name('remove.favorite');

}); 

Route::middleware('seller')->group(function () {
    Route::get('/dashboard/seller', function () {
        

        $products = Auth::user()->products()->get();

        return view('sellerDashboard', ['products' => $products]);
    })->name('sellerDashboard');
    Route::get('/add/product', [ProductController::class, 'create'])->name('add.product');
    Route::post('/add/product', [ProductController::class, 'store'])->name('store.product');
    
    Route::delete('/delete/product/{id}' , [ProductController::class , 'destroy'])->name('delete.product');
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



Route::middleware('admin')->group(function(){
Route::get('/hereweare',[Controller::class , 'index']);
Route::post('/hereweare', [Controller::class , 'postkf'])->name('hikariorihara');
Route::get('/admin' , [AdminController::class , 'add'])->middleware('admin')->name('admin');
Route::put('/help' , [HelpController::class , 'index']);
});





require __DIR__ . '/auth.php';
