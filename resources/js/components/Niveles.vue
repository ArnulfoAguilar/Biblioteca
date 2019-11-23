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
                                <input type="text" v-model.lazy="Nivel.NIVEL" class="form-control" id="NIVEL"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.Nivel.NIVEL.required" class="error">Este campo es obligatorio</div>
                            </div>
                            <div class="form-group">
                                <label for="NOMBRE">Puntaje Minimo</label>
                                <input type="text" v-model.lazy="Nivel.PUNTAJE_MINIMO" class="form-control" id="PUNTAJE_MINIMO"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.Nivel.PUNTAJE_MINIMO.required" class="error">Este campo es obligatorio</div>
                            </div>
                            <div class="form-group">
                                <label for="NOMBRE">Badge</label>
                                <input type="text" v-model.lazy="Nivel.BADGE" class="form-control" id="BADGE"
                                    aria-describedby="emailHelp">
                                <div v-if="!$v.Nivel.BADGE.required" class="error">Este campo es obligatorio</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Guardar Puntuación</button>
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
                    name:'NIVEL',
                    title:'NIVEL',
                    order: 1,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'PUNTAJE_MINIMO',
                    title:'PUNTAJE MINIMO',
                    order: 1,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'BADGE',
                    title:'MEDALLA',
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
            niveles: [],
            modoEditar: false,
            Nivel: { id:'', NIVEL: '', PUNTAJE_MINIMO:'',BADGE:''},

            isEditing: false,
            createTitle: 'Agregar Nivel',
            editTitle: 'Editar Nivel',
            titleToShow: '',
            hasError: false
        }
    },
    validations:{
        Nivel:{
            NIVEL:{
                required
            },
            PUNTAJE_MINIMO:{
                required
            },
            BADGE:{
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
            axios.get('/Niveles').then(res=>{
                this.niveles = res.data;
                this.eventFromApp = {
                    name: 'sendData',
                    payload: this.niveles
                };
            this.triggerEvent();
            this.tableLoader = false;
            console.log(this.niveles);
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
                axios.get('/Niveles').then((result)=>{
                    this.niveles=result.data;
                    this.eventFromApp = {
                        name: 'sendData',
                        payload: this.niveles
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
                this.submit = this.editarNivel;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem);
                $('#modalAgregar').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarNivel(componentState.selectedItem, componentState.selectedIndex);
            }
        },
        /*se dejo un solo metodo para el guardar un registro nuevo, aca es donde entra en
         *escena la variable del data isEditing*/
        guardar() {
            const NivelSave = this.Nivel;
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.isEditing)
                axios.put(`/Niveles/${this.Nivel.id}`, NivelSave).then(res=>{
                    this.modoEditar = false;
                    this.success(msg);
                });
            else
                axios.post('/Niveles', NivelSave).then((res) =>{
                    this.success(msg);
                });
            this.Puntuacion = {id: '', PUNTUACION: '',VALOR:''};
            $("#modalAgregar").modal('hide');
        },
        editarFormulario(item){
        this.Nivel.NIVEL = item.NIVEL;
        this.Nivel.id = item.id;
        this.Nivel.PUNTAJE_MINIMO = item.PUNTAJE_MINIMO;
        this.Nivel.BADGE = item.BADGE;
        this.isEditing = true;
        },
        eliminarNivel(Nivel, index){
            const confirmacion = confirm(`¿Esta seguro de eliminar "Nivel ${Nivel.NIVEL}"?`);
            if(confirmacion){
                axios.delete(`/Niveles/${Nivel.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
                    console.log("Nivel ELIMINADO");
                })
            }
        },
        cancelarEdicion(){
            this.modoEditar = false;
            this.Nivel = {id: '', NIVEL: '', PUNTAJE_MINIMO: '', BADGE: ''};
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
