<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Models\Marcas;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function mostrarMarca(){
        $marcas = Marcas::all();
        return Http::respuesta(http::retOK,$marcas);
    }
    public function mostrarMarcaporId(Request $request){
        $mascota = Marcas::find($request->id);
        if(!$mascota){
            return Http::respuesta(http::retNotFound, 'ese id no existe');
        }
        return Http::respuesta(http::retOK,$mascota);
    }
}
