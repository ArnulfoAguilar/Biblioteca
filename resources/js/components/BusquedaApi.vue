<template>
    <div class="content">
        <!--BUSQUEDA-->
        <section class="book-search" id="bookSearchApp" >
            <form id="book-search" class="input-group input-group-lg col-md-6" style="margin-left: auto; margin-right: auto;" @submit.prevent="search">
                <h2 class="col-md-12">Búsqueda de libros por título</h2>
                <input type="text" class="form-control col-md-9" v-model.trim="searchTerm" placeholder="⌕">
                <button class="btn btn-info btn-flat col-md-3" type="submit">Buscar!</button>
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
                           @submit.prevent="chooseBook" data-toggle="modal" data-target="#modalForm">Seleccionar</a>
                    </div>
                </div>
            </div>
            </div>

        </section>

        <div id="modalForm" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <form @submit.prevent="Agregar" >

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{titleToShow}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <img :src="chooseImg.thumbnail" class="card-img-top " style="max-width:170px;max-height: 250px;display: block; margin-left: auto; margin-right: auto;" >
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="ISBN">ISBN *</label>
                                    <input type="number" class="form-control" required v-model="EJEMPLAR.ISBN" id="ISBN" maxlength="13"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="NOMBRE">Nombre *</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.EJEMPLAR" required class="form-control" id="NOMBRE" maxlength="500"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="SUBTITULO">Subtítulo</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.SUBTITULO" class="form-control" id="SUBTITULO" maxlength="400"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="EDITORIAL">Editorial *</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.EDITORIAL" required class="form-control" id="EDITORIAL" maxlength="100"
                                    aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="EDICION">Edición</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.EDICION" class="form-control" id="EDICION" maxlength="100"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="AÑO_EDICION">Año de edición *</label>
                                    <input type="number" v-model.lazy="EJEMPLAR.AÑO_EDICION" required class="form-control" id="AÑO_EDICION"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="PRECIO">Precio</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.PRECIO" class="form-control" placeholder="$" id="EDITORIAL" maxlength="100"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="AUTOR">AUTOR/es *</label>
                                    <input type="text" class="form-control" required v-model="EJEMPLAR.AUTOR" id="AUTOR" maxlength="255"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="PAGINAS">Número de páginas *</label>
                                    <input type="number" class="form-control" required id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="copias">Número de copias *</label>
                                    <input type="number" class="form-control"  required id="copias" v-model="EJEMPLAR.COPIAS"
                                        aria-describedby="emailHelp">

                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="LUGAR_EDICION">Lugar Edición </label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.LUGAR_EDICION" id="LUGAR_EDICION"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="CATALOGO_MATERIAL">Tipo de material</label>
                                    <div>
                                        <select2 :options="catalogoMaterial" :value="EJEMPLAR.CATALOGO_MATERIAL" v-model="EJEMPLAR.CATALOGO_MATERIAL"></select2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="TIPO_EMPASTADO">Tipo empastado</label>
                                    <div>
                                        <select2 :options="tipoEmpastados" :value="EJEMPLAR.TIPO_EMPASTADO" v-model="EJEMPLAR.TIPO_EMPASTADO"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.TIPO_EMPASTADO.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="TIPO_ADQUISICION">Tipo adquisición</label>
                                    <div>
                                        <select2 :options="tipoAdquisicion" :value="EJEMPLAR.TIPO_ADQUISICION" v-model="EJEMPLAR.TIPO_ADQUISICION"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.TIPO_ADQUISICION.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="IDIOMA">Estado de ejemplar</label>
                                    <div>
                                        <select2 :options="idioma" :value="EJEMPLAR.IDIOMA" v-model="EJEMPLAR.IDIOMA"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.IDIOMA.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="AREA">Área</label>
                                    <div>
                                        <select2 :options="areas" :value="EJEMPLAR.AREA" v-model="EJEMPLAR.AREA"></select2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="PRIMER_SUMARIO">Primer sumario</label>
                                    <div>
                                        <select2 :options="primerSumarios" v-model="EJEMPLAR.PRIMERSUMARIO" @input="getSegundoSumario"></select2>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="SEGUNDO_SUMARIO">Segundo sumario</label>
                                    <div>
                                        <select2 :options="segundoSumarios"  v-model="EJEMPLAR.SEGUNDOSUMARIO" @input="getTercerSumario"></select2>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="TERCER_SUMARIO">Tercer Sumario</label>
                                    <div>
                                        <select2 :options="tercerSumarios"  v-model="EJEMPLAR.TERCER_SUMARIO"></select2>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="BIBLIOTECA">Biblioteca</label>
                                    <div>
                                        <select class='form-control' v-model="BIBLIOTECA" @change="getEstantes">
                                            <option v-for = "biblioteca in bibliotecas" :value="biblioteca.id" >{{biblioteca.text}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <div>
                                        <label for="ESTANTE">Estante</label>
                                        <select class='form-control' v-model="EJEMPLAR.ESTANTE" >
                                            <option v-for = "estante in estantes" :value="estante.id" >{{estante.text}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="DESCRIPCION">Descripción *</label>
                                    <textarea class="form-control" id="DESCRIPCION" required v-model="EJEMPLAR.DESCRIPCION" maxlength="1500"
                                        rows="3"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="OBSERVACIONES">Observaciones</label>
                                <textarea class="form-control" id="OBSERVACIONES" v-model="EJEMPLAR.OBSERVACIONES" maxlength="500"
                                    rows="3"></textarea>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-md-12 text-center">
                                    <b class="error">*Campos obligatorios</b>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar Ejemplar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- fin modal agregar -->
    </div>
</template>

<script>
    export default {
        name: "BusquedaApi",
        mounted() {

            this.inicializandoSelect2();
             $('#modalForm').on('hide.bs.modal',this.vaciarModelo);
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
                tipoEmpastados:[],
                tipoAdquisicion:[],
                idioma:[],
                areas:[],
                catalogoMaterial:[],
                segundoSumarios: [],
                tercerSumarios: [],
                chooseResults: [],
                chooseIndustry : [],
                chooseAutors : [],
                chooseImg: [],
                estantes:[],
                EJEMPLAR: {
                    EJEMPLAR: '',
                    DESCRIPCION: '',
                    ISBN: '',
                    AUTOR: '',
                    NUMERO_PAGINAS: '',
                    COPIAS:'',
                    SUBTITULO:'',
                    EDITORIAL:'',
                    EDICION:'',
                    AÑO_EDICION:'',
                    PALABRAS_CLAVE:'',
                    OBSERVACIONES:'',
                    IDIOMA:'',LUGAR_EDICION:'',
                    PRIMER_SUMARIO:'',
                    SEGUNDO_SUMARIO:'',
                    TERCER_SUMARIO:'',
                    TIPO_EMPASTADO:'',
                    TIPO_ADQUISICION:'',
                    AREA:'',
                    CATALOGO_MATERIAL:'',
                    PRECIO:'',
                    ESTANTE:''
                },
                BIBLIOTECA:''
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
                        console.log(response)
                        var description= response.data.volumeInfo.description.substr(0,1498);
                        this.chooseImg= response.data.volumeInfo.imageLinks;
                        this.EJEMPLAR.IMAGEN =this.chooseImg.thumbnail;
                        this.EJEMPLAR.DESCRIPCION = description.replace(/<\/?[^>]+(>|$)/g, "");
                        this.EJEMPLAR.EJEMPLAR = response.data.volumeInfo.title.substr(0,98);
                        this.EJEMPLAR.ISBN = response.data.volumeInfo.industryIdentifiers[1].identifier;
                        this.EJEMPLAR.AUTOR = response.data.volumeInfo.authors.toString();
                        this.EJEMPLAR.NUMERO_PAGINAS = response.data.volumeInfo.pageCount;
                }).catch(e=>{
                    console.log(e)
                })
            },
            inicializandoSelect2(){
                axios.get('/PrimerSumarioSelect/').then((response)=>{
                    this.primerSumarios = response.data;
                });
                axios.get('/TipoEmpastadoSelect').then((response)=>{
                    this.tipoEmpastados = response.data;
                });
                axios.get('/TipoAdquisicionSelect').then((response)=>{
                    this.tipoAdquisicion = response.data;
                });
                axios.get('/IdiomaSelect').then((response)=>{
                    this.idioma = response.data;
                    console.log(this.idioma)
                });
                axios.get('/Area').then((response)=>{
                    this.areas = response.data;
                    console.log(this.areas)
                });
                axios.get('/CatalogoMaterialSelect').then((response)=>{
                    this.catalogoMaterial = response.data;
                });
                axios.get('/inventario/bibliotecaToSelect').then((response)=>{
                    this.bibliotecas = response.data;
                });
            },
            getSegundoSumario(){
                console.log(this.EJEMPLAR.PRIMERSUMARIO)
                if(this.EJEMPLAR.PRIMERSUMARIO!=0){
                axios.get('/SegundoSumarioSelect/'+this.EJEMPLAR.PRIMERSUMARIO).then((response)=>{
                    this.segundoSumarios = response.data;
                    console.log(this.segundoSumarios)
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
            getEstantes(){
                if(this.BIBLIOTECA>0 ){
                    axios.get('/inventario/estantesToSelect/'+this.BIBLIOTECA).then((response)=>{
                        this.estantes = response.data;
                    });
                }else{
                    this.EJEMPLAR.ESTANTE = '';
                    this.estantes = [];
                }
            },
            Agregar(){
                if(this.EJEMPLAR.EJEMPLAR === '' ||
                    this.EJEMPLAR.DESCRIPCION === '' ||
                    this.EJEMPLAR.ISBN === '' ||
                    this.EJEMPLAR.AUTOR === ''||
                    this.EJEMPLAR.TERCER_SUMARIO === ''||
                    this.EJEMPLAR.EDITORIAL === ''||
                    this.EJEMPLAR.AÑO_EDICION === '')
                {
                    alert("Debes llenar todos los datos");
                    return;
                }
                else{
                    const ejemplarNuevo = this.EJEMPLAR;
                    console.log(ejemplarNuevo)
                    axios.post('/Ejemplar', ejemplarNuevo)
                        .then(response=>{
                            $("#modalForm").modal('hide');
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Libro agregado correctamente', 'Éxito');
                            $("#modalForm").modal('hide');

                            this.vaciarModelo();
                            $("#modalForm").modal('hide');
                        }).catch(e=>{
                            alert("Error al Guardar" + e);
                        })
                }
            },
            vaciarModelo(){
            this.EJEMPLAR = {
                EJEMPLAR: '',
                DESCRIPCION: '',
                ISBN: '',
                AUTOR: '',
                NUMERO_PAGINAS: '',
                COPIAS:'',
                SUBTITULO:'',
                EDITORIAL:'',
                EDICION:'',
                AÑO_EDICION:'',
                OBSERVACIONES:'',
                IDIOMA:'',
                LUGAR_EDICION:'',
                TERCER_SUMARIO:'',
                TIPO_EMPASTADO:'',
                TIPO_ADQUISICION:'',
                PRECIO:'',
                ESTANTE:''
            };
            this.PRIMERSUMARIOID='';
            this.SEGUNDOSUMARIOID='';
            this.BIBLIOTECA = '';
            this.segundoSumarios=[];
            this.tercerSumarios=[];
            this.estantes=[];
        },

        },
        computed: {
            strippedContent(description) {
                let regex = /(<([^>]+)>)/ig;
                return description.replace(regex, "");
            }
        }
    }

</script>

