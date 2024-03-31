<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccommondationController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ReservationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', [AccommondationController::class, 'index'])->middleware('auth')->name('home');
Route::get('/reservation/{accommondation}', [ReservationController::class, 'create'])->middleware('auth')->name('reservation');
Route::post('/reservation/{accommondation}', [ReservationController::class, 'store'])->middleware('auth')->name('reservation.store');
Route::get('/rooms/{accommondation}', [RoomController::class, 'index'])->middleware('auth')->name('rooms');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
