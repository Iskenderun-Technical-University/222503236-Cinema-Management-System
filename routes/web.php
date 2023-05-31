<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {  return view('admin.dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/admin/dashboard', function () {  return view('admin.dashboard'); })->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {

    // burasi artik isfre ile girilmis alan

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::resource('users', UserController::class)->except('edit');
    Route::resource('cinemas', CinemaController::class)->except('show');
    Route::resource('movies', MovieController::class)->except('show');


    Route::get('/seats/{id}', [\App\Http\Controllers\SeatController::class, 'index'])->name('seats.index');
    Route::get('/seats/create/{id}', [\App\Http\Controllers\SeatController::class, 'create'])->name('seats.create');
    Route::post('/seats/store', [\App\Http\Controllers\SeatController::class, 'store'])->name('seats.store');
    Route::post('/seats/edit/{id}', [\App\Http\Controllers\SeatController::class, 'edit'])->name('seats.edit');
    Route::any('/seats/add/{id}', [\App\Http\Controllers\SeatController::class, 'add'])->name('seats.add');


});

require __DIR__ . '/auth.php';
