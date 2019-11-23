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
                                <input type="text" v-model.lazy="TIPO_PENALIZACION.TIPO_PENALIZACION" class="form-control" id="NOMBRE"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.TIPO_PENALIZACION.TIPO_PENALIZACION.required" class="error">Este campo es obligatorio</div>
                            </div>
                            
                            
                            
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar Penalizacion</button>
                            <button class="btn btn-danger" type="submit"
                                @click="cancelarEdicion" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- fin modal agregar -->{{TIPO_PENALIZACION}} {{isEditing}} {{modoEditar}}
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
                    name:'TIPO_PENALIZACION',
                    title:'Penalizacion',
                    order: 1,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
            ],
            /*isEditing nos hace la distincion si se esta editando o
             *ingresando un nuevo registro, y los titulos son los
             *del modal segun la situacion*/
            search:'',
            penalizaciones: [],
            modoEditar: false,
            TIPO_PENALIZACION: { TIPO_PENALIZACION: '', },
            isEditing: false,
            createTitle: 'Agregar Penalizacion',
            editTitle: 'Editar Penalizacion',
            titleToShow: '',
            hasError: false
        }
    },
    validations:{
        TIPO_PENALIZACION:{
            TIPO_PENALIZACION:{
                required
            },
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
       console.log('penalizaciones montada')
    },
    methods:{
        sendData(){
            this.tableLoader = true;
            axios.get('/penalizaciones').then(res=>{
                this.penalizaciones=res.data;
                this.eventFromApp = {
                    name: 'sendData',
                    payload: this.penalizaciones
                };
            this.triggerEvent();
            this.tableLoader = false;
                                console.log(this.penalizaciones);

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
                axios.get('/penalizaciones').then((result)=>{
                    this.penalizaciones=result.data;
                    this.eventFromApp = {
                        name: 'sendData',
                        payload: this.penalizaciones
                    };
                    this.triggerEvent();
                    console.log(this.penalizaciones);
                })
            }
            if (componentState.lastAction ==='AddItem') {
                this.submit = this.agregar;
                this.titleToShow = this.createTitle;
                $('#modalAgregar').modal('show');
                console.log(this.$v);
            }
            if (componentState.lastAction ==='EditItem') {
                this.submit = this.editarPenalizacion;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem);
                $('#modalAgregar').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarComite(componentState.selectedItem, componentState.selectedIndex);
            }
        },
        /*se dejo un solo metodo para el guardar un registro nuevo, aca es donde entra en
         *escena la variable del data isEditing*/
        guardar() {
            const penalizacionToSave = this.TIPO_PENALIZACION;
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.modoEditar)
                axios.put(`/penalizaciones/${this.TIPO_PENALIZACION.id}`, penalizacionToSave).then(res=>{
                    this.modoEditar = false;
                    this.success(msg);
                });
            else
                axios.post('/penalizaciones', penalizacionToSave).then((res) =>{
                    this.success(msg);
                });
            this.TIPO_PENALIZACION = {TIPO_PENALIZACION: ''};
            $("#modalAgregar").modal('hide');
        },
        editarFormulario(item){
        this.TIPO_PENALIZACION.TIPO_PENALIZACION = item.data.TIPO_PENALIZACION;
        
        this.TIPO_PENALIZACION.id = item.data.id;
        this.isEditing = true;
        this.modoEditar = true;
        },
        eliminarComite(TIPO_PENALIZACION, index){
            // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
            console.log(TIPO_PENALIZACION.data.id);
            const confirmacion = confirm(`¿Esta seguro de eliminar "TIPO_PENALIZACION: ${TIPO_PENALIZACION.data.TIPO_PENALIZACION} "?`);
            if(confirmacion){
                axios.delete(`/penalizaciones/${TIPO_PENALIZACION.data.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
                    console.log("TIPO_PENALIZACION ELIMINADA");
                })
            }
        },
        cancelarEdicion(){
            this.modoEditar = false;
            this.isEditing = false;
            this.TIPO_PENALIZACION = {TIPO_PENALIZACION: ''};
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
