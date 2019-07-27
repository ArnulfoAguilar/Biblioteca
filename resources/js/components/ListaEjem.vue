<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12" style="overflow: auto; height:500px; ">
                <div class="card">
                    <div class="card-header">
                        Lista de ejemplares
                        
                        <button type="button" class="btn btn-info btn-sm float-none" data-toggle="modal" data-target="#modalAgregar">Agregar</button>

                        <input class="form-control col-md-3 float-right" placeholder="Buscar por titulo..." v-model="search">
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item" 
                                v-for="(item, index) in searchEjemplar" :key="index" >
                            <span class="badge badge-primary float-right">
                                Actualizado el: {{item.updated_at}}
                            </span>
                            <p>TITULO: {{item.EJEMPLAR}}</p>
                            <p>AUTOR: {{item.AUTOR}}</p>
                            <p>ISBN: {{item.ISBN}}</p>
                            <p>NÚMERO DE PÁGINAS: {{item.NUMERO_PAGINAS}}</p>
                            <p>COPIAS: {{item.NUMERO_COPIAS}}</p>
                            <p>
                                <!-- <button class="btn btn-warning btn-sm" 
                                    @click="editarFormulario(item)">Editar</button> -->
                                <button @click="editarFormulario(item)" type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditar">Editar</button>
                                <button class="btn btn-danger btn-sm" 
                                    @click="eliminarEjemplar(item, index)">Eliminar</button>
                            </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Modal para editar-->
            <div id="modalEditar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <form @submit.prevent="editarEjemplar(EJEMPLAR)">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Editar un ejemplar</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="NOMBRE">Nombre</label>
                                    <input type="text" v-model="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ISBN">ISBN</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label for="AUTOR">AUTOR/es</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="PAGINAS">Numero de paginas</label>
                                        <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                            aria-describedby="emailHelp">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="copias">Numero de copias</label>
                                        <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS"
                                            aria-describedby="emailHelp">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-warning float-left" type="submit">Editar</button>
                                <button class="btn btn-danger" type="submit" 
                                    @click="cancelarEdicion" data-dismiss="modal">Cancelar edición</button>
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
        name: "ListaEJem",
        mounted() {
            console.log('Lista ejemplares mounted.')
        },
        data() {
            return {
                search:'',
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
                this.actualizar();
                })
            
            },
            eliminarEjemplar(EJEMPLAR, index){
                swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
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
                return this.ejemplars.filter((item) => 
                    item.EJEMPLAR.includes(this.search) ||
                    item.AUTOR.includes(this.search) ||
                    item.ISBN.includes(this.search)
                );
            }
        }
    }

</script>