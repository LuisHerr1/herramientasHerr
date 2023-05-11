<?php

use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//para marcas
Route::get('/marcas',[MarcaController::class,'mostrarMarca']);
Route::get('/marcas/{id}',[MarcaController::class,'mostrarMarcaPorId']);

//para proveedores
Route::get('/proveedeores',[ProveedorController::class,'mostrarProveedor']);
Route::get('/proveedeores/{id}',[ProveedorController::class,'mostrarProveedorPorId']);
Route::delete('/proveedeores/eliminar/{id}',[ProveedorController::class,'eliminarProveedor']);
Route::post('/proveedeores/save',[ProveedorController::class,'guardarProveedor']);

