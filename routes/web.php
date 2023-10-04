<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\RentalController;
use App\Models\Category;
use App\Models\User;
use App\Models\Vehicle;
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

Route::group(['prefix' => '/login'], function () {
    Route::get('/', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/', [AuthController::class, 'attemptLogin'])->name('login.attempt');
});
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['prefix' => '/register'], function () {
    Route::get('/', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/', [AuthController::class, 'storeAccount'])->name('register.store');
});

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store')->middleware('auth');
Route::post('/vehicles', [VehiclesController::class, 'store'])->name('vehicles.store')->middleware('auth');

Route::group(['prefix' => '/registerClient'], function () {
    Route::get('/', [RentalController::class, 'showRegisterClient'])->name('register.client')->middleware('auth');
    Route::post('/', [RentalController::class, 'rentalAccount'])->name('register.rental')->middleware('auth');
});

Route::delete('/clientes/{id}', [RentalController::class, 'delete'])->name('clientes.delete')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/Dashboard', [HomeController::class, 'showDashboard'])->name('dashboard'); // esta es la ruta para guiar a la vista dashboard
