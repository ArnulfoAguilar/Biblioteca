<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de ejemplares</div>
                    <div class="card-body">
                        <form @submit.prevent="editarEjemplar(EJEMPLAR)" v-if="modoEditar">
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
                            <button class="btn btn-warning" type="submit">Editar</button>
                            <button class="btn btn-danger" type="submit" 
                                @click="cancelarEdicion">Cancelar</button>
                        </form>
                        <form @submit.prevent="agregar" v-else>
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
                            <button class="btn btn-primary" type="submit">Agregar</button>
                        </form>
                        <hr>
                        <h3>Lista de ejemplars:</h3>
                        <ul class="list-group">
                            <li class="list-group-item" 
                                v-for="(item, index) in ejemplars" :key="index" >
                            <span class="badge badge-primary float-right">
                                {{item.updated_at}}
                            </span>
                            <p>TITULO: {{item.EJEMPLAR}}</p>
                            <p>AUTOR: {{item.AUTOR}}</p>
                            <p>ISBN: {{item.ISBN}}</p>
                            <p>NÚMERO DE PÁGINAS: {{item.NUMERO_PAGINAS}}</p>
                            <p>COPIAS: {{item.NUMERO_COPIAS}}</p>
                            <p>
                                <button class="btn btn-warning btn-sm" 
                                    @click="editarFormulario(item)">Editar</button>
                                <button class="btn btn-danger btn-sm" 
                                    @click="eliminarEjemplar(item, index)">Eliminar</button>
                            </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default {
        name: "BusquedaApi",
        mounted() {
            console.log('Lista ejemplares mounted.')
        },
        data() {
            return {
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
                    alert("Guardado correctamente");
                    console.log("Guardado");
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
                })
            },
            eliminarEjemplar(EJEMPLAR, index){
            const confirmacion = confirm(`Eliminar EJEMPLAR ${EJEMPLAR.EJEMPLAR}`);
            if(confirmacion){
                axios.delete(`/ejemplars/${EJEMPLAR.id}`)
                .then(()=>{
                    this.ejemplars.splice(index, 1);
                    alert("EJEMPLAR ELIMINADO");
                    console.log("EJEMPLAR ELIMINADO");
                })
            }
            },
            cancelarEdicion(){
            this.modoEditar = false;
            this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
            }

        }
    }

</script>