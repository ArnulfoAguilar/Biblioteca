<template>
<!--La onda esta asi xD: Como JDTable trae un monton de opciones, la idea seria usarlas para facilitarnos
    en cierta forma, solo que hay q leer la documentacion del plugin ese. Si ven, el template del componente
    solo tiene la tabla y un modal que seria el formulario para agregar un registro o editar un registro-->
    <div>
        <JDTable
            :option="tableOptions"
            :loader="tableLoader"
            :event-from-app="eventFromApp"
            :event-from-app-trigger="eventFromAppTrigger"
            @event-from-jd-table="processEventFromApp($event)"></JDTable>
        <iframe id="excelExportArea" style="display:none"></iframe>

        <!-- Modal para agregar-->
            <div id="modalAgregar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <form @submit.prevent="submit" >
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">{{titleToShow}}</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="NOMBRE">Nombre</label>
                                    <input type="text" v-model="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="3" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="ISBN">ISBN</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.ISBN" id="ISBN"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="AUTOR">AUTOR/es</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.AUTOR" id="AUTOR"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="PAGINAS">Numero de paginas</label>
                                        <input type="number" class="form-control" id="PAGINAS" v-model="EJEMPLAR.NUMERO_PAGINAS"
                                            aria-describedby="emailHelp" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="copias">Numero de copias</label>
                                        <input type="number" class="form-control" id="copias" v-model="EJEMPLAR.COPIAS"
                                            aria-describedby="emailHelp" required>
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
export default {
    data(){
        return {
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
            /*Aca comienzan las variables del modelo, las variables anteriores son de la tabla
            * despues profundizare esto*/
            search:'',
            ejemplars: [],
            modoEditar: false,
            EJEMPLAR: { EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:'', },
            isEditing: false,
            createTitle: 'Agregar Ejemplar',
            editTitle: 'Editar Ejemplar',
            titleToShow: '',
            submit: function(){}
        }
    },
    created(){
        this.tableOptions = {
            columns: this.columns,
            responsiveTable: true,
            addNew: true,
            editItem:true,
            deleteItem: true
        };
        this.sendData();
        console.log('componente creado')
    },
    mounted(){
        console.log('tabla montada')
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
        /*metodos del componente anterior. igual que en el data, lo anterior es codigo
        * de la tabla. no ha cambiado mucho, solo la forma de actualizar el contenido
        * que se va a listar despues de insertar un registro*/
        agregar() {
                const ejemplarNuevo = this.EJEMPLAR;
                this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
                axios.post('/ejemplars', ejemplarNuevo)
                    .then((res) =>{
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Agregado correctamente', 'Exito');
                    this.sendData();
                    console.log("Guardado");
                    $("#modalAgregar").modal('hide');
                    })
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
            editarEjemplar(EJEMPLAR){
            const params = {
                EJEMPLAR: EJEMPLAR.EJEMPLAR,
                DESCRIPCION: EJEMPLAR.DESCRIPCION,
                ISBN: EJEMPLAR.ISBN,
                AUTOR: EJEMPLAR.AUTOR,
                NUMERO_PAGINAS: EJEMPLAR.NUMERO_PAGINAS,
                COPIAS: EJEMPLAR.COPIAS
                };
            axios.put(`/ejemplars/${EJEMPLAR.id}`, params)
                .then(res=>{
                this.modoEditar = false;
                this.EJEMPLAR = {EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:''};
                this.sendData();
                // alert("Editado correctamente");
                console.log("Editado correctamente");
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.success('Editado correctamente', 'Exito');
                $("#modalEditar").modal('hide');
                })

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
            submitFunction(item){
                var submit;
                if (isEditing && item!==undefined) {
                    submit = this.editarEjemplar;
                } else {
                    submit = this.agregar;
                }
                return submit;
            }
    }

}
</script>

<style>

</style>
