<?php

use App\Http\Controllers\AchivementController;
use App\Http\Controllers\BadgesController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use App\Models\Reviews;
use App\Models\User;
use App\Utils\Utils;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::where('status', 'published')->latest()->take(16)->get();
    return view('welcome', ['products' => $products]);
});
Route::get('/products', [ProductController::class , 'index'])->name('');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'customer'])->name('dashboard');

Route::get('/product/{id}', function ($id) {
    $product = Product::findOrFail($id);
    $reviews = Reviews::with(['user','product'])->where('product_id' , $id)->get();

    return view('product-page', ['product' => $product , 'reviews' => $reviews ]);
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
    Route::post('/add-review', [ReviewsController::class,  'store'])->name('add-review');
    
    Route::get('/profile/user/{id}' , function($id){
        $user = User::findOrFail($id);
        
        return view('profile', ['user'=> $user ]);
    })->name('show.profile');


    Route::post('/add' , [UserController::class,'store'])->name('add.image');
});

Route::middleware('seller')->group(function () {
            Route::get('/dashboard/seller', function () {
             $products = Auth::user()->products()->get();
             return view('sellerDashboard', ['products' => $products]);
              })->name('sellerDashboard');

});

Route::middleware(['verified'])->group(function () {

    Route::get('/add/product', [ProductController::class, 'create'])->name('add.product');
    Route::post('/add/product', [ProductController::class, 'store'])->name('store.product');

    Route::delete('/delete/product/{id}', [ProductController::class, 'destroy'])->name('delete.product');
});


Route::get('/products/{category}', function ($category) {

    $products = Product::where('category', $category)->where('status', 'published')->get();


    return view('product-by-category', ['products' => $products]);
})->name('product-by-category');

Route::get('/register', function () {
    return view('whatareyou');
});


Route::middleware('customer')->group(function () {
});
Route::get('/dashboard/d/', function () {
    if (Utils::isSeeler()) {

        return redirect(route('sellerDashboard'));
    }
    elseif(Auth::user()->userable_type === 'admin'){
        return redirect('/admin');
    }
    return redirect('/dashboard');
});



Route::middleware('admin')->group(function () {
    Route::get('/admin', function () {
        $products = Product::latest()->get();
        return view('admin', ['products' => $products]);
    });
    Route::post('/publish/{id}', [ProductController::class, 'statusToPublish'])->name('published');
    Route::delete('product/{id}/delete', [ProductController::class, 'softDelete'])->name('delete');
    Route::get('/archive', function () {
        $products = Product::withTrashed()->where('status', 'archived')->get();
        return view('archived', ['products' => $products]);
    });
    Route::post('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

    Route::get('admin/users', [UserController::class, 'index'])->name('show.users.admin');
    Route::post('user/{id}/verify', [UserController::class, 'verifyUser'])->name('verify.user');
    Route::post('user/{id}/ban', [UserController::class, 'ban'])->name('ban.user');
    Route::post('user/{id}/unban', [UserController::class, 'unban'])->name('unban.user');
    Route::get('/user/{id}/achievements/form', [AchivementController::class,'index'])->name('achivements');
    Route::get('/user/{id}/achievements', [AchivementController::class, 'showAchievements'])->name('user.achievements');
    Route::get('/user/{id}/edit-achievements', [AchivementController::class, 'editAchievements'])->name('user.editAchievements');
    Route::put('/user/{id}/achievements', [AchivementController::class, 'updateAchievements'])->name('user.updateAchievements');

});

Route::group(['middleware' => ['auth', 'check.status']], function () {
    // Protected routes...
});






require __DIR__ . '/auth.php';
