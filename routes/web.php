<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\CocktailController::class, 'index'])->name('index');
Route::get('/mix/{cocktail}', [\App\Http\Controllers\CocktailController::class, 'mix'])->name('cocktail.mix');
Route::get('/pump-mapping', [\App\Http\Controllers\CocktailController::class, 'showPumpMapping'])->name('cocktail.pump-mapping');
Route::post('/map-pumps', [\App\Http\Controllers\CocktailController::class, 'mapPumps'])->name('cocktail.map-pumps');
