<?php

use App\Http\Controllers\categoriasController;
use App\Http\Controllers\ProductosController;
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

Route::get('/Productos', function () {
    return view('objetos.index');
});

//grupo productos-----------------------------------------------
Route::get('api/productos/list', [ProductosController::class, 'mostrarProducto']);
Route::get('api/productos/list/{id}', [ProductosController::class, 'mostrarProductoPorId']);
Route::post('api/productos/save', [ProductosController::class, 'guardarProducto']);
Route::post('api/productos/editar/{id}', [ProductosController::class, 'editar']);
Route::get('api/productos/update/{id}', [ProductosController::class, 'editarProducto']);
Route::delete('api/productos/delete/{id}', [ProductosController::class, 'eliminarProducto']);




//grupo categorias----------------------------------------------
Route::get('api/categorias/list', [categoriasController::class, 'mostrarCategorias']);
Route::get('api/categorias/custumizado', [categoriasController::class, 'mostrarCategoriasCustumizado']);
Route::post('api/categorias/save', [categoriasController::class, 'guardarCategoria']);
