<?php

namespace App\Http\Controllers;

use App\Helpers\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Exists;

class ProveedorController extends Controller
{
    public function mostrarProveedor(){//con este metodo se muestra toda la tabla
        $proveedor = Proveedores::all();
        if(!$proveedor){
            return Http::respuesta(http::retNotFound,'no se encontro nigun dato en la tabla');
        }
        return Http::respuesta(http::retOK,$proveedor);
    }
    public function mostrarProveedorPorId(Request $request){// con este metodo se muestran los datos del id del proveedor especificado
        $idproveedor = Proveedores::find($request->id);
        if(!$idproveedor){
            return Http::respuesta(http::retNotFound,'el id no se encuentra en la tabla');
        }
        return Http::respuesta(http::retOK,$request);
    }
    public function eliminarProveedor(Request $request){
        $idproveedor = Proveedores::find($request->id);
        if(!$idproveedor){
            return Http::respuesta(http::retNotFound,'el id ingresado no existe');
        }
        $idproveedor->delete();
        return Http::respuesta(http::retOK,['se elimino' => $idproveedor]);
    }
    public function guardarProveedor(Request $request){
        //primero validar lo ingresado por el cliente que deberia coincidir con la cantidad y tipo de datos segun la tabla proveedores
        $validador = Validator::make($request->all(),[
            'codigo'=>'required|string|unique:proveedores,codigo',//aca para declarar un campo como unico se debe colocar primero la tabla de donde procede el campo que sera unico
            
        ]);
        $proveedor = new Proveedores();
        $proveedor->codigo = $request->codigo;
    }
}
