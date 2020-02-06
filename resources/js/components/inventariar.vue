<template>
    <div class="content">
        <!--BUSQUEDA-->
        <section class="book-search" id="bookSearchApp" >
            <form id="book-search" class="input-group input-group-lg col-md-6" style="margin-left: auto; margin-right: auto;" @submit.prevent="search">
                <h2 class="col-md-12">Ingresa el código de barra del libro</h2>
                <input type="text" ref="search" class="form-control col-md-9" v-model.trim="searchTerm" placeholder="⌕">
                <button class="btn btn-info btn-flat col-md-3" type="submit">Buscar!</button>
            </form>


        </section>
<br/>
<hr/>
        <div class="row"  v-if="this.EJEMPLAR.EJEMPLAR">
            <div class="col-12 col-sm-6">
              <h3 class="d-inline-block d-sm-none"></h3>
              <div class="col-12">
                <img :src="this.EJEMPLAR.IMAGEN" class="product-image" alt="Product Image">
              </div>

            </div>
            <div class="col-12 col-sm-6">
              <h3 class="my-3" >{{this.EJEMPLAR.EJEMPLAR}}</h3>
              <p >{{ this.EJEMPLAR.DESCRIPCION }}</p>
              <hr/>
              <h3 class="my-3">Observaciones</h3>
                <textarea class="col-12" v-model="EJEMPLAR.OBSERVACIONES"></textarea>
              <hr>
              <div class="mt-4">
                <button class="btn btn-primary btn-lg btn-flat" ref="update" v-on:click="inventariar">
                  <i class="fas fa-check fa-lg mr-2"></i>
                  Actualizar
                </button>

                <div class="btn btn-default btn-lg btn-flat" v-on:click="cancelar">
                  <i class="fas fa-window-close fa-lg mr-2"></i>
                  Cancelar
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

            this.$nextTick(() => {
                        this.$refs.search.focus();
                        });

        },
        data() {
            return {
                searchTerm: '',
                searchResults: [],

                chooseTerm:'',
                EJEMPLAR: {
                    EJEMPLAR: '',
                    DESCRIPCION: '',
                    CODIGO_BARRA:'',
                    ID_MATERIAL_BIBLIOTECARIO:'',
                    AUTOR: '',
                    OBSERVACIONES:'',
                    IMAGEN:''
                },
                //EJEMPLAR: { ISBN:'', EJEMPLAR:'', DESCRIPCION: '', NUMERO_PAGINAS:'', AUTOR:'' , PRIMERSUMARIO:'',IMAGEN:'', SEGUNDOSUMARIO:'',TERCERSUMARIO:''},
            }
        },
        methods: {
            search() {
                axios.get('/material/FindBarcode/' + this.searchTerm)
                    .then(response => {

                        this.EJEMPLAR.EJEMPLAR = response.data.EJEMPLAR;
                        this.EJEMPLAR.DESCRIPCION = response.data.DESCRIPCION;
                        this.EJEMPLAR.OBSERVACIONES = response.data.OBSERVACIONES;
                        this.EJEMPLAR.CODIGO_BARRA = response.data.CODIGO_BARRA;
                        this.EJEMPLAR.ID_MATERIAL_BIBLIOTECARIO = response.data.id_material_bibliotecario;
                        this.EJEMPLAR.IMAGEN = response.data.IMAGEN;
                        this.$nextTick(() => {
                        this.$refs.update.focus();});
                    })
                    .catch(e => {
                        console.log(e)
                    })
            },

            cancelar() {
                window.location.href='/inventariar';
            },
            inventariar(){
                const ejemplarInventariar = this.EJEMPLAR;
                    axios.put('/inventariarLibro/', ejemplarInventariar)
                        .then(response=>{

                            window.location.href='/inventariar';
                            toastr.success('Se actualizo', 'Éxito');
                        }).catch(e=>{
                            alert("Error al Guardar" + e);
                        })

            },
            Agregar(){
                if(this.EJEMPLAR.EJEMPLAR === '' ||
                    this.EJEMPLAR.DESCRIPCION === '' ||
                    this.EJEMPLAR.ISBN === '' ||
                    this.EJEMPLAR.AUTOR === ''||
                    this.EJEMPLAR.ESTADO_EJEMPLAR === ''||

                    this.EJEMPLAR.TERCER_SUMARIO === ''||
                    this.EJEMPLAR.TIPO_ADQUISICION === ''||
                    this.EJEMPLAR.SUBTITULO === ''||
                    this.EJEMPLAR.EDITORIAL === ''||
                    this.EJEMPLAR.EDICION === ''||
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
                            $("#exampleModal").modal('hide');
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Libro agregado correctamente', 'Éxito');
                            $("#exampleModal").modal('hide');

                            this.vaciarModelo();
                            $("#exampleModal").modal('hide');
                        }).catch(e=>{
                            alert("Error al Guardar" + e);
                        })
                }
            },vaciarModelo(){
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
                //PALABRAS_CLAVE:'',
                OBSERVACIONES:'',
                ESTADO_EJEMPLAR:'',
                LUGAR_EDICION:'',
                TERCER_SUMARIO:'',
                TIPO_EMPASTADO:'',
                TIPO_ADQUISICION:'',
                PRECIO:''
            };
            this.PRIMERSUMARIOID='';
            this.SEGUNDOSUMARIOID='';
            this.segundoSumarios=[];
            this.tercerSumarios=[];
        },


    }
}
</script>
