<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use App\Models\Objeto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObjetoController extends Controller
{
    public function mostrarObjetos(){
        $objetos = Objeto::all();
        if (count($objetos) == 0) {
            return Http::respuesta(http::retNotFound, "no se encontro el id");
        }
        return http::respuesta(http::retOK, $objetos);
    }

    public function mostrarObjetoPorId(Request $request){
        $idObjeto = Objeto::find($request->id_objeto);
        if (!$idObjeto) {
            return response()->json(
                ['mensaje' => 'no existe ese objeto']
            );
        }
        return response()->json(
            $idObjeto
        );
    }

    public function guardarObjeto(Request $request){
        $validator = Validator::make($request->all(), [
            'forma' => 'required|string',
            'material' => 'required|string',
            'typo' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['mensaje' => $validator->errors()]
            );
        }

        $objetos = new Objeto();
        $objetos->forma = $request->forma;
        $objetos->material = $request->material;
        $objetos->typo = $request->typo;
        $objetos->save();
        return response()->json(
            ['mensaje' => 'bjeto guardado con exito']
        );
    }

    public function editarObjeto(Request $request){
        $idObjeto = Objeto::find($request->id_obj);
        if (!$idObjeto) {
            return response()->json(
                ['mensaje' => 'no existe ese objeto']
            );
        }

        $validator = Validator::make($request->all(), [
            'forma' => 'required|string',
            'material' => 'required|string',
            'typo' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['mensaje' => $validator->errors()]
            );
        }

        $idObjeto->forma = $request->forma;
        $idObjeto->material = $request->material;
        $idObjeto->typo = $request->typo;
        $idObjeto->save();
        return response()->json(
            ['mensaje' => 'bjeto editado con exito']
        );
    }

    public function eliminarObjeto(Request $request){
        $idObjeto = Objeto::find($request->id_obj);
        if (!$idObjeto) {
            return response()->json(
                ['mensaje' => 'no existe ese objeto']
            );
        }

        $idObjeto->delete();
        return response()->json(
            ['mensaje' => 'Objeto eliminado con exito']
        );
    }
}
