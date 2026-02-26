<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\LlibreController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\BibliotecaController;

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

//// DEFAULT

Route::get('/', [DefaultController::class, 'home'])->name('home');

Route::get('/esborra-cookies', [DefaultController::class, 'esborraCookies'])->name('esborra_cookies');

//// LLIBRES

Route::get('/llibre/list', [LlibreController::class, 'list'])->name('llibre_list');

Route::match(['get', 'post'], '/llibre/new', [LlibreController::class, 'new'])->name('llibre_new');

Route::match(['get', 'post'], '/llibre/edit/{id}', [LlibreController::class, 'edit'])->name('llibre_edit');

Route::get('/llibre/delete/{id}', [LlibreController::class, 'delete'])->name('llibre_delete');

Route::get('/llibreCercar', [LlibreController::class, 'cercar'])->name('llibre_cerca');

//// AUTORS

Route::get('/autor/list', [AutorController::class, 'list'])->name('autor_list');

Route::match(['get', 'post'], '/autor/new', [AutorController::class, 'new'])->name('autor_new');

Route::match(['get', 'post'], '/autor/edit/{id}', [AutorController::class, 'edit'])->name('autor_edit');

Route::get('/autor/delete/{id}', [AutorController::class, 'delete'])->name('autor_delete');


//// BIBLIOTECA

Route::get('/biblioteca/list', [BibliotecaController::class, 'list'])->name('biblioteca_list');

Route::match(['get', 'post'], '/biblioteca/new', [BibliotecaController::class, 'new'])->name('biblioteca_new');

Route::match(['get', 'post'], '/biblioteca/edit/{id}', [BibliotecaController::class, 'edit'])->name('biblioteca_edit');

Route::get('/biblioteca/delete/{id}', [BibliotecaController::class, 'delete'])->name('biblioteca_delete');

