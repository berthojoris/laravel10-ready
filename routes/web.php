<?php

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
    return view('example');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
	Route::prefix('roles')->group(function () {
		Route::get('/', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
		Route::get('/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
		Route::post('/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
		Route::post('/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
		Route::get('/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
		Route::get('/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
		Route::post('/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
	});
});