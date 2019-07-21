<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de ejemplares</div>
                    <div class="card-body">
                        <form @submit.prevent="editarEjemplar(ejemplar)" v-if="modoEditar">
                            <div class="form-group">
                                <label for="NOMBRE">Nombre</label>
                                <input type="text" v-model="ejemplar.ejemplar" class="form-control" id="NOMBRE"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" v-model="ejemplar.descripcion"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="isbn">isbn</label>
                                <input type="text" class="form-control" v-model="ejemplar.isbn" id="isbn"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="autor">autor/es</label>
                                <input type="text" class="form-control" v-model="ejemplar.autor" id="autor"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="PAGINAS">Numero de paginas</label>
                                    <input type="number" class="form-control" id="PAGINAS" v-model="ejemplar.numero_paginas"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="copias">Numero de copias</label>
                                    <input type="number" class="form-control" id="copias" v-model="ejemplar.copias"
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
                                <input type="text" v-model="ejemplar.ejemplar" class="form-control" id="NOMBRE"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" id="descripcion" v-model="ejemplar.descripcion"
                                    rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="isbn">isbn</label>
                                <input type="text" class="form-control" v-model="ejemplar.isbn" id="isbn"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="form-group">
                                <label for="autor">autor/es</label>
                                <input type="text" class="form-control" v-model="ejemplar.autor" id="autor"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="PAGINAS">Numero de paginas</label>
                                    <input type="number" class="form-control" id="PAGINAS" v-model="ejemplar.numero_paginas"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="copias">Numero de copias</label>
                                    <input type="number" class="form-control" id="copias" v-model="ejemplar.copias"
                                        aria-describedby="emailHelp">
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
                            <p>{{item.EJEMPLAR}}</p>
                            <p>{{item.AUTOR}}</p>
                            <p>{{item.ISBN}}</p>
                            <p>{{item.NUMERO_PAGINAS}}</p>
                            <p>{{item.COPIAS}}</p>
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
                ejemplar: { ejemplar: '', descripcion: '', isbn: '',  autor: '', numero_paginas: '', copias:'', },
            }
        },
        created(){
            axios.get('/ejemplars').then(res=>{
            this.ejemplars = res.data;
            })
        },
        methods: {
            agregar() {
                if(
                    this.ejemplar.ejemplar.trim() === '' || 
                    this.ejemplar.descripcion.trim() === '' ||
                    this.ejemplar.isbn.trim() === '' ||
                    this.ejemplar.autor.trim() === '' ||
                    this.ejemplar.numero_paginas.trim() === '' ||
                    this.ejemplar.copias.trim() === ''
                    )
                {
                    alert('Debes completar todos los campos antes de guardar');
                    return;
                }
                const ejemplarNuevo = this.ejemplar;
                this.ejemplar = {nombre: '', descripcion: ''};    
                axios.post('/ejemplars', ejemplarNuevo)
                    .then((res) =>{
                    const ejemplarServidor = res.data;
                    this.ejemplars.push(ejemplarServidor);
                    })
            },
            editarFormulario(item){
            this.ejemplar.ejemplar = item.EJEMPLAR;
            this.ejemplar.descripcion = item.DESCRIPCION;
            this.ejemplar.isbn = item.ISBN;
            this.ejemplar.autor = item.AUTOR;
            this.ejemplar.numero_paginas = item.NUMERO_PAGINAS;
            this.ejemplar.copias = item.COPIAS;

            this.ejemplar.id = item.id;
            this.modoEditar = true;
            },
            editarEjemplar(ejemplar){
            const params = {
                ejemplar: ejemplar.ejemplar, 
                descripcion: ejemplar.descripcion,
                isbn: ejemplar.isbn,
                autor: ejemplar.autor,
                numero_paginas: ejemplar.numero_paginas,
                copias: ejemplar.copias
                };
            axios.put(`/ejemplars/${ejemplar.id}`, params)
                .then(res=>{
                this.modoEditar = false;
                const index = this.ejemplars.findIndex(item => item.id === ejemplar.id);
                this.ejemplars[index] = res.data;
                })
            },
            eliminarEjemplar(ejemplar, index){
            const confirmacion = confirm(`Eliminar ejemplar ${ejemplar.EJEMPLAR}`);
            if(confirmacion){
                axios.delete(`/ejemplars/${ejemplar.id}`)
                .then(()=>{
                    this.ejemplars.splice(index, 1);
                })
            }
            },
            cancelarEdicion(){
            this.modoEditar = false;
            this.ejemplar = {nombre: '', descripcion: ''};
            }

        }
    }

</script>