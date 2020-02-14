<template>
  <div>
      <JDTable
            :option="tableData.tableOptions"
            :loader="tableData.tableLoader"
            :event-from-app="tableData.eventFromApp"
            :event-from-app-trigger="tableData.eventFromAppTrigger"
            @event-from-jd-table="processEventFromApp($event)"></JDTable>
        <iframe id="excelExportArea" style="display:none"></iframe>

        <bootbox-modal v-if="modalShowFlag" @close="modalClosing(true)" :title="titleToShow" :size="'extra-large'">
            <buscar-material :isBibliotecario="true"></buscar-material>
        </bootbox-modal>

        <bootbox-modal v-if="formShowFlag" @close="modalClosing(false)" :title="'Confirmar préstamo'">
          <prestamo-form :is-bibliotecario="true" :material="PRESTAMO" @close="modalClosingAfterSubmit"></prestamo-form>
        </bootbox-modal>
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
                        order: 4,
                        sort: true,
                        type: 'string',
                        filterable: true,
                        enabled: false
                    }
                ]
            },
            PRESTAMO:{},
            tipoPrestamos:[],
            estadoPrestamos:[],
            prestamos: [],
            isEditing: false,
            createTitle: 'Agregar Ejemplar',
            editTitle: 'Editar Ejemplar',
            titleToShow: '',
            modalShowFlag: false,
            formShowFlag: false
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
                this.modalShowFlag = true

            }
            if (componentState.lastAction ==='EditItem') {
                this.submit = this.editarEjemplar;
                this.titleToShow = this.editTitle;
                this.PRESTAMO=componentState.selectedItem;
                this.formShowFlag = true;
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarPrestamo(componentState.selectedItem, componentState.selectedIndex);
            }
        },
        eliminarPrestamo(PRESTAMO, index){
            // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
            const confirmacion = confirm(`¿Esta seguro de eliminar este registro?`);
            if(confirmacion){
                axios.delete(`/biblioteca/prestamos/${PRESTAMO.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Éxito');
                })
            }
        },
        modalClosing(flag){
            if(flag)
                this.modalShowFlag = false;
            else
                this.formShowFlag = false;
        },
        modalClosingAfterSubmit(){
            this.prestamos=[];
            this.sendData();
            this.formShowFlag = false;
        },
    }
}
</script>

<style>

</style>
