<template>
    <div>
        <JDTable
            :option="tableData.tableOptions"
            :loader="tableData.tableLoader"
            :event-from-app="tableData.eventFromApp"
            :event-from-app-trigger="tableData.eventFromAppTrigger"
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
                                <label for="NOMBRE">Palabra</label><b v-if="!$v.PalabraProhibida.PALABRA.required" class="error">*</b>
                                <input type="text" v-model.lazy="$v.PalabraProhibida.$model.PALABRA" class="form-control" id="PALABRA" autocomplete="off" maxlength="255"
                                    aria-describedby="emailHelp">

                            </div>
                            <div class="row text-center">
                                <div class="col-md-12 text-center">
                                    <b class="error">*Campos obligatorios</b>
                                </div>
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
            tableData:{
                tableOptions:{},
                tableLoader: false,
                eventFromAppTrigger: false,
                eventFromApp : {
                    name: null,
                    payload: null
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
            },
            /*isEditing nos hace la distincion si se esta editando o
             *ingresando un nuevo registro, y los titulos son los
             *del modal segun la situacion*/
            search:'',
            palabrasProhibidas: [],
            PalabraProhibida: { id:'', PALABRA: ''},

            isEditing: false,
            createTitle: 'Agregar Palabra',
            editTitle: 'Editar Palabra',
            titleToShow: ''
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
        this.tableData.tableOptions = {
            columns: this.tableData.columns,
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
       $('#modalAgregar').on('hide.bs.modal',this.cancelarEdicion);
    },
    methods:{
        sendData(){
            this.tableData.tableLoader = true;
            axios.get('/getPalabras').then(res=>{
                this.palabrasProhibidas = res.data;
                this.tableData.eventFromApp = {
                    name: 'sendData',
                    payload: this.palabrasProhibidas
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
                axios.get('/palabraProhibida').then((result)=>{
                    this.palabrasProhibidas=result.data;
                    this.tableData.eventFromApp = {
                        name: 'sendData',
                        payload: this.palabrasProhibidas
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
                this.submit = this.editarPalabra;
                this.titleToShow = this.editTitle;
                this.editarFormulario(componentState.selectedItem.data);
                $('#modalAgregar').modal('show');
            }
            if (componentState.lastAction ==='DeleteItem') {
                this.eliminarPalabra(componentState.selectedItem.data, componentState.selectedIndex);
            }
        },
        guardar() {
            const palabraToSave = this.PalabraProhibida;
            const msg = (this.isEditing) ?'Editado correctamente': 'Agregado correctamente';
            if(this.isEditing)
                axios.put(`/palabraProhibida/${this.PalabraProhibida.id}`, palabraToSave).then(res=>{
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
        eliminarPalabra(PalabraProhibida, index){
            /*this.$swal(
                {
                  title: '¿Estas seguro?',
                  text: "¡Esta acción no se puede revertir!",
                  icon: 'warning',
                   buttons: {
                      cancel: true,
                      confirm: true,
                    },
                }).then((value) => {
                  if (value) {
                    swal(
                      'Otro mensaje',
                      'Aca programe otra cosa joven',
                      'success'
                    )
                  }
                }
              );*/
            const confirmacion = confirm(`¿Esta seguro de eliminar "Palabra ${PalabraProhibida.PALABRA}"?`);
            if(confirmacion){
                axios.delete(`/palabraProhibida/${PalabraProhibida.id}`)
                .then(()=>{
                    toastr.clear();
                    this.sendData();
                    toastr.options.closeButton = true;
                    toastr.success('Eliminado correctamente', 'Exito');
                })
            }
        },
        cancelarEdicion(){
            this.PalabraProhibida = {id: '', PALABRA: ''};
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
