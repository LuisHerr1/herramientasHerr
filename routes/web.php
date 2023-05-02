<?php

use App\Http\Controllers\ObjetoController;
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
    return view('welcome');
});
Route::get('api/objetos/list', [ObjetoController::class, 'mostrarObjetos']);
Route::get('api/objetos/list/{id_objeto}', [ObjetoController::class, 'mostrarObjetoPorId']);
Route::post('api/objetos/save', [ObjetoController::class, 'guardarObjeto']);
Route::post('api/objetos/update/{id_obj}', [ObjetoController::class, 'editarObjeto']);
Route::delete('api/objetos/delete/{id_obj}', [ObjetoController::class, 'eliminarObjeto']);
