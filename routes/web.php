<?php

use App\Livewire\Products;
use App\Livewire\Dashboard;
use App\Livewire\ProductForm;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', Dashboard::class)->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('products',Products::class)->name('products');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('products/create', ProductForm::class)->name('products.create');
    Route::get('products/{id}/edit', ProductForm::class)->name('products.edit');
});

require __DIR__.'/auth.php';
