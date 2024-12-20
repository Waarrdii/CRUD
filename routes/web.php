<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BrandProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Tabs', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//route product, brands, dll harus di buat satu per satu tidak dengan route source, kemudian dengan spatie cegah akses route selain untuk menampilkan data json.

Route::resource('products', ProductsController::class);
Route::delete('products', [ProductsController::class, 'multipleDestroy'])->name('products.multipleDestroy');
Route::get('products', [ProductsController::class, 'showAllProducts'])->name('products.showAllProducts');

Route::resource('brands', BrandController::class);
Route::get('brands', [BrandController::class, 'showAllBrands'])->name('brands.showAllBrands');

Route::get('brands/{brand}/products', [BrandProductController::class, 'index'])->name('brands.products.index');



require __DIR__.'/auth.php';
