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
                                <input type="text" v-model.lazy="Estante.ESTANTE" class="form-control" id="ESTANTE"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.Estante.ESTANTE.required" class="error">Este campo es obligatorio</div>
                            </div>

                            <div class="form-group">
                                <label for="NOMBRE">Biblioteca a la que pertenece</label>
                                <select class="form-control" v-model="Estante.ID_BIBLIOTECA">
                                    <option disabled value="">Por favor seleccione una</option>
                                    <option v-for="(item, index) in bibliotecas" :key="index" v-bind:value="item.id">
                                    {{ item.BIBLIOTECA }}
                                    </option>
                                </select>
                                <div v-if="!$v.Estante.ID_BIBLIOTECA.required" class="error">Este campo es obligatorio</div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar Estante</button>
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
                    name:'ESTANTE',
                    title:'Estante',
                    order: 1,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'BIBLIOTECA',
                    title:'Biblioteca',
                    order: 2,
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
            estantes: [],
            bibliotecas: [],
            modoEditar: false,
            Estante: { id:'', ESTANTE: '', ID_BIBLIOTECA:''},

            isEditing: false,
            createTitle: 'Agregar Estante',
            editTitle: 'Editar Estante',
            titleToShow: '',
            hasError: false
        }
    },
    validations:{
        Estante:{
            ESTANTE:{
                required
            },
            ID_BIBLIOTECA:{
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
       // console.log('tabla montada')
    },
    methods:{
        sendData(){
            this.tableLoader = true;
            axios.get('/Estante').then(res=>{
                this.estantes = res.data;
                this.eventFromApp = {
                    name: 'sendData',
                    payload: this.estantes
                };
            this.triggerEvent();
            this.tableLoader = false;
            console.log(this.estantes);
            });

            axios.get('/Biblioteca').then(res=>{
                this.bibliotecas = res.data;
                
           
            console.log(this.bibliotecas);
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
                axios.get('/Estante').then((result)=>{
                    this.estantes=result.data;
                    this.eventFromApp = {
                        name: 'sendData',
                        payload: this.estantes
                    };
                    this.triggerEvent();
                })
                axios.get('/Biblioteca').then((result)=>{
                    this.bibliotecas=result.data;
                    
                })
            }
            if (componentState.lastAction ==='AddItem') {
                this.submit = this.agregar;
                this.titleToShow = this.createTitle;
                $('#modalAgregar').modal('show');
                console.log(this.$v);
            }
            if (componentState.lastAction ==='EditItem') {
                this.submit = this.editarEstante;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem);
                $('#modalAgregar').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarEstante(componentState.selectedItem, componentState.selectedIndex);
            }
        },
        /*se dejo un solo metodo para el guardar un registro nuevo, aca es donde entra en
         *escena la variable del data isEditing*/
        guardar() {
            const estanteToSave = this.Estante;
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.isEditing)
                axios.put(`/Estante/${this.Estante.id}`, estanteToSave).then(res=>{
                    this.modoEditar = false;
                    this.isEditing = false;
                    this.success(msg);
                });
            else
                axios.post('/Estante', estanteToSave).then((res) =>{
                    this.success(msg);
                });
            this.Estante = {id: '', ESTANTE: '', ID_BIBLIOTECA:''};
            $("#modalAgregar").modal('hide');
        },
        editarFormulario(item){
        this.Estante.ESTANTE = item.data.ESTANTE;
        this.Estante.ID_BIBLIOTECA = item.data.ID_BIBLIOTECA;
        this.Estante.id = item.data.id;
        this.isEditing = true;
        this.modoEditar = true;
        },
        eliminarEstante(Estante, index){
            // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
            const confirmacion = confirm(`¿Esta seguro de eliminar "Estante ${Estante.data.ESTANTE}"?`);
            if(confirmacion){
                axios.delete(`/Estante/${Estante.data.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
                    console.log("ESTANTE ELIMINADO");
                })
            }
        },
        cancelarEdicion(){
            this.modoEditar = false;
            this.isEditing = false;
            this.Estante = {id: '', ESTANTE: '', ID_BIBLIOTECA:''};
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
