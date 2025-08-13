<?php

use App\Livewire\Users;
use App\Livewire\Category;
use App\Livewire\Products;
use App\Livewire\Dashboard;
use App\Livewire\ProductForm;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('products',Products::class)->name('products');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    
    Route::get('category', Category::class)->name('category');
    Route::get('users', Users::class)->name('users');
});
Route::get('products/create', ProductForm::class)->name('products.create')->middleware('admin');
Route::get('products/{id}/edit', ProductForm::class)->name('products.edit')->middleware('admin');

require __DIR__.'/auth.php';
