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
                                <div class="col-md-4 form-group">
                                    <label for="ISBN">ISBN</label><b v-if="!$v.EJEMPLAR.ISBN.required" class="error">*</b>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.ISBN.numeric" class="error">este campo solo acepta numeros</div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="NOMBRE">Nombre</label><b v-if="!$v.EJEMPLAR.EJEMPLAR.required" class="error">*</b>
                                    <input type="text" v-model.lazy="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="SUBTITULO">Subtitulo</label><b v-if="!$v.EJEMPLAR.SUBTITULO.required" class="error">*</b>
                                    <input type="text" v-model.lazy="EJEMPLAR.SUBTITULO" class="form-control" id="SUBTITULO"
                                    aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="EDITORIAL">Editorial</label><b v-if="!$v.EJEMPLAR.EDITORIAL.required" class="error">*</b>
                                    <input type="text" v-model.lazy="EJEMPLAR.EDITORIAL" class="form-control" id="EDITORIAL"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="EDICION">Edición</label><b v-if="!$v.EJEMPLAR.EDICION.required" class="error">*</b>
                                    <input type="text" v-model.lazy="EJEMPLAR.EDICION" class="form-control" id="EDICION"
                                    aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="AÑO_EDICION">Año de edición</label><b v-if="!$v.EJEMPLAR.AÑO_EDICION.required" class="error">*</b>
                                    <input type="text" v-model.lazy="EJEMPLAR.AÑO_EDICION" class="form-control" id="AÑO_EDICION"
                                    aria-describedby="emailHelp">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="AUTOR">AUTOR/es</label><b v-if="!$v.EJEMPLAR.AUTOR.required" class="error">*</b>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="PAGINAS">Numero de paginas</label><b v-if="!$v.EJEMPLAR.NUMERO_PAGINAS.required" class="error">*</b>
                                    <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.NUMERO_PAGINAS.numeric" class="error">este campo solo acepta numeros</div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="copias">Numero de copias</label><b v-if="!$v.EJEMPLAR.COPIAS.required" class="error">*</b>
                                    <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.COPIAS.numeric" class="error">este campo solo acepta numeros</div>
                                </div>
                            </div>
                            <div class="row">
                                <!--<div class="col-md-4 form-group">
                                    <label for="PALABRAS_CLAVE">Palabras clave</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.PALABRAS_CLAVE" id="PALABRAS_CLAVE"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.PALABRAS_CLAVE.required" class="error">este campo es obligatorio</div>
                                </div>-->
                                <div class="col-md-4 form-group">
                                    <label for="LUGAR_EDICION">Lugar Edición</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.LUGAR_EDICION" id="LUGAR_EDICION"
                                        aria-describedby="emailHelp">
                                    <!--<div v-if="!$v.EJEMPLAR.CATEGORIA.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="CATALOGO_MATERIAL">Tipo de material</label>
                                    <div>
                                        <select2 :options="catalogoMaterial" :value="EJEMPLAR.CATALOGO_MATERIAL" v-model="EJEMPLAR.CATALOGO_MATERIAL"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.TERCER_SUMARIO.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="TIPO_EMPASTADO">Tipo empastado</label>
                                    <div>
                                        <select2 :options="tipoEmpastados" :value="EJEMPLAR.TIPO_EMPASTADO" v-model="EJEMPLAR.TIPO_EMPASTADO"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.TIPO_EMPASTADO.required" class="error">este campo es obligatorio</div>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="TIPO_ADQUISICION">Tipo adquisición</label>
                                    <div>
                                        <select2 :options="tipoAdquisicion" :value="EJEMPLAR.TIPO_ADQUISICION" v-model="EJEMPLAR.TIPO_ADQUISICION"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.TIPO_ADQUISICION.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="ESTADO_EJEMPLAR">Estado de ejemplar</label>
                                    <div>
                                        <select2 :options="estadoEjemplar" :value="EJEMPLAR.ESTADO_EJEMPLAR" v-model="EJEMPLAR.ESTADO_EJEMPLAR"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.ESTADO_EJEMPLAR.required" class="error">este campo es obligatorio</div>-->
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="AREA">Area</label>
                                    <div>
                                        <select2 :options="areas" :value="EJEMPLAR.AREA" v-model="EJEMPLAR.AREA"></select2>
                                    </div>
                                    <!--<div v-if="!$v.EJEMPLAR.ESTADO_EJEMPLAR.required" class="error">este campo es obligatorio</div>-->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="PRIMER_SUMARIO">Primer sumario</label>
                                    <div>
                                        <select2 :options="primerSumarios" :value="PRIMERSUMARIOID" v-model="PRIMERSUMARIOID" @input="getSegundoSumario"></select2>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="SEGUNDO_SUMARIO">Segundo sumario</label>
                                    <div>
                                        <select2 :options="segundoSumarios" :value="SEGUNDOSUMARIOID" v-model="SEGUNDOSUMARIOID" @input="getTercerSumario"></select2>
                                    </div>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="TERCER_SUMARIO">Tercer Sumario</label>
                                    <div>
                                        <select2 :options="tercerSumarios" :value="EJEMPLAR.TERCER_SUMARIO" v-model="EJEMPLAR.TERCER_SUMARIO"></select2>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="DESCRIPCION">Descripción</label><b v-if="!$v.EJEMPLAR.DESCRIPCION.required" class="error">*</b>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="3"></textarea>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="OBSERVACIONES">Observaciones</label><b v-if="!$v.EJEMPLAR.OBSERVACIONES.required" class="error">*</b>
                                <textarea class="form-control" id="OBSERVACIONES" v-model="EJEMPLAR.OBSERVACIONES"
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
                TIPO_EMPASTADO:'',
                TIPO_ADQUISICION:'',
                AREA:'',
                CATALOGO_MATERIAL:''
            },
            isEditing: false,
            createTitle: 'Agregar Ejemplar',
            editTitle: 'Editar Ejemplar',
            titleToShow: '',
            hasError: false,
            PRIMERSUMARIOID:'',
            SEGUNDOSUMARIOID:''
        }
    },
    validations:{
        EJEMPLAR:{
            EJEMPLAR:{
                required
            },
            SUBTITULO:{
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
            OBSERVACIONES:{
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
            /*PALABRAS_CLAVE:{
                required
            },
            ESTADO_EJEMPLAR:{
                required
            },
            TIPO_ADQUISICION:{
                required
            },
            TIPO_EMPASTADO:{
                required
            },
            TERCER_SUMARIO:{
                required
            },
            CATEGORIA:{
                required
            },*/
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
    },
    mounted(){
       $('#modalForm').on('hide.bs.modal',this.vaciarModelo);
    },
    /* beforeUpdate(){
        if(this.SEGUNDOSUMARIOID>0 && this.segundoSumarios.length===0){
        //console.log('tratando de llenar los combos');
            this.getSegundoSumario();
        }

        if(this.EJEMPLAR.TERCER_SUMARIO>0&& this.tercerSumarios.length===0)
            this.getTercerSumario();
    }, */
    methods:{
        sendData(){
            this.tableLoader = true;
            axios.get('/ejemplars').then(res=>{
                this.ejemplars=res.data;
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
                // var segundo = await axios.get('/SegundoSumarioSelect/'+componentState.selectedItem.ID_PRIMER_SUMARIO)
                // this.segundoSumarios=segundo.data;
                // var tercero = await axios.get('/TercerSumarioSelect/'+componentState.selectedItem.ID_SEGUNDO_SUMARIO)
                // this.tercerSumarios=tercero.data;
                //console.log(componentState.selectedItem)
                this.editarFormulario(componentState.selectedItem.data);
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
                    this.success(msg);
                });
            else
                axios.post('/ejemplars', ejemplarToSave).then((res) =>{
                    this.success(msg);
                });
            this.vaciarModelo();
            $("#modalForm").modal('hide');
        },
        editarFormulario(item){
            this.isEditing = true;
        //this.EJEMPLAR.PALABRAS_CLAVE=item.PALABRAS_CLAVE;
            this.PRIMERSUMARIOID=item.ID_PRIMER_SUMARIO;
            this.SEGUNDOSUMARIOID=item.ID_SEGUNDO_SUMARIO;
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
        //this.$forceUpdate();
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
                TIPO_ADQUISICION:''
            };
            this.PRIMERSUMARIOID='';
            this.SEGUNDOSUMARIOID='';
            this.segundoSumarios=[];
            this.tercerSumarios=[];
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
            axios.get('/area').then((response)=>{
                this.areas = response.data;
            });
            axios.get('/CatalogoMaterialSelect').then((response)=>{
                this.catalogoMaterial = response.data;
            });
        },
        getSegundoSumario(){
            if(this.PRIMERSUMARIOID>0){
                axios.get('/SegundoSumarioSelect/'+this.PRIMERSUMARIOID).then((response)=>{
                    this.segundoSumarios = response.data;
                });
            }

        },
        getTercerSumario(){
            if(this.PRIMERSUMARIOID>0 && this.SEGUNDOSUMARIOID>0){
                var response= axios.get('/TercerSumarioSelect/'+this.SEGUNDOSUMARIOID).then((response)=>{
                    this.tercerSumarios = response.data;
                });
            }
        }
    },
    // watch:{
    //     PRIMERSUMARIOID: async function (val) {
    //         if(val>0){
    //             var response= await axios.get('/SegundoSumarioSelect/'+val)
    //             this.segundoSumarios = response.data
    //         }
    //     },
    //     SEGUNDOSUMARIOID:async function (val) {
    //         if(this.PRIMERSUMARIOID>0 && val>0){
    //             var response= await axios.get('/TercerSumarioSelect/'+val)
    //             this.tercerSumarios = response.data;
    //         }
    //     }
    // }
}
</script>

<style>

</style>
