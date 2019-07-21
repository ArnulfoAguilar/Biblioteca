<template>
    <div class="content">
        <!--BUSQUEDA-->
        <section class="book-search" id="bookSearchApp" >
            <form id="book-search" class="input-group input-group-lg col-md-6" style="margin-left: auto; margin-right: auto;" @submit.prevent="search">
                <h2 class="col-md-12">Busqueda de libros por titulo</h2>
                <input type="text" class="form-control col-md-10" v-model:trim="searchTerm" placeholder="⌕">
                <button class="btn btn-info btn-flat col-md-2" type="submit">Buscar!</button>
            </form>
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 card-group" v-for="book in searchResults.items">
                <div class="card" style="width: 18rem; margin-top:25px; margin-left: auto !important;margin-rigth: auto !important">
                    <img :src="'http://books.google.com/books/content?id=' + book.id + '&printsec=frontcover&img=1&zoom=1&edge=curl&source=gbs_api'" style="max-width:180px;max-height: 250px;display: block; margin-left: auto; margin-right: auto;" >
                    <div class="card-body">
                        <h5 class="card-title">{{ book.volumeInfo.title }}</h5>
                        <p class="card-text" v-if="book.volumeInfo.authors">por {{ bookAuthors(book) }}</p>
                        <p class="card-text" v-if="book.volumeInfo.publishedDate">
                            <span>Published </span> {{ book.volumeInfo.publishedDate }}
                            <span v-if="book.volumeInfo.publisher"> por {{ book.volumeInfo.publisher }}</span>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="#" class="btn btn-dark col-md-12" @click="chooseTerm=book.id" v-on:click="chooseBook"
                           @submit.prevent="chooseBook" data-toggle="modal" data-target="#exampleModal">Seleccionar</a>
                    </div>
                </div>
            </div>
            </div>

        </section>
        <!--/BUSQUEDA-->

        <!--Modal formulario nuevo libro-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Libro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="Agregar">
                            <img :src="chooseImg.thumbnail" class="card-img-top " style="max-width:170px;max-height: 250px;display: block; margin-left: auto; margin-right: auto;" >
                            <div class="form-group">
                                <label for="NOMBRE" >Nombre</label>
                                <input type="text" v-model="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE" aria-describedby="emailHelp" >
                            </div>
                            <div class="form-group">
                                <label for="DESCRIPCION">Descripción</label>
                                <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="ISBN">ISBN</label>
                                <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN" aria-describedby="emailHelp" >
                            </div>

                            <div class="form-group">
                                <label for="">
                                    Primer Sumario
                                </label>
                                <div >
                                    <select2  :options="primerSumarios" v-model="EJEMPLAR.PRIMERSUMARIO" @input="getSegundoSumario">
                                    </select2>
                                </div>
                            </div>
                            <div class="form-group" v-if="EJEMPLAR.PRIMERSUMARIO != 0">
                                <label for="" >
                                    Segundo Sumario
                                </label>
                                <div >
                                    <select2  :options="segundoSumarios"   v-model="EJEMPLAR.SEGUNDOSUMARIO" @input="getTercerSumario" >
                                    </select2>
                                </div>
                            </div>
                            <div class="form-group" v-if="EJEMPLAR.SEGUNDOSUMARIO  != 0 && EJEMPLAR.PRIMERSUMARIO  != 0">
                                <label for="" >
                                    Tercer Sumario
                                </label>
                                <div >
                                    <select2  :options="tercerSumarios" v-model="EJEMPLAR.TERCERSUMARIO">
                                    </select2>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="AUTOR">Autor/es</label>
                                <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR" aria-describedby="emailHelp" >
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="PAGINAS">Numero de paginas</label>
                                    <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="COPIAS">Numero de copias</label>
                                    <input type="number" class="form-control" id="COPIAS" v-model="EJEMPLAR.COPIAS" aria-describedby="emailHelp">
                                </div>
                            </div>
                            <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/formulario nuevo libro-->
    </div>
</template>

<script>
    export default {
        name: "BusquedaApi",
        mounted() {
            axios.get('/PrimerSumarioSelect').then((response)=>{
                this.primerSumarios = response.data;
            });
            console.log('Component mounted.')
        },
        data() {
            return {
                searchTerm: '',
                searchResults: [],
                URL:'https://www.googleapis.com/books/v1/volumes?q=',
                Nbooks:'&maxResults=20',
                chooseTerm:'',
                URLChoose:'https://www.googleapis.com/books/v1/volumes/',
                primerSumarios :[],
                segundoSumarios: [],
                tercerSumarios: [],
                chooseResults: [],
                chooseIndustry : [],
                chooseAutors : [],
                chooseImg: [],
                EJEMPLAR: { ISBN:'', EJEMPLAR:'', DESCRIPCION: '', NUMERO_PAGINAS:'', AUTOR:'' , PRIMERSUMARIO:'',IMAGEN:'', SEGUNDOSUMARIO:'',TERCERSUMARIO:''},
            }
        },
        methods: {
            search() {
                axios.get(this.URL + this.searchTerm+ this.Nbooks)
                    .then(response => {
                        this.searchResults = response.data
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },

            bookAuthors(book) {
                let authors = book.volumeInfo.authors;
                if (authors.length < 3) {
                    authors = authors.join(' y ')
                }
                else if (authors.length > 2) {
                    let lastAuthor = ' y ' + authors.slice(-1);
                    authors.pop()
                    authors = authors.join(', ')
                    authors += lastAuthor
                }
                return authors
            },

            chooseBook(){
                axios.get(this.URLChoose+this.chooseTerm)
                    .then(response => {
                        this.chooseImg= response.data.volumeInfo.imageLinks;
                        this.EJEMPLAR.IMAGEN =this.chooseImg.thumbnail;
                        this.EJEMPLAR.DESCRIPCION = response.data.volumeInfo.description;
                        this.EJEMPLAR.EJEMPLAR = response.data.volumeInfo.title;
                        this.EJEMPLAR.ISBN = response.data.volumeInfo.industryIdentifiers[1].identifier;
                        this.EJEMPLAR.AUTOR = response.data.volumeInfo.authors;
                        this.EJEMPLAR.NUMERO_PAGINAS = response.data.volumeInfo.pageCount;
                }).catch(e=>{
                    console.log(e)
                })
            },

            getSegundoSumario(){
                if(this.EJEMPLAR.PRIMERSUMARIO!=0){
                axios.get('/SegundoSumarioSelect/'+this.EJEMPLAR.PRIMERSUMARIO).then((response)=>{
                    this.segundoSumarios = response.data;
                });
                }
            },
            getTercerSumario(){
                if(this.EJEMPLAR.PRIMERSUMARIO!=0 &&this.EJEMPLAR.SEGUNDOSUMARIO!=0){
                axios.get('/TercerSumarioSelect/'+this.EJEMPLAR.SEGUNDOSUMARIO).then((response)=>{
                    this.tercerSumarios = response.data;
                })
                }
            },
            Agregar(){
                if(this.EJEMPLAR.EJEMPLAR === '' ||
                    this.EJEMPLAR.DESCRIPCION === '' ||
                    this.EJEMPLAR.ISBN === '' ||
                    this.EJEMPLAR.AUTOR === '')
                {
                    alert("Debes llenar todos los datos");
                    return;
                }else{
                    const ejemplarNuevo = this.EJEMPLAR;
                    axios.post('Ejemplar', ejemplarNuevo)
                        .then(response=>{
                            alert("Guardado correctamente")
                            }).catch(e=>{
                            alert("Error al Guardar" + e);
                    })
                }
            }

        }
    }

</script>

