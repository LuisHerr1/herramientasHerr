<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Models\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class categoriasController extends Controller
{ //se define un metodo para mostrar el los campos de categorias
    public function mostrarCategorias(){
        $categorias = Categorias::all();
        if (count($categorias) == 0) {
            return Http::respuesta(http::retNotFound, "no hay categorias en la base de datos");
        }
        return http::respuesta(http::retOK, $categorias);
    }

    public function mostrarCategoriasCustumizado(){
        $categorias = DB::table('categorias AS c')
                     ->select('c.id', 'c.nombre')->get();
        if(is_null($categorias)){
            return http::respuesta(http::retNotFound, $categorias);
        }
        return http::respuesta(http::retOK, $categorias);
    }
    public function guardarCategoria(Request $request){
        $validator = Validator::make($request->all(), [
            'nombre'=>'required|string'
        ]);
        if($validator->fails()){
            return http::respuesta(http::retError,$validator->errors());
        }
        $categorias = new Categorias();//Categorias aca se refiere al modelo 'deberia de ir en singular y primero en mayuscula'
        $categorias->nombre = $request->nombre;
        $categorias->save();
        return http::respuesta(http::retOK,'ya puedo');
    }

}
