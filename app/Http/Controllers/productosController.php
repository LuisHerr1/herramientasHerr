<?php

namespace App\Http\Controllers;
use App\Models\Productos;
use App\Helpers\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\validator;



class productosController extends Controller
{
    public function mostrarProducto(){
        $productos = Productos::all();
        if (count($productos) == 0) {
            return Http::respuesta(http::retNotFound, "no se encontro el id");
        }
        return http::respuesta(http::retOK, $productos);
    }

    public function mostrarProductoPorId(Request $request){
        $idProducto = Productos::find($request->id);
        if (!$idProducto) {
            return response()->json(
                ['mensaje' => 'no existe esedetalles']
            );
        }
        return http::respuesta(http::retOK, $idProducto);
    }

    public function guardarProducto(Request $request){
        $validator = Validator::make($request->all(), [
            'num_serie' =>'required|string',
            'nombre'=>'required|string',
            'imagen'=>'required|string',
            'cantidad'=>'required|integer',
            'precio_compra'=>'required|numeric',
            'precio_venta'=>'required|numeric',
            'fecha_vencimiento'=>'date',
            'id_categorias'=>'integer|min:1|max:5',
            'id_marcas'=>'integer|min:1|max:5',
            'id_proveedores'=>'integer|min:1|max:5'

        ]);

        if ($validator->fails()) {
            return response()->json(
                ['mensaje' => $validator->errors()]
            );
        }

        $productos = new Productos();
        $productos->num_serie = $request->num_serie;
        $productos->nombre = $request->nombre;
        $productos->imagen = $request->imagen;
        $productos->cantidad = $request->cantidad;
        $productos->precio_compra = $request->precio_compra;
        $productos->precio_venta = $request->precio_venta;
        $productos->fecha_vencimiento = $request->fecha_vencimiento;
        $productos->id_categorias = $request->id_categorias;
        $productos->id_marcas = $request->id_marcas;
        $productos->id_proveedores = $request->id_proveedores;
        $productos->save();
        return response()->json(
            ['mensaje' => 'detalles guardados con exito']
        );
    }
    public function editar($id){
        $productos = productos::find($id);
        if ($productos){
            return Http::respuesta(http::retOK,$productos);
        }else{
            return Http::respuesta(http::retNotFound,"no encontrado");
        }
    }
    public function editarProducto(Request $request){
        $productos = productos::find($request->id);
        if (!$productos) {
            $productos->update::all();
            return response()->json(
                ['mensaje' => 'no existe ese productos']
            );//al hacer uso de insomnia da como resultado un error 500 en el que ademas se indica que no se puede editar o modificar un row child
            //una restriccion para una llave foranea falla "SQLSTATE[23000]: Integrity constraint violation: 1452
            //Cannot add or update a child row: a foreign key constraint fails (`almacen`.`productos`, CONSTRAINT `productos_id_proveedores_foreign`
            // FOREIGN KEY (`id_proveedores`) REFERENCES `proveedores` (`id`) ON DELETE SET NULL ON UPDATE CASCADE)"

            //una posible solucion es la de ono tratar de moodificar ninguna de las llaves foraneas ya sea en el controlador ni en la vista

        };
        $validator = Validator::make($request->all(), [
            'num_serie' =>'required|string',
            'nombre'=>'required|string',
            'imagen'=>'required|string',
            'cantidad'=>'required|interger',
            'precio_compra'=>'required|numeric',
            'precio_venta'=>'required|numeric',
            'fecha_vencimiento'=>'required|string',
            /* 'id_categorias'=>'required|1-5',
            'id_marcas'=>'required|1-5',
            'id_proveedores'=>'required|1-5'
 */
        ]);

        if ($validator->fails()) {
            return response()->json(
                ['mensaje' => $validator->errors()]
            );
        }

        $productos->num_serie = $request->num_serie;
        $productos->nombre = $request->nombre;
        $productos->imagen = $request->imagen;
        $productos->cantidad = $request->cantidad;
        $productos->precio_compra = $request->precio_compra;
        $productos->precio_venta = $request->precio_venta;
        $productos->fecha_vencimiento = $request->fecha_vencimiento;
       /*  $productos->id_categorias = $request->id_categorias;
        $productos->id_marcas = $request->id_marcas;
        $productos->id_proveedores = $request->id_proveedores; */
        $productos->save();
        return response()->json(
            ['mensaje' => 'bjeto editado con exito']
        );
    }

    public function eliminarProducto(Request $request){
        $idProducto = productos::find($request->id);
        if (!$idProducto) {
            return response()->json(
                ['mensaje' => 'no existe ess productos']
            );
        }

        $idProducto->delete();
        return response()->json(
            ['mensaje' => 'Detalle eliminado con exito']
        );
    }
}
