<?php

use App\Http\Controllers\EpisodesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SeasonsController;
use App\Http\Controllers\SeriesController;
use App\Http\Controllers\UsersController;
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

Route::controller(SeriesController::class)->group(function () {
    Route::get('/series', 'index')->name('series.index');
    Route::get('/series/criar', 'create')->name('series.create');
    Route::post('/series/salvar', 'store')->name('series.store');
    Route::get('/series/{serie}/editar', 'edit')->name('series.edit');
    Route::put('/series/{serie}/atualizar', 'update')->name('series.update');
    Route::delete('/series/destroy/{serie}', 'destroy')
        ->name('series.destroy')
        ->whereNumber('serie');
});

//Route::resource('/series', SeriesController::class)
//    ->except(['show']);

Route::middleware('authenticator')->group(function () {
    Route::get('/', function () {
        return redirect('/series');
    });

    Route::get('/series/{series}/seasons', [SeasonsController::class, 'index'])
        ->name('seasons.index');

    Route::get('/seasons/{season}/episodes', [EpisodesController::class, 'index'])
        ->name('episodes.index');
    Route::post('/seasons/{season}/episodes', [EpisodesController::class, 'watched'])
        ->name('episodes.watched');
});

Route::get('/login', [LoginController::class, 'index'])
    ->name('login');
Route::post('/login', [LoginController::class, 'signIn'])
    ->name('sign.in');
Route::get('/logout', [LoginController::class, 'signOut'])
    ->name('sign.out');

Route::get('/register', [UsersController::class, 'create'])
    ->name('users.create');
Route::post('/register', [UsersController::class, 'store'])
    ->name('users.store');

Route::get('/email', function () {
    return new \App\Mail\SeriesCreated(
        'Série de teste',
        1,
        5,
        10
    );
});
