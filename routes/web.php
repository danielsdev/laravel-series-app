<?php

use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
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

Route::get('/', function () {
    return redirect('/series');
});

Route::controller(SeriesController::class)->group(function () {
    Route::get('series', 'index')->name('series.index');
    Route::get('series/criar', 'create')->name('series.create');
    Route::post('series/salvar', 'store')->name('series.store');
    Route::get('series/{serie}/editar', 'edit')->name('series.edit');
    Route::put('series/{serie}/atualizar', 'update')->name('series.update');
    Route::delete('series/destroy/{serie}', 'destroy')
        ->name('series.destroy')
        ->whereNumber('serie');
});

Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])->name('seasons.index');

