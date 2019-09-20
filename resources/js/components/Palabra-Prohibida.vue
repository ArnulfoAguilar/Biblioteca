<template>
    <div>
        <JDTable
            :option="tableOptions"
            :loader="tableLoader"
            :event-from-app="eventFromApp"
            :event-from-app-trigger="eventFromAppTrigger"
            @event-from-jd-table="processEventFromApp($event)"></JDTable>
        <iframe id="excelExportArea" style="display:none"></iframe>

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
                                <label for="NOMBRE">Palabra</label>
                                <input type="text" v-model.lazy="PalabraProhibida.PALABRA" class="form-control" id="PALABRA"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.PalabraProhibida.PALABRA.required" class="error">Este campo es obligatorio</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar Palabra</button>
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
                    name:'PALABRA',
                    title:'Palabras Prohibidas',
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
            palabrasProhibidas: [],
            modoEditar: false,
            PalabraProhibida: { id:'', PALABRA: ''},

            isEditing: false,
            createTitle: 'Agregar Palabra',
            editTitle: 'Editar Palabra',
            titleToShow: '',
            hasError: false
        }
    },
    validations:{
        PalabraProhibida:{
            PALABRA:{
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
            axios.get('/palabraProhibida').then(res=>{
                this.palabrasProhibidas = res.data;
                this.eventFromApp = {
                    name: 'sendData',
                    payload: this.palabrasProhibidas
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
                axios.get('/palabraProhibida').then((result)=>{
                    this.bibliotecas=result.data;
                    this.eventFromApp = {
                        name: 'sendData',
                        payload: this.bibliotecas
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
                this.submit = this.editarBiblioteca;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem);
                $('#modalAgregar').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarBiblioteca(componentState.selectedItem, componentState.selectedIndex);
            }
        },
        /*se dejo un solo metodo para el guardar un registro nuevo, aca es donde entra en
         *escena la variable del data isEditing*/
        guardar() {
            const palabraToSave = this.PalabraProhibida;
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.isEditing)
                axios.put(`/palabraProhibida/${this.Biblioteca.id}`, bibliotecaToSave).then(res=>{
                    this.modoEditar = false;
                    this.success(msg);
                });
            else
                axios.post('/palabraProhibida', palabraToSave).then((res) =>{
                    this.success(msg);
                });
            this.PalabraProhibida = {id: '', PALABRA: ''};
            $("#modalAgregar").modal('hide');
        },
        editarFormulario(item){
        this.PalabraProhibida.PALABRA = item.PALABRA;
        this.PalabraProhibida.id = item.id;
        this.isEditing = true;
        },
        eliminarBiblioteca(Biblioteca, index){
            // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
            const confirmacion = confirm(`¿Esta seguro de eliminar "Palabra ${PalabraProhibida.PALABRA}"?`);
            if(confirmacion){
                axios.delete(`/palabraProhibida/${Biblioteca.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
                })
            }
        },
        cancelarEdicion(){
            this.modoEditar = false;
            this.Biblioteca = {id: '', BIBLIOTECA: ''};
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
