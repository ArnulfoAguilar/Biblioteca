<template>
    <div>
        <!--Tabla para visualizacion de ejemplares-->
        <JDTable
            :option="tableOptions"
            :loader="tableLoader"
            :event-from-app="eventFromApp"
            :event-from-app-trigger="eventFromAppTrigger"
            @event-from-jd-table="processEventFromApp($event)"></JDTable>
        <iframe id="excelExportArea" style="display:none"></iframe>

        <!-- Modal con el formulario para agregar un nuevo libro o editar uno existente-->
        <div id="modalForm" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <form @submit.prevent="submitHandler($v.$invalid)" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{titleToShow}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="ISBN">ISBN</label><b v-if="!$v.EJEMPLAR.ISBN.required" class="error">*</b>
                                    <input type="text" class="form-control" @blur="buscarISBExistente()" v-model="EJEMPLAR.ISBN" id="ISBN" maxlength="13" autocomplete="off"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.ISBN.numeric" class="error">este campo solo acepta numeros</div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="NOMBRE">Nombre</label><b v-if="!$v.EJEMPLAR.EJEMPLAR.required" class="error">*</b>
                                    <input type="text" v-model.lazy="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE" maxlength="500" autocomplete="off"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="SUBTITULO">Subtitulo</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.SUBTITULO" class="form-control" id="SUBTITULO" maxlength="400" autocomplete="off"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="EDITORIAL">Editorial *</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.EDITORIAL" required class="form-control" id="EDITORIAL" maxlength="100" autocomplete="off"
                                    aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="EDICION">Edición</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.EDICION" class="form-control" id="EDICION" maxlength="100" autocomplete="off"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="AÑO_EDICION">Año de edición *</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.AÑO_EDICION" required class="form-control" id="AÑO_EDICION" autocomplete="off"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="PRECIO">Precio</label>
                                    <input type="text" v-model.lazy="EJEMPLAR.PRECIO" class="form-control" placeholder="$" id="PRECIO" maxlength="100" autocomplete="off"
                                    aria-describedby="">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="AUTOR">AUTOR/es</label><b v-if="!$v.EJEMPLAR.AUTOR.required" class="error">*</b>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR" maxlength="255" autocomplete="off"
                                        aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="PAGINAS">Numero de paginas</label><b v-if="!$v.EJEMPLAR.NUMERO_PAGINAS.required" class="error">*</b>
                                    <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS" autocomplete="off"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.NUMERO_PAGINAS.numeric" class="error">este campo solo acepta numeros</div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="copias">Numero de copias</label><b v-if="!$v.EJEMPLAR.COPIAS.required" class="error">*</b>
                                    <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS" autocomplete="off"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.COPIAS.numeric" class="error">este campo solo acepta numeros</div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="LUGAR_EDICION">Lugar Edición</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.LUGAR_EDICION" id="LUGAR_EDICION" autocomplete="off"
                                        aria-describedby="emailHelp">
                                    <!--<div v-if="!$v.EJEMPLAR.CATEGORIA.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="CATALOGO_MATERIAL">Tipo de material</label>
                                    <div>
                                        <select2 :options="catalogoMaterial" :value="EJEMPLAR.CATALOGO_MATERIAL" v-model="EJEMPLAR.CATALOGO_MATERIAL"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.TERCER_SUMARIO.required" class="error">este campo es obligatorio</div>-->
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
                                    <label for="ESTADO_EJEMPLAR">Estado de ejemplar</label>
                                    <div>
                                        <select2 :options="estadoEjemplar" :value="EJEMPLAR.ESTADO_EJEMPLAR" v-model="EJEMPLAR.ESTADO_EJEMPLAR"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.ESTADO_EJEMPLAR.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="AREA">Area</label>
                                    <div>
                                        <select2 :options="areas" :value="EJEMPLAR.AREA" v-model="EJEMPLAR.AREA"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.ESTADO_EJEMPLAR.required" class="error">este campo es obligatorio</div>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label for="PRIMER_SUMARIO">Primer sumario</label>
                                    <div>
                                        <!--select2  :options="primerSumarios" v-model="PRIMERSUMARIOID" @input="getSegundoSumario"  >
                                        </select2-->
                                        <select class='form-control' v-model="PRIMERSUMARIOID" @change="getSegundoSumario">
                                            <option v-for = "primer in primerSumarios" :value="primer.id" @input="getSegundoSumario">{{primer.text}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="SEGUNDO_SUMARIO">Segundo sumario</label>
                                    <div>
                                        <!--select2 :options="segundoSumarios" v-model="SEGUNDOSUMARIOID" @input="getTercerSumario"></select2-->
                                         <select class='form-control' v-model="SEGUNDOSUMARIOID" @change="getTercerSumario">
                                            <option v-for = "segundo in segundoSumarios" :value="segundo.id"  >{{segundo.text}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label for="TERCER_SUMARIO">Tercer Sumario</label>
                                    <div>
                                        <!--select2 :options="tercerSumarios" :value="EJEMPLAR.TERCER_SUMARIO" v-model="EJEMPLAR.TERCER_SUMARIO"></select2-->
                                        <select class='form-control' v-model="EJEMPLAR.TERCER_SUMARIO" >
                                            <option v-for = "tercero in tercerSumarios" :value="tercero.id" >{{tercero.text}}</option>
                                        </select>
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
                                <div class="col-md-3 form-group">
                                    <label>Portada: </label>
                                    <input type="file" accept="image/jpeg,image/png" @change="onChange">
                                </div>
                                <div class="col-md-12">
                                    <label>Previsualización de la imagen: </label>
                                    <img :src="(portada)?portada:''" alt="" height="150px" width="150px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="DESCRIPCION">Descripción</label><b v-if="!$v.EJEMPLAR.DESCRIPCION.required" class="error">*</b>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION" maxlength="1500"
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
import { required,numeric } from "vuelidate/lib/validators";
import { async } from 'q';
export default {
    data(){
        return {
            /*Estos son los parametros que recibe el componente
             *de la tabla, tableOptions y columns seran los que
             *mas cambien dependiendo de la circunstancia en que
             *se necesite la tabla. columns es la configuracion
             *de las columnas en la tabla, este arreglo contendra
             *un objeto por columna que poseera la tabla*/
            tableOptions:{},
            tableLoader: false,
            eventFromAppTrigger: false,
            eventFromApp : {
                name: null,
                data: null
            },
            columns: [
                {
                    name:'EJEMPLAR',
                    title:'Ejemplar',
                    order: 1,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'AUTOR',
                    title:'Autor',
                    order: 2,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'ISBN',
                    title:'ISBN',
                    order: 3,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                }
            ],
            /*isEditing nos hace la distincion si se esta editando o
             *ingresando un nuevo registro, y los titulos son los
             *del modal segun la situacion*/
            search:'',
            ejemplars: [],
            primerSumarios: [],
            segundoSumarios: [],
            tercerSumarios: [],
            tipoEmpastados: [],
            tipoAdquisicion: [],
            estadoEjemplar: [],
            areas: [],
            catalogoMaterial: [],
            bibliotecas: [],
            estantes:[],
            modoEditar: false,
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
                ESTADO_EJEMPLAR:'',
                LUGAR_EDICION:'',
                TERCER_SUMARIO:'',
                PRIMER_SUMARIO:'',
                SEGUNDO_SUMARIO:'',
                TIPO_EMPASTADO:'',
                TIPO_ADQUISICION:'',
                AREA:'',
                CATALOGO_MATERIAL:'',
                PRECIO:'',
                IMAGEN:'',
                ESTANTE:''
            },
            isEditing: false,
            createTitle: 'Agregar Ejemplar',
            editTitle: 'Editar Ejemplar',
            titleToShow: '',
            hasError: false,
            BIBLIOTECA:'',
            PRIMERSUMARIOID:'',
            SEGUNDOSUMARIOID:'',
            portada:''
        }
    },
    validations:{
        EJEMPLAR:{
            EJEMPLAR:{
                required
            },
            ISBN:{
                required,
                numeric
            },
            AUTOR:{
                required
            },
            DESCRIPCION:{
                required
            },
            EDITORIAL:{
                required
            },
            EDICION:{
                required
            },
            AÑO_EDICION:{
                required
            },
            NUMERO_PAGINAS:{
                required,
                numeric
            },
            COPIAS:{
                required,
                numeric
            }
        }
    },
    created(){
        /*en la creacion del componente, se establecen las opciones
         *de la tabla*/
        this.tableOptions = {
            columns: this.columns,
            responsiveTable: true,
            contextMenuRight: true,
            contextMenuAdd: false,
            contextMenuView: false,
            quickView: 0,
            addNew: true,
            deleteItem: true
        };
        this.sendData();
        this.inicializandoSelect2();
        this.getSegundoSumario();
        this.getTercerSumario();
    },
    mounted(){
       $('#modalForm').on('hide.bs.modal',this.vaciarModelo);
    },
    methods:{
        buscarISBExistente(){
            console.log(this.EJEMPLAR.ISBN)
            axios.get('/ejemplar/existente/'+ this.EJEMPLAR.ISBN).then((response)=>{
                console.log("EJEMPLAR EXISTENTE ISBN"+response.data);
                if(Object.keys(response.data).length != 0){
                   this.$swal(
                  {
                    title: 'Alto',
                    text: "Ya existe un libro con este ISBN",
                    icon: 'warning',
                    buttons: {
                      cancel: true,
                    },
                  }).then((value) => {
                  }
                  );
                  this.EJEMPLAR.ISBN='';
                }
            });
        },
        sendData(){
            this.tableLoader = true;
            axios.get('/ejemplars').then(res=>{
                this.ejemplars=res.data;
                console.log(this.ejemplars)
                this.eventFromApp = {
                    name: 'sendData',
                    payload: this.ejemplars
                };
            this.triggerEvent();
            this.tableLoader = false;
            });
        },
        triggerEvent(){
            this.eventFromAppTrigger = true;
            this.$nextTick(()=>{
                this.eventFromAppTrigger = false;
            });
        },
        /*este metodo contiene las acciones de la tabla, todo depende del
         *evento realizado es lo que hara la funcion*/
        async processEventFromApp(componentState){
            if(componentState.lastAction === 'Refresh'){
                axios.get('/ejemplars').then((result)=>{
                    this.ejemplars=result.data;
                    this.eventFromApp = {
                        name: 'sendData',
                        payload: this.ejemplars
                    };
                    this.triggerEvent();
                })
            }
            if (componentState.lastAction ==='AddItem') {
                this.titleToShow = this.createTitle;
                $('#modalForm').modal('show');
            }
            if (componentState.lastAction ==='EditItem') {
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem.data);
                 this.setSegundoSumario(componentState.selectedItem.data);
                this.$nextTick(()=>{$('#modalForm').modal('show');})
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarEjemplar(componentState.selectedItem.data, componentState.selectedIndex);
            }
        },
        /*se dejo un solo metodo para el guardar un registro nuevo, aca es donde entra en
         *escena la variable del data isEditing*/
        guardar() {
            const ejemplarToSave = this.EJEMPLAR;
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.isEditing)
                axios.put(`/ejemplars/${this.EJEMPLAR.id}`, ejemplarToSave).then(res=>{
                    this.modoEditar = false;
                    this.isEditing = false;
                    this.success(msg);
                });
            else{
                console.log(ejemplarToSave);
                axios.post('/ejemplars', ejemplarToSave).then((res) =>{
                    this.success(msg);
                });
            }
            this.vaciarModelo();
            $("#modalForm").modal('hide');
        },
        editarFormulario(item){
            console.log(item)
        //this.EJEMPLAR.PALABRAS_CLAVE=item.PALABRAS_CLAVE;
            this.PRIMERSUMARIOID=item.ID_PRIMER_SUMARIO;
            this.getSegundoSumario();
            this.SEGUNDOSUMARIOID=item.ID_SEGUNDO_SUMARIO;
            this.getTercerSumario();
            this.EJEMPLAR.CATALOGO_MATERIAL=item.ID_CATALOGO_MATERIAL;
            this.EJEMPLAR.TERCER_SUMARIO=item.ID_TERCER_SUMARIO;
            this.EJEMPLAR.LUGAR_EDICION=item.LUGAR_EDICION;
            this.EJEMPLAR.TIPO_EMPASTADO=item.ID_TIPO_EMPASTADO;
            this.EJEMPLAR.TIPO_ADQUISICION=item.ID_TIPO_ADQUISICION;
            this.EJEMPLAR.ESTADO_EJEMPLAR=item.ID_ESTADO_EJEMPLAR;
            this.EJEMPLAR.AREA=item.ID_AREA;
            this.EJEMPLAR.OBSERVACIONES=item.OBSERVACIONES;
            this.EJEMPLAR.EJEMPLAR = item.EJEMPLAR;
            this.EJEMPLAR.DESCRIPCION = item.DESCRIPCION;
            this.EJEMPLAR.ISBN = item.ISBN;
            this.EJEMPLAR.AUTOR = item.AUTOR;
            this.EJEMPLAR.NUMERO_PAGINAS = item.NUMERO_PAGINAS;
            this.EJEMPLAR.COPIAS = item.NUMERO_COPIAS;
            this.EJEMPLAR.id = item.id;
            this.EJEMPLAR.SUBTITULO=item.SUBTITULO;
            this.EJEMPLAR.EDITORIAL=item.EDITORIAL;
            this.EJEMPLAR.EDICION=item.EDICION;
            this.EJEMPLAR.AÑO_EDICION=item.AÑO_EDICION;
            this.EJEMPLAR.PRECIO=item.PRECIO;
            this.EJEMPLAR.IMAGEN=item.IMAGEN;
            this.BIBLIOTECA = item.ID_BIBLIOTECA;
            this.getEstantes();
            this.EJEMPLAR.ESTANTE = item.ID_ESTANTE;
            this.isEditing = true;
	    this.portada = item.IMAGEN;
        },
        setSegundoSumario(item){
                this.SEGUNDOSUMARIOID=item.ID_SEGUNDO_SUMARIO;
        },
        eliminarEjemplar(EJEMPLAR, index){
            // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
            const confirmacion = confirm(`¿Esta seguro de eliminar "EJEMPLAR ${EJEMPLAR.EJEMPLAR}"?`);
            if(confirmacion){
                axios.delete(`/ejemplars/${EJEMPLAR.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
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
                //PALABRAS_CLAVE:'',
                OBSERVACIONES:'',
                ESTADO_EJEMPLAR:'',
                LUGAR_EDICION:'',
                TERCER_SUMARIO:'',
                TIPO_EMPASTADO:'',
                TIPO_ADQUISICION:'',
                PRECIO:'',
                IMAGEN:'',
                ESTANTE:''
            };
            this.PRIMERSUMARIOID='';
            this.SEGUNDOSUMARIOID='';
            this.segundoSumarios=[];
            this.tercerSumarios=[];
            this.estantes=[];
            this.isEditing =false;
            this.portada = '';
            this.BIBLIOTECA = '';
        },
        /*este metodo se ejecuta en respuesta de la promesa del axios
         *basicamente es el toastr indicandonos el exitos de la operacion
         *y la actualizacion del contenido de la tabla*/
        success(msg){
            this.sendData();
            toastr.clear();
            toastr.options.closeButton = true;
            toastr.success(msg, 'Exito');
        },
        /*Este es el metodo que se ejecuta al hacer submit del formulario
         *el parametro error es una propiedad que nos ofrece vuelidate
         *la cual es un booleano que si existe un error en el modelo
         *a validar es verdadero. */
        submitHandler(error){
            if(error){
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.error('Debe corregir los errores en el formulario si desear guardar un registro');
            }else{
                this.guardar();
            }
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
            axios.get('/EstadoEjemplarSelect').then((response)=>{
                this.estadoEjemplar = response.data;
            });
            axios.get('/Area').then((response)=>{
                this.areas = response.data;
            });
            axios.get('/CatalogoMaterialSelect').then((response)=>{
                this.catalogoMaterial = response.data;
            });
            axios.get('/inventario/bibliotecaToSelect').then((response)=>{
                this.bibliotecas = response.data;
            });
        },
        getSegundoSumario(){
            if(this.PRIMERSUMARIOID>0 ){
                axios.get('/SegundoSumarioSelect/'+this.PRIMERSUMARIOID).then((response)=>{
                    this.segundoSumarios = response.data;
                });
            }else{
                this.SEGUNDOSUMARIOID = '';
                this.segundoSumarios = [];
            }
        },
        getTercerSumario(){
            if((this.PRIMERSUMARIOID>0 && this.SEGUNDOSUMARIOID>0)){
                var response= axios.get('/TercerSumarioSelect/'+this.SEGUNDOSUMARIOID).then((response)=>{
                    this.tercerSumarios = response.data;
                });
            }else{
                this.EJEMPLAR.TERCER_SUMARIO='';
                this.tercerSumarios= []
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
        onChange(e){
            let files = e.target.files || e.dataTransfer.files;
            if (!files.length){
                return;
            }

            this.portada = URL.createObjectURL(files[0]);
            this.createImage(files[0]);
        },
        createImage(file){
            let reader = new FileReader();
            reader.onload = (e) => {
                this.EJEMPLAR.IMAGEN = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    },
}
</script>

<style>
</style>
