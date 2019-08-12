<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12" style="overflow: auto; height:500px; ">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <form class="was-validated">
                                <h4>Seleccione el filtro para la busqueda</h4>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input v-model="filtro" value="1" type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required>
                                    <label class="custom-control-label" for="customControlValidation1">Titulo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input v-model="filtro" value="2" type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                                    <label class="custom-control-label" for="customControlValidation2">Autor</label>
                                    <!-- <div class="invalid-feedback">More example invalid feedback text</div> -->
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input v-model="filtro" value="3" type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" required>
                                    <label class="custom-control-label" for="customControlValidation3">ISBN</label>
                                    <!-- <div class="invalid-feedback">More example invalid feedback text</div> -->
                                </div>
                            </form>
                            <input class="form-control mt-2" placeholder="Escriba para buscar..." v-model="search">
                        </div>

                        
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" 
                                v-for="(item, index) in searchEjemplar" :key="index" >
                                <h5>
                                    <span class="badge  float-right">
                                    Actualizado el: {{item.updated_at}}
                                    <!-- Actualizado el: {{date_format(item.updated_at, 'Y-m-d')}} -->
                                </span>
                                </h5>
                                <p>TITULO: {{item.EJEMPLAR}}</p>
                                <p>AUTOR: {{item.AUTOR}}</p>
                                <!-- <p>ISBN: {{item.ISBN}}</p> -->
                                <p>NÚMERO DE PÁGINAS: {{item.NUMERO_PAGINAS}}</p>
                                <!-- <p>COPIAS: {{item.NUMERO_COPIAS}}</p> -->
                                <p>
                                    <!-- <button @click="editarFormulario(item)" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar">Editar</button>
                                    <button class="btn btn-danger btn-sm " 
                                        @click="eliminarEjemplar(item, index)"><i class="fe fe-eye"></i>Eliminar</button> -->
                                    <button @click="editarFormulario(item)" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalPrestamo">Realizar Prestamo</button>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Modal para editar-->
            <div id="modalPrestamo" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <form @submit.prevent="editarEjemplar(EJEMPLAR)">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Realizar prestamo de libro</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="NOMBRE">Nombre del libro</label>
                                    <input type="text" v-model="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                        aria-describedby="emailHelp" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="3" disabled></textarea>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="ISBN">ISBN</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN"
                                        aria-describedby="emailHelp">
                                </div> -->
                                <div class="form-group">
                                    <label for="AUTOR">AUTOR/es</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR"
                                        aria-describedby="emailHelp" disabled>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="PAGINAS">Numero de paginas</label>
                                        <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                            aria-describedby="emailHelp" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="PAGINAS">Fecha de préstamo</label>
                                        <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                            aria-describedby="emailHelp" disabled>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="PAGINAS">Fecha de devolución</label>
                                        <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                            aria-describedby="emailHelp" disabled>
                                    </div>
                                    <!-- <div class="form-group col-md-6">
                                        <label for="copias">Numero de copias</label>
                                        <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS"
                                            aria-describedby="emailHelp">
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    <label for="AUTOR">Persona que realiza prestamo</label>
                                    <input type="text" class="form-control" id="" value=""
                                        aria-describedby="emailHelp" disabled>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success float-left" type="submit">Realizar Préstamo</button>
                                <button class="btn btn-danger" type="submit" 
                                    @click="cancelarEdicion" data-dismiss="modal">Cancelar Préstamo</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- fin modal editar-->

            <!-- Modal para agregar-->
            <div id="modalAgregar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <form @submit.prevent="agregar" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Agregar Ejemplar</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="NOMBRE">Nombre</label>
                                    <input type="text" v-model="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ISBN">ISBN</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="AUTOR">AUTOR/es</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="PAGINAS">Numero de paginas</label>
                                        <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="copias">Numero de copias</label>
                                        <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Agregar Ejemplar</button>
                                <button class="btn btn-danger" type="submit" 
                                    @click="cancelarEdicion" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- fin modal agregar -->

        </div>
    </div>
</template>

