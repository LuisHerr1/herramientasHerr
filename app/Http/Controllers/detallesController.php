<?php

namespace App\Http\Controllers;
use App\Models\Detalles;
use App\Helpers\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;

class DetallesController extends Controller
{
    public function mostrarDetalles(){
        $detalles = Detalles::all();
        if (count($detalles) == 0) {
            return Http::respuesta(http::retNotFound, "no se encontro el id");
        }
        return http::respuesta(http::retOK, $detalles);
    }

    public function mostrarObjetoPorId(Request $request){
        $idDetalle = Detalles::find($request->id_deteto);
        if (!$idDetalle) {
            return response()->json(
                ['mensaje' => 'no existe esedetalles']
            );
        }
        return response()->json(
            $idDetalle
        );
    }

    public function guardarObjeto(Request $request){
        $validator = Validator::make($request->all(), [
            'url_imagen' => 'required|string',
            'peso' => 'required|interger',
            'url_planos' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['mensaje' => $validator->errors()]
            );
        }

        $detalles = new Detalles();
        $detalles->url_imagen = $request->url_imagen;
        $detalles->peso = $request->peso;
        $detalles->url_planos = $request->url_planos;
        $detalles->save();
        return response()->json(
            ['mensaje' => 'detalles guardados con exito']
        );
    }

    public function editarDetalle(Request $request){
        $idDetalle = detalles::find($request->id_det);
        if (!$idDetalle) {
            return response()->json(
                ['mensaje' => 'no existe ese detalles']
            );
        }

        $validator = Validator::make($request->all(), [
            'url_imagen' => 'required|string',
            'peso' => 'required|interger',
            'url_planos' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['mensaje' => $validator->errors()]
            );
        }

        $idDetalle->url_imagen = $request->url_imagen;
        $idDetalle->peso = $request->peso;
        $idDetalle->url_planos = $request->url_planos;
        $idDetalle->save();
        return response()->json(
            ['mensaje' => 'bjeto editado con exito']
        );
    }

    public function eliminarObjeto(Request $request){
        $idDetalle = detalles::find($request->id_det);
        if (!$idDetalle) {
            return response()->json(
                ['mensaje' => 'no existe ese detalles']
            );
        }

        $idDetalle->delete();
        return response()->json(
            ['mensaje' => 'Detalle eliminado con exito']
        );
    }
}
