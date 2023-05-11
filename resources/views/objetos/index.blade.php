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
        function guardarProducto() {
            const num_serie = this.num_serie;
            const nombre = this.nombre;
            const imagen = this.imagen;
            const cantidad = this.cantidad;
            const precio_compra = this.precio_compra;
            const precio_venta = this.precio_venta;
            const fecha_vencimiento = this.fecha_vencimiento;
            const id_categorias = this.id_categorias;
            const id_marcas = this.id_marcas;
            const id_proveedores = this.id_proveedores;

            axios.post('http://127.0.0.1:8000/api/productos/save', {
                num_serie,
                nombre,
                imagen,
                cantidad,
                precio_compra,
                precio_venta,
                fecha_vencimiento,
                id_categorias,
                id_marcas,
                id_proveedores
            })
            .then(response => {
                console.log(response.data);
                obtenerProducto();
            })
            .catch(error => {
                console.log(error.response.data);
            });
        }

        function obtenerProducto() {
            return {
                productos: [],
                init: async function(){
                    this.productos = await axios.get('http://127.0.0.1:8000/api/productos/list')
                    .then(response => {
                        console.log(response.data);
                        return response.data;
                    }).catch(error => console.log(error));
                },
                editarProducto(id){
                    /* const num_serie = document.getElementById('num_serie').value;
                    const nombre = document.getElementById('nombre').value;
                    const imagen = document.getElementById('imagen').value;
                    const cantidad = document.getElementById('cantidad').value;
                    const precio_compra = document.getElementById('precio_compra').value;
                    const precio_venta = document.getElementById('precio_venta').value;
                    const fecha_vencimiento = document.getElementById('fecha_vencimiento').value;
                    const id_categorias = document.getElementById('id_categorias').value;
                    const id_marcas = document.getElementById('id_marcas').value;
                    const id_proveedores = document.getElementById('id_proveedores').value;
 */
                    /* const table = document.getElementById('productos')
                    const table = document.getElementById('modalProductos')
                    const inputs = document.querrySelectorAll('input')
                    let count = 0;

                    table.addEventListener('click',(e)=>{

                        if(e.target.matches(".btn-info")){
                            let data = e.target.patentElement.parentElement.children;
                            fillData(data)
                            modal.classList.toggle('translate')
                        }


                    })

                    const fillData = (data)=>{
                        for(let index  of inputs){
                            index.value = data[count].textContent
                            console.log(index)
                            count+=1
                        }

                    }
 */
                    axios.put('http://127.0.0.1:8000/api/productos/update/'+id, {

                        num_serie: num_serie,
                        nombre: nombre,
                        imagen: imagen,
                        cantidad: cantidad,
                        precio_compra: precio_compra,
                        precio_venta: precio_venta,
                        fecha_vencimiento: fecha_vencimiento,
                        id_categorias: id_categorias,
                        id_marcas: id_marcas,
                        id_proveedores: id_proveedores
                    })
                    .then(response => {
                        console.log(response.data);

                    })
                    .catch(error => {
                        console.log(error.response);
                    });
                        },

                eliminarProducto(id){ //deberia estar este metodo fuera del metodo obtenerproductos??
                    axios.delete("http://127.0.0.1:8000/api/productos/delete/"+id)
                    .then(res=> {
                        console.log(res.data);
                    })
                    .catch(err => console.log(err));
                },
            }
        }
        //para usar las alertas de sweet alert
        function show_alerts(mensaje, icono, foco) {
            if (foco !== "") {
                $('#'+foco).trigger('focus');
            }
            Swal.fire({
                title:mensaje,
                icon:icono,
                customClass: {confirmButton: "btn btn-primary", popup: "animated xoomIn"},
                buttonsStylling: false
        });
    }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script>

    <title>@yield('title')</title>

</head>
<body>
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
        <div class="row mt-3" id='productos'>
            <div class="col-12 col-lg-8 offset-0 offset-lg-2">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="tabla-productos">
                        <thead>
                            <tr>
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
                        <tbody x-data='obtenerProducto()'>
                            <template x-for='(producto,index) in productos.datos' :key='index'>
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
                <div x-data="{ num_serie: '', nombre: '', imagen: '', cantidad:'',precio_compra:'', precio_venta:'',fecha_vencimiento:'', id_categorias:'', id_marcas: '', id_proveedores:'' }">
                    <form @submit.prevent="guardarProducto"> <!--los nombres deben ir tal como en los campos de la tabla de la base de datos-->
                        <div class="form-group mt-2">
                            <label for="num_serie">Numero Serie:</label>
                            <input type="text" class="form-control" id="num_serie" x-model="num_serie" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="nombre">nombre:</label>
                            <input class="form-control" type="text" id="nombre" x-model="nombre" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="imagen">imagen:</label>
                            <input class="form-control" type="text" id="imagen" x-model="imagen" value="">
                        </div>
                        <div class="form-group mt-2">
                            <label for="cantidad">Cantidad:</label>
                            <input class="form-control" type="number" id="cantidad" x-model="cantidad" value="">
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
