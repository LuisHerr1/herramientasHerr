var personas = [];
function obtenerPersonas() {
    axios({
        method:'GET',
        url: 'http://127.0.0.1:8000/personas/list',
        responseType: 'json'
    }).then(response => {
        console.log(response);
        this.personas = response.data
        llenarTabla();
    }).catch(err => {
        console.log(err);
    });
}
obtenerPersonas();

function llenarTabla() {
    document.querySelector('#tablaPersonas tbody').innerHTML = '';
    for (let i = 0; i < personas.length; i++) {
        document.querySelector('#tablaPersonas tbody').innerHTML +=
        `
            <tr>
                <td>${personas[i].id}</td>
                <td>${personas[i].Nombre}</td>
                <td>${personas[i].edad}</td>
                <td>
                    <button type="button" class='btn btn-info' data-bs-toggle="modal" data-bs-target="#personasModal" onclick='seleccionar(${personas[i].id})'>Info</button>
                    <button type="button" class='btn btn-danger' onclick='eliminar(${personas[i].id})'>Eliminar</button>
                </td>
            </tr>
        `;
    }
}

function eliminar(indice) {
    axios({
        method:'DELETE',
        url: 'http://127.0.0.1:8000/personas/delete/'+indice,
        responseType: 'json'
    }).then(response => {
        console.log(response);
        obtenerPersonas();
    }).catch(err => {
        console.log(err);
    });
}

function guardar(){
    let persona = {
        Nombre: document.getElementById('Nombre').value,
        edad: document.getElementById('edad').value
    }
    axios({
        method:'POST',
        url: 'http://127.0.0.1:8000/personas/save',
        responseType: 'json',
        data: persona
    }).then(response => {
        console.log(response);
        document.getElementById('Nombre').value="";
        document.getElementById('edad').value="";
        obtenerPersonas();
    }).catch(err => {
        console.log(err);
    });
}

function seleccionar(indice) {
    axios({
        method:'GET',
        url: 'http://127.0.0.1:8000/personas/list/'+indice,
        responseType: 'json',
    }).then(response => {
        console.log(response);
        document.getElementById('Nombre').value=response.data.Nombre, {{-- cada elemento aca nombre , edad, btn-guardar, btn-editar estan definido en cada input como id --}}
        document.getElementById('edad').value=response.data.edad      {{-- ademas en cada input que no son botones debe colocarse el atributo name con valor de cada campo --}}
        document.getElementById('btn-guardar').style.display = 'none';
        document.getElementById('btn-editar').style.display = 'block';
    }).catch(err => {
        console.log(err);
    });
}

function editar(params) {
}




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Personas</title>
</head>
<body>
    <div class="container mt-3">
        <div class="card m-auto">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#personasModal">
                    NUEVA
                </button>
                <div class="card-body">
                    <table id="tablaPersonas" class="table">
                        <thead class="bg-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Edad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- [INICIO] MODAL PERSONAS -->
    <div class="modal fade" id="personasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Informacion de personas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="Nombre">Nombre:</label>
                    <input type="text" class="form-control" placeholder="Nombre de la persona" name="Nombre" id="Nombre">
                </div>
                <div class="form-group">
                    <label for="edad">Edad:</label>
                    <input type="number" class="form-control" placeholder="Edad de la persona" name="edad" id="edad">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button id="btn-editar" type="button" class="btn btn-info" data-bs-dismiss="modal" onclick="editar()" style="display: none">Editar</button>
                <button id="btn-guardar" type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="guardar()">Guardar</button>
            </div>
        </div>
        </div>
    </div>
    <!-- [FIN] MODAL PERSONAS -->

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/Persona.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>
