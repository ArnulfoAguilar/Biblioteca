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
        <div id="modalAgregar" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <form @submit.prevent="submitHandler($v.$invalid)" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{titleToShow}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="NOMBRE">Nombre</label>
                                <input type="text" v-model.lazy="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.EJEMPLAR.EJEMPLAR.required" class="error">este campo es obligatorio</div>
                            </div>
                            <div class="form-group">
                                <label for="DESCRIPCION">Descripción</label>
                                <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                    rows="3"></textarea>
                                <div v-if="!$v.EJEMPLAR.DESCRIPCION.required" class="error">este campo es obligatorio</div>
                            </div>
                            <div class="form-group" >
                                <label for="ISBN">ISBN</label>
                                <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.EJEMPLAR.ISBN.numeric" class="error">este campo solo acepta numeros</div>
                                <div v-if="!$v.EJEMPLAR.ISBN.required" class="error">este campo es obligatorio</div>
                            </div>
                            <div class="form-group">
                                <label for="AUTOR">AUTOR/es</label>
                                <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.EJEMPLAR.AUTOR.required" class="error">este campo es obligatorio</div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="PAGINAS">Numero de paginas</label>
                                    <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.NUMERO_PAGINAS.numeric" class="error">este campo solo acepta numeros</div>
                                    <div v-if="!$v.EJEMPLAR.NUMERO_PAGINAS.required" class="error">este campo es obligatorio</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="copias">Numero de copias</label>
                                    <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS"
                                        aria-describedby="emailHelp">
                                    <div v-if="!$v.EJEMPLAR.COPIAS.numeric" class="error">este campo solo acepta numeros</div>
                                    <div v-if="!$v.EJEMPLAR.COPIAS.required" class="error">este campo es obligatorio</div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar Ejemplar</button>
                            <button class="btn btn-danger" type="submit"
                                @click="cancelarEdicion" data-dismiss="modal">Cancelar</button>
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
            modoEditar: false,
            EJEMPLAR: { EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:'', },
            isEditing: false,
            createTitle: 'Agregar Ejemplar',
            editTitle: 'Editar Ejemplar',
            titleToShow: '',
            hasError: false
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
       // console.log('componente creado')
    },
    mounted(){
       // console.log('tabla montada')
    },
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
        processEventFromApp(componentState){
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
                this.submit = this.agregar;
                this.titleToShow = this.createTitle;
                $('#modalAgregar').modal('show');
                console.log(this.$v);
            }
            if (componentState.lastAction ==='EditItem') {
                this.submit = this.editarEjemplar;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem);
                $('#modalAgregar').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarEjemplar(componentState.selectedItem, componentState.selectedIndex);
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
            this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
            $("#modalAgregar").modal('hide');
        },
        editarFormulario(item){
        this.EJEMPLAR.EJEMPLAR = item.EJEMPLAR;
        this.EJEMPLAR.DESCRIPCION = item.DESCRIPCION;
        this.EJEMPLAR.ISBN = item.ISBN;
        this.EJEMPLAR.AUTOR = item.AUTOR;
        this.EJEMPLAR.NUMERO_PAGINAS = item.NUMERO_PAGINAS;
        this.EJEMPLAR.COPIAS = item.NUMERO_COPIAS;
        this.EJEMPLAR.id = item.id;
        this.isEditing = true;
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
                    console.log("EJEMPLAR ELIMINADO");
                })
            }
        },
        cancelarEdicion(){
            this.modoEditar = false;
            this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
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
        }
    }
}
</script>

<style>

</style>
