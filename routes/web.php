<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceCatalogController;

Route::get('/', [PriceCatalogController::class, 'home'])->name('home');

Route::get('/price-list', [PriceCatalogController::class, 'priceList'])->name('price-list');

Route::get('/special-offers/{offer}', [PriceCatalogController::class, 'specialOffer'])->name('special-offers.show');
