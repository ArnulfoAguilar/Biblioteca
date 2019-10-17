<template>
  <div>
      <JDTable
            :option="tableData.tableOptions"
            :loader="tableData.tableLoader"
            :event-from-app="tableData.eventFromApp"
            :event-from-app-trigger="tableData.eventFromAppTrigger"
            @event-from-jd-table="processEventFromApp($event)"></JDTable>
        <iframe id="excelExportArea" style="display:none"></iframe>

        <div id="busqueda" style="display: none;">
            <buscar-material></buscar-material>
            <button  onclick="otroModal"></button>
        </div>
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
            tipoPrestamos:[],
            estadoPrestamos:[],
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
                //$('#modalForm').modal('show');
                bootbox.dialog({
                    title: this.createTitle,
                    message:$('#busqueda').html(),
                    onEscape: true,
                    size: 'extra-large'
                });

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
            const prestamoToSave = this.PRESTAMO;
            console.log(prestamoToSave.COPIAS);
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.isEditing)
                axios.put(`/biblioteca/prestamos/${this.PRESTAMO.id}`, prestamoToSave).then(res=>{
                    this.modoEditar = false;
                    this.success(msg);
                });
            else
                axios.post('/biblioteca/prestamos', prestamoToSave).then((res) =>{
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
        eliminarEjemplar(PRESTAMO, index){
            // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
            const confirmacion = confirm(`¿Esta seguro de eliminar este registro?`);
            if(confirmacion){
                axios.delete(`/biblioteca/prestamos/${PRESTAMO.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
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
        },
        otroModal(){
            debugger;
            bootbox.alert('segundo modal');
        }
    }
}
</script>

<style>

</style>
