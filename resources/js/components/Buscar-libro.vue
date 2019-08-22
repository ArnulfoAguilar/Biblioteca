<template>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12" style="overflow: auto; height:500px; ">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <!-- OPCION 1 PARA LAS BUSQUEDAS DE LIBROS -->
                            <div class="row">
                                <div class="form-check ">
                                    <input type="checkbox" class="form-check-input" id="check_titulo" v-model="check_titulo" checked>
                                    <label class="form-check-label" for="exampleCheck1">Titulo</label>
                                    <input type="text" class="form-control" name="" id="" :disabled="!check_titulo" v-model="search_titulo" autofocus>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="check_autor" v-model="check_autor" >
                                    <label class="form-check-label" for="exampleCheck1">Autor</label>
                                    <input type="text" class="form-control" name="" id="" :disabled="!check_autor" v-model="search_autor">
                                </div>
                            </div>
                            <!-- OPCION 2 PARA LAS BUSQUEDAS DE LIBROS -->
                            <!-- <form class="was-validated">
                                <h4>Seleccione el filtro para la busqueda</h4>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input v-model="filtro" value="1" type="radio" class="custom-control-input" id="customControlValidation1" name="radio-stacked" required>
                                    <label class="custom-control-label" for="customControlValidation1">Titulo</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input v-model="filtro" value="2" type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" required>
                                    <label class="custom-control-label" for="customControlValidation2">Autor</label>
                                </div>
                            </form>
                            <input class="form-control mt-2 col-md-6" placeholder="Escriba para buscar..." v-model="search"> -->

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
            
            <!-- Modal para realizar prestamo -->
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
                                <!-- <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="3" disabled></textarea>
                                </div> -->
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
                                <!-- <div class="form-group">
                                    <label for="AUTOR">Persona que realiza prestamo</label>
                                    <input type="text" class="form-control" id="" value=""
                                        aria-describedby="emailHelp" disabled>
                                </div> -->
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
            <!-- fin modal realizar prestamo -->



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
                check_titulo:true,
                check_autor:false,
                search_titulo:'',
                campo_titulo:'',
                search_autor:'',
                campo_autor:'',

                // filtro:'',
                // search:'',
                // campo:'',

                hoy: new Date(),
                campo:'',
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
            cancelarEdicion(){
                this.modoEditar = false;
                this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
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
        },
        computed:{
            searchEjemplar: function(){
                
                if(this.search_titulo=="" && this.search_autor==""){
                    return "";
                }else{
                    if(this.check_titulo==true && this.search_titulo!=''){
                        this.campo_titulo = this.search_titulo.toUpperCase();
                        if(this.check_autor==true){
                            this.campo_autor = this.search_autor.toUpperCase();
                            return this.ejemplars.filter((item) =>
                                item.EJEMPLAR.toUpperCase().includes(this.campo_titulo) &&
                                item.AUTOR.toUpperCase().includes(this.campo_autor)
                            );
                        }
                        return this.ejemplars.filter((item) =>item.EJEMPLAR.toUpperCase().includes(this.campo_titulo));
                    }else{
                        if(this.check_autor==true && this.search_autor !=''){
                            this.campo_autor = this.search_autor.toUpperCase();
                            return this.ejemplars.filter((item) =>
                                item.AUTOR.toUpperCase().includes(this.campo_autor)
                            );
                        }
                    }
                }

                // if(this.search == ""){
                //     return "";
                // }else{
                //     this.campo = this.search.toUpperCase();
                //     switch (this.filtro) {
                //         case '1':
                //             return this.ejemplars.filter((item) =>item.EJEMPLAR.toUpperCase().includes(this.campo));
                //             break;
                //         case '2':
                //             return this.ejemplars.filter((item) =>item.AUTOR.toUpperCase().includes(this.campo));
                //             break;
                //         default:
                //             break;
                //     }
                // }
                
                
            }
        }
    }

</script>