<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script defer>
        //guardar producto

        function data () {
            return {
                num_serie:'',
                nombre:'',
                imagen:'',
                cantidad:'',
                precio_compra:'',
                precio_venta:'',
                fecha_vencimiento:'',
                id_categorias:'',
                id_marcas:'',
                id_proveedores:'',
                productos: [],
                init: async function(){
                    this.obtenerProductos();
                },
                //en uno de los videos se igualan los campos del modal a los datos enviados como respuesta
                //this.formData.campo1 = res.data.productos.campo1
                //this.formData.campo2 = res.data.productos.campo2
                //thi........
                editarProducto: async function (id) {
                    this.productos = axios.post('http://localhost:8000/api/productos/list/'+id)
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(error => console.log(error))
                },

                eliminarProducto: async function (id){

                },
                guardarProducto: async function () {
                    const data = {
                        num_serie: this.num_serie,
                        nombre: this.nombre,
                        imagen: this.imagen,
                        cantidad: this.cantidad,
                        precio_compra: this.precio_compra,
                        precio_venta: this.precio_venta,
                        fecha_vencimiento: this.fecha_vencimiento,
                        id_categorias: this.id_categorias,
                        id_marcas: this.id_marcas,
                        id_proveedores: this.id_proveedores
                    }

                    axios.post('http://127.0.0.1:8000/api/productos/save', data)
                    .then(response => {
                        console.log(response.data);
                        this.obtenerProductos();
                    })
                    .catch(error => {
                        console.log(error);
                    });
                },
                obtenerProductos: async function () {
                    this.productos = await axios.get('http://127.0.0.1:8000/api/productos/list')
                    .then(response => {
                        console.log(response.data);
                        return response.data.datos;
                    }).catch(error => console.log(error))
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>
    <title>Productos</title>
</head>
<body x-data="data">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-md-4 offset-md-4">
                <div class="d-grid mx-auto">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalProductos">
                        Nuevo
                    </button>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tabla-productos">
                        <thead>
                            <tr><!--para crear las columnas-->
                                <th class="text-center">ID</th>
                                <th class="text-center">Numero Serie</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">imagen</th>
                                <th class="text-center">Cantidad</th>
                                <th class="text-center">Precio Compra</th>
                                <th class="text-center">Precio venta</th>
                                <th class="text-center">Fecha de Vencimiento</th>
                                <th class="text-center">ID categorias</th>
                                <th class="text-center">ID Marcas</th>
                                <th class="text-center">ID proveedores</th>
                                <th class="text-center">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template x-for='(producto,index) in productos' :key='index'>
                                <tr>
                                    <td class="text-center" x-text="producto.id"></td>
                                    <td class="text-center" x-text="producto.num_serie"></td>
                                    <td class="text-center" x-text="producto.nombre"></td>
                                    <td class="text-center" x-text="producto.imagen"></td>
                                    <td class="text-center" x-text="producto.cantidad"></td>
                                    <td class="text-center" x-text="producto.precio_compra"></td>
                                    <td class="text-center" x-text="producto.precio_venta"></td>
                                    <td class="text-center" x-text="producto.fecha_vencimiento"></td>
                                    <td class="text-center" x-text="producto.id_categorias"></td>
                                    <td class="text-center" x-text="producto.id_marcas"></td>
                                    <td class="text-center" x-text="producto.id_proveedores"></td>
                                    <td class="text-center" >
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalProductos" @click="editarProducto(producto.id)">Editar</button>
                                        <button class="btn btn-danger" @click="eliminarProducto(producto.id)">Eliminar</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- INICIO DEL MODAL PRODUCTOS-->
    <div class="modal fade" id="modalProductos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Informacion del producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div x-data="{  num_serie: '', nombre: '', imagen: '', cantidad:'',precio_compra:'', precio_venta:'',fecha_vencimiento:'', id_categorias:'', id_marcas: '', id_proveedores:'' }">
                    <form @submit.prevent="guardarProducto">
                        <div class="form-group mt-2">
                            <label for="num_serie">Numero Serie:</label>
                            <input type="text" class="form-control" id="num_serie" x-model="num_serie" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="nombre">nombre:</label>
                            <input class="form-control" type="text" id="nombre" x-model="nombre" value="+nombre.value">
                        </div>                          <!--para poder mostrar los datos precargados en la vase dd datos, abrir bloque php -->
                        <div class="form-group mt-2"> <!--$variable = $_SESSION['variable'];$data = mysqi_querry($conexion,'SELECT * FROM nomTABLA WHERE campo = $variable')-->
                            <label for="imagen">imagen:</label><!-- WHILE ($consulta = mysqli_fetch_array($data))cerrar bloque php-->
                            <input class="form-control" type="text" id="imagen" x-model="imagen" value="">
                        </div>                          <!--otra forma para solucionar este problema puede ser declarar una variable en js-->
                        <div class="form-group mt-2">   <!-- var namvar=document.getElementById('TABLA')-->
                                                        <!-- var var2=namvar.split('-')despues acceder a ccada elemnto usando [i] -->
                                                        <!--document.getElementById(id).value=var2[i]-->
                            <label for="cantidad">Cantidad:</label>
                            <input class="form-control" type="number" name="nombre" id="cantidad" x-model="cantidad" value=\"nombre\">
                        </div>
                        <div class="form-group mt-2">
                            <label for="precio_compra">compra:</label>
                            <input class="form-control" type="number" id="precio_compra" x-model="precio_compra" step=".01" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="precio_venta">venta:</label>
                            <input class="form-control" type="number" id="precio_venta" x-model="precio_venta" step=".01" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="fecha_vencimiento">vence:</label>
                            <input class="form-control" type="date" id="fecha_vencimiento" x-model="fecha_vencimiento" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="id_categorias">categoria:</label>
                            <input class="form-control" type="integer" id="id_categorias" x-model="id_categorias" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="id_marcas">Marcas:</label>
                            <input class="form-control" type="integer" id="id_marcas" x-model="id_marcas" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="id_proveedores">Proveedores:</label>
                            <input class="form-control" type="integer" id="id_proveedores" x-model="id_proveedores" value="">
                        </div>

                       {{--  // Obtener el valor del campo de la base de datos
                        var nombre = "<?php echo $nombre; ?>";
                        // Seleccionar el modal y el input
                        var modal = $('#myModal');
                        var input = modal.find('#nombre');
                        // Asignar el valor del input al abrir el modal
                        modal.on('show.bs.modal', function() {
                          input.val(nombre);
                        }); --}}

                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    <!-- FIN DEL MODAL PRODUCTOS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