<script>
    // import toastr from 'toastr';

    export default {
        // name: "ListaEJem",
        name: "BusquedaDispo",
        mounted() {
            console.log('Busqueda Disponibles mounted.')
        },
        data() {
            return {
                hoy: new Date(),
                search:'',
                campo:'ABCdef',
                filtro:'',
                ejemplars: [],
                modoEditar: false,
                EJEMPLAR: { EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:'', },
            }
        },
        created(){
            axios.get('/ejemplars').then(res=>{
            this.ejemplars = res.data;
            })
        },
        methods: {
            agregar() {
                const ejemplarNuevo = this.EJEMPLAR;
                this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};    
                axios.post('/ejemplars', ejemplarNuevo)
                    .then((res) =>{
                    const ejemplarServidor = res.data;
                    this.ejemplars.push(ejemplarServidor);
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Agregado correctamente', 'Exito');
                    this.actualizar();
                    console.log("Guardado");
                    $("#modalAgregar").modal('hide');
                    this.actualizar();
                    })
            },
            editarFormulario(item){
            this.EJEMPLAR.EJEMPLAR = item.EJEMPLAR;
            this.EJEMPLAR.DESCRIPCION = item.DESCRIPCION;
            this.EJEMPLAR.ISBN = item.ISBN;
            this.EJEMPLAR.AUTOR = item.AUTOR;
            this.EJEMPLAR.NUMERO_PAGINAS = item.NUMERO_PAGINAS;
            this.EJEMPLAR.COPIAS = item.NUMERO_COPIAS;

            this.EJEMPLAR.id = item.id;
            this.modoEditar = true;
            },
            editarEjemplar(EJEMPLAR){
            const params = {
                EJEMPLAR: EJEMPLAR.EJEMPLAR, 
                DESCRIPCION: EJEMPLAR.DESCRIPCION,
                ISBN: EJEMPLAR.ISBN,
                AUTOR: EJEMPLAR.AUTOR,
                NUMERO_PAGINAS: EJEMPLAR.NUMERO_PAGINAS,
                COPIAS: EJEMPLAR.COPIAS
                };
            axios.put(`/ejemplars/${EJEMPLAR.id}`, params)
                .then(res=>{
                this.modoEditar = false;
                const index = this.ejemplars.findIndex(item => item.id === EJEMPLAR.id);
                this.ejemplars[index] = res.data;
                this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
                // alert("Editado correctamente");
                console.log("Editado correctamente");
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.success('Editado correctamente', 'Exito');
                $("#modalEditar").modal('hide');
                this.actualizar();
                })
            
            },
            eliminarEjemplar(EJEMPLAR, index){
                // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
                const confirmacion = confirm(`¿Esta seguro de eliminar "EJEMPLAR ${EJEMPLAR.EJEMPLAR}"?`);
                if(confirmacion){
                    axios.delete(`/ejemplars/${EJEMPLAR.id}`)
                    .then(()=>{
                        this.ejemplars.splice(index, 1);
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.success('Eliminado correctamente', 'Exito');
                        this.actualizar();
                        console.log("EJEMPLAR ELIMINADO");
                    })
                }
            },
            cancelarEdicion(){
                this.modoEditar = false;
                this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
            },
            actualizar(){
                axios.get('/ejemplars').then(res=>{
                this.ejemplars = res.data;
                })
            }

        },
        computed:{
            searchEjemplar: function(){
                if(this.search == ""){
                    return "";
                }else{
                    this.campo = this.search.toUpperCase();
                    switch (this.filtro) {
                        case '1':
                            return this.ejemplars.filter((item) =>item.EJEMPLAR.toUpperCase().includes(this.campo));
                            break;
                        case '2':
                            return this.ejemplars.filter((item) =>item.AUTOR.toUpperCase().includes(this.campo));
                            break;
                        case '3':
                            return this.ejemplars.filter((item) =>item.ISBN.toUpperCase().includes(this.campo));
                            break;
                        default:
                            break;
                    }
                }
            }
        }
    }

</script>