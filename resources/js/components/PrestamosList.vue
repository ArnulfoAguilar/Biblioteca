<template>
  <div>
      <JDTable
            :option="tableData.tableOptions"
            :loader="tableData.tableLoader"
            :event-from-app="tableData.eventFromApp"
            :event-from-app-trigger="tableData.eventFromAppTrigger"
            @event-from-jd-table="processEventFromApp($event)"></JDTable>
        <iframe id="excelExportArea" style="display:none"></iframe>

        <!-- Modal con el formulario para agregar un nuevo libro o editar uno existente
        <div id="modalForm" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                Modal content
                <form @submit.prevent="submitHandler($v.$invalid)" >
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">{{titleToShow}}</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="LUGAR_EDICION">Lugar Edición</label>
                                    <input type="text" class="form-control" v-model="EJEMPLAR.LUGAR_EDICION" id="LUGAR_EDICION"
                                        aria-describedby="emailHelp">
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="CATALOGO_MATERIAL">Tipo de material</label>
                                    <div>
                                        <select2 :options="catalogoMaterial" :value="EJEMPLAR.CATALOGO_MATERIAL" v-model="EJEMPLAR.CATALOGO_MATERIAL"></select2>
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
        fin modal agregar -->
  </div>
</template>

<script>
export default {
    data(){
        return{
            tableData:{
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
                    name:'ESTADO_PRESTAMO',
                    title:'Estado préstamo',
                    order: 2,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'name',
                    title:'Solicitado por',
                    order: 3,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: true
                },
                {
                    name:'FECHA_PRESTAMO',
                    title:'Fecha de préstamo',
                    order: 3,
                    sort: true,
                    type: 'string',
                    filterable: true,
                    enabled: false
                }
                ]
            },
            PRESTAMO:{
                FECHA_PRESTAMO:'',
                ID_USUARIO:'',
                ID_DESPACHO:'',
                ID_ESTADO_PRESTAMO:'',
                ID_MATERIAL:''
            },
            prestamos: [],
            isEditing: false,
            createTitle: 'Agregar Ejemplar',
            editTitle: 'Editar Ejemplar',
            titleToShow: ''
        }
    },
    //vuelidate
    created(){
        this.tableData.tableOptions = {
            columns: this.tableData.columns,
            responsiveTable: true,
            contextMenuRight: true,
            contextMenuAdd: false,
            contextMenuView: false,
            quickView: 0,
            addNew: true,
            //deleteItem: true
        };
        this.sendData();
    },
    mounted(){
        $('#modalForm').on('hide.bs.modal',this.vaciarModelo);
    },
    methods:{
        sendData(){
            this.tableData.tableLoader = true;
            axios.get('/biblioteca/prestamos').then(res=>{
                this.prestamos=res.data;
                this.tableData.eventFromApp = {
                    name: 'sendData',
                    payload: this.prestamos
                };
            this.triggerEvent();
            this.tableData.tableLoader = false;
            });
        },
        triggerEvent(){
            this.tableData.eventFromAppTrigger = true;
            this.$nextTick(()=>{
                this.tableData.eventFromAppTrigger = false;
            });
        },
        processEventFromApp(componentState){
            if(componentState.lastAction === 'Refresh'){
                axios.get('/biblioteca/prestamos').then((result)=>{
                    this.prestamos=result.data;
                    this.tableData.eventFromApp = {
                        name: 'sendData',
                        payload: this.prestamos
                    };
                    this.triggerEvent();
                })
            }
            if (componentState.lastAction ==='AddItem') {
                this.submit = this.agregar;
                this.titleToShow = this.createTitle;
                $('#modalForm').modal('show');

            }
            if (componentState.lastAction ==='EditItem') {
                this.submit = this.editarEjemplar;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem);
                $('#modalForm').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarEjemplar(componentState.selectedItem, componentState.selectedIndex);
            }
        },
        guardar() {
            const ejemplarToSave = this.EJEMPLAR;
            console.log(ejemplarToSave.COPIAS);
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
        this.PRESTAMO.FECHA_PRESTAMO=item.FECHA_PRESTAMO;
        this.PRESTAMO.ID_USUARIO=item.ID_USUARIO;
        this.PRESTAMO.ID_DESPACHO=item.ID_DESPACHO
        this.PRESTAMO.ID_ESTADO_PRESTAMO=item.ID_ESTADO_PRESTAMO;
        this.PRESTAMO.ID_MATERIAL=item.ID_MATERIAL;
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
        vaciarModelo(){
            this.PRESTAMO={
                FECHA_PRESTAMO:'',
                ID_USUARIO:'',
                ID_DESPACHO:'',
                ID_ESTADO_PRESTAMO:'',
                ID_MATERIAL:''
            };
        },
        success(msg){
            this.sendData();
            toastr.clear();
            toastr.options.closeButton = true;
            toastr.success(msg, 'Exito');
        },
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
