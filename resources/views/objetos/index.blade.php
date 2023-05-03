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
        function guardarObjetos() {
            const forma = this.forma;
            const material = this.material;
            const typo = this.typo;

            axios.post('http://127.0.0.1:8000/api/objetos/save', {
                forma,
                material,
                typo
            })
            .then(response => {
                console.log(response.data);
                obtenerObjetos();
            })
            .catch(error => {
                console.log(error.response.data);
            });
        }

        function obtenerObjetos() {
            return {
                objetos: [],
                init: async function(){
                    this.objetos = await axios.get('http://127.0.0.1:8000/api/objetos/list')
                    .then(response => {
                        console.log(response.data);
                        return response.data;
                    }).catch(error => console.log(error));
                },
                editarObjeto(id_obj){  //deberia estar este metodo fuera del metodo obtenerObjetos??

                    //validar si el id_existe, es decir si el id ingresado es el mismo que esta en la tabla de la base de datos
                    if(id_obj){
                        const forma = this.forma;
                        const material = this.material;
                        const typo = this.typo;
                    }
                    return 
                    //si existe entonces editar o modificar los campos requeridos
                },

                eliminarObjeto(id_obj){ //deberia estar este metodo fuera del metodo obtenerObjetos??

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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalObjetos">
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
                            <tr>
                                <th class="text-center">ID</th>
                                <th class="text-center">Forma</th>
                                <th class="text-center">Material</th>
                                <th class="text-center">Typo</th>
                                <th class="text-center">ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody x-data='obtenerObjetos()'>
                            <template x-for='(objeto,index) in objetos.datos' :key='index'>
                                <tr>
                                    <td class="text-center" x-text="objeto.id_obj"></td>
                                    <td class="text-center" x-text="objeto.forma"></td>
                                    <td class="text-center" x-text="objeto.material"></td>
                                    <td class="text-center" x-text="objeto.typo"></td>
                                    <td class="text-center">
                                        <button class="btn btn-info" @click="editarProducto(producto.id_productos)">Editar</button>
                                        <button class="btn btn-danger" @click="eliminarProducto(producto.id_productos)">Eliminar</button>
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
    <div class="modal fade" id="modalObjetos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Informacion del producto</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div x-data="{ forma: '', material: '', typo: '' }">
                    <form @submit.prevent="guardarObjetos">
                        <div class="form-group mt-2">
                            <label for="nombre_pro">Forma:</label>
                            <input type="text" class="form-control" id="forma" x-model="forma">
                        </div>
                        <div class="form-group mt-2">
                            <label for="cantidad">Material:</label>
                            <input class="form-control" type="text" id="material" x-model="material">
                        </div>
                        <div class="form-group mt-2">
                            <label for="precio">Typo:</label>
                            <input class="form-control" type="text" id="typo" x-model="typo">
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
