<template>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 mb-3">
                <!-- <div class="card"> -->
                    <!-- <div class="card-header">Información de la Biblioteca</div> -->
                    <!-- <div class="card-body"> -->
                        <form @submit.prevent="editarRevision(Revision)" v-if="modoEditar">
                            <label for="NOMBRE">Nueva Observación:</label>
                            
                            <div class="row">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-7" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                <div class="col-md-2">
                                    <!-- <div v-if="Revision.ID_ESTADO_REVISION === 1"> -->
                                        <input type="checkbox" class="col-md-2" id="check_titulo" v-model="check">
                                        <label class="form-check-label" for="exampleCheck1">Solventado</label>
                                    <!-- </div> -->
                                    <!-- <div v-else>
                                        <input type="checkbox" class="col-md-2" id="check_titulo" v-model="check">
                                        <label class="form-check-label" for="exampleCheck1">Pendiente</label>
                                    </div> -->
                                </div>
                                <div class="row col-md-3">
                                    <button class="btn btn-success col-md-6" type="submit">Guardar</button>
                                    <button class="btn btn-danger col-md-6" type="submit" 
                                    @click="cancelarEdicion">Cancelar</button>
                                </div>
                                
                            </div>

                            <!-- <div class="input-group">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-8" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                <button class="btn btn-success col-md-2" type="submit">Editar Observación</button>
                                <button class="btn btn-danger col-md-2" type="submit" 
                                    @click="cancelarEdicion">Cancelar edición</button>
                            </div> -->

                            <!-- <div class="input-group">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-8" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                
                                <div class="row col-md-4">
                                    <button class="btn btn-success col-md-6" type="submit">Editar Observación</button>
                                    <button class="btn btn-danger col-md-6" type="submit" 
                                    @click="cancelarEdicion">Cancelar edición</button>
                                </div>
                            </div> -->

                        </form>
                        <form @submit.prevent="agregar" v-else>
                            <label for="NOMBRE">Nueva Observación:</label>
                            <div class="input-group">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-10" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                <button class="btn btn-primary" type="submit">Agregar Observación</button>
                                <!-- <input type="text" v-model="Revision.ID_APORTE"> -->
                            </div>
                        </form>

                        
                    <!-- </div> -->
                <!-- </div> -->
            </div>

            <div class=" col sm-12">
                <!-- <div class="card"> -->
                    <!-- <div class="card-header"> -->
                        <label for="">Lista de Observaciones:</label>
                        <!-- <input class="float-right" placeholder="Buscar por nombre..." v-model="search"> -->
                    <!-- </div> -->
                    <!-- <div class="card-body"> -->

                        <!-- <ul class="list-group" v-for="(item, index) in revisiones" :key="index">
                            <li class="list-group-item ">
                                <div class="d-flex justify-content-between">
                                    <div class="col-md-8">
                                        <p class="mb-0">{{item.DETALLE_REVISION}}</p>
                                    </div>
                                    <div class="col-md-2 form-check ">
                                        <div v-if="item.ID_ESTADO_REVISION === 1">
                                            <label class="form-check-label" for="exampleCheck1">Solventado</label>
                                        </div>
                                        <div v-else>
                                            <label class="form-check-label" for="exampleCheck1">Pendiente</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <p class="mb-0">
                                            <button class="btn btn-warning btn-sm" 
                                            @click="editarFormulario(item)">Editar</button>
                                            <button class="btn btn-danger btn-sm" 
                                            @click="eliminarRevision(item, index)">Eliminar</button>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul> -->

                        <div class="tab-pane active" id="timeline">
                                <!-- The timeline -->
                                <ul class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <li class="time-label">
                                    <span class="bg-danger">
                                        11 Feb. 2014
                                    </span>
                                    </li>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <li v-for="(item, index) in orderedRevisiones" :key="index">
                                        <i class="fas fa-check-circle bg-success" v-if="item.ID_ESTADO_REVISION === 1"></i>
                                        <i class="fas fa-eye bg-warning" v-else></i>
                
                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> {{item.created_at}}</span>
                
                                            <h3 class="timeline-header" v-if="item.ID_ESTADO_REVISION === 1">Corrección de <a href="">Ejemplo</a> solventada</h3>
                                            <h3 class="timeline-header" v-else><a href="">Ejemplo</a> Te hizo una corrección</h3>
                
                                            <div class="timeline-body">
                                            {{item.DETALLE_REVISION}}
                                            </div>
                                            <div class="timeline-footer">
                                            <a href="#" class="btn btn-primary btn-sm" @click="editarFormulario(item)">Editar</a>
                                            <a href="#" class="btn btn-danger btn-sm" @click="eliminarRevision(item, index)">Eliminar</a>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- END timeline item -->
                                    <li>
                                    <i class="far fa-clock bg-gray"></i>
                                    </li>
                                </ul>
                            </div>

                    <!-- </div> -->
                <!-- </div> -->
            </div>

        </div>
<!-- Datos del componente VUE -->
        <!-- <div class="row">
            <div class="col-md-12 bg-warning">
                <pre>{{ $data }}</pre>
            </div>
        </div> -->
<!-- Datos del componente VUE -->
    </div>
</template>


<script>
    export default {
        
        mounted() {
            console.log('Revisiones mounted.')
        },
        props: ['aporte','area'],
        data() {
            return {
                // search:'',
                check:'',
                revisiones: [],
                modoEditar: false,
                Revision: { id:'', DETALLE_REVISION: '', ID_ESTADO_REVISION:'', ID_COMITE:this.area, ID_APORTE:this.aporte , ID_USUARIO:''},
            }
        },
        created(){
            this.cargar()
        },
        methods: {
            cargar(){
                axios.get('/revisiones?id='+this.aporte).then(res=>{
                this.revisiones = res.data;
                console.log(res.data);
                })
                console.log('Datos leidos');
            },

            agregar() {
                const revisionNueva = this.Revision;
                axios.post('/revisiones', revisionNueva)
                    .then((response) =>{
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.success('Revisión guardada correctamente', 'Exito');
                        console.log("Guardado");
                        this.Revision= { id:'', DETALLE_REVISION: '', ID_ESTADO_REVISION:'', ID_COMITE:this.area, ID_APORTE:this.aporte , ID_USUARIO:''};
                        this.check='';
                        this.cargar();

                    
                    }).catch(e=>{
                            alert("Error al Guardar" + e);
                            })
            },

            editarFormulario(item){
                this.Revision.id = item.id
                this.Revision.DETALLE_REVISION = item.DETALLE_REVISION;
                    if(item.ID_ESTADO_REVISION == 1){
                        this.check = true 
                    }else{
                        this.check = false
                    }
                this.Revision.ID_ESTADO_REVISION = this.check;
                this.Revision.ID_COMITE = this.area;
                this.Revision.ID_APORTE = this.aporte;
                this.Revision.ID_USUARIO = '';
                this.modoEditar = true;
            },

            editarRevision(Revision){
                
            const parametros = {
                DETALLE_REVISION: Revision.DETALLE_REVISION,
                ID_ESTADO_REVISION: this.check,
                ID_COMITE: Revision.ID_COMITE,
                ID_APORTE: Revision.ID_APORTE, 
                ID_USUARIO: Revision.ID_USUARIO
                };
                
            axios.put(`/revisiones/${Revision.id}`, parametros)
                .then(response=>{
                this.modoEditar = false;
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.success('Revisión Editada correctamente', 'Exito');
                console.log("Editado correctamente");
                this.Revision= { id:'', DETALLE_REVISION: '', ID_ESTADO_REVISION:'', ID_COMITE:this.area, ID_APORTE:this.aporte , ID_USUARIO:''};
                this.check='';
                this.cargar();
                })
            },

            eliminarRevision(Revision, index){
                const confirmacion = confirm(`¿Eliminar Revision ${Revision.DETALLE_REVISION}?`);
                if(confirmacion){
                    axios.delete(`/revisiones/${Revision.id}`)
                    .then(()=>{
                        //this.ejemplars.splice(index, 1);
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.success('Revisión ELIMINADA', 'Exito');
                        console.log("Revision ELIMINADO");
                        this.cargar();
                    })
                }
            },
            
            cancelarEdicion(){
                this.modoEditar = false;
                this.Revision= { id:'', DETALLE_REVISION: '', ID_ESTADO_REVISION:'', ID_COMITE:this.area, ID_APORTE:this.aporte , ID_USUARIO:''};
                this.check='';
            }
        },
        computed:{
            // checked: {
            //     get: function(){
            //         if(this.Revision.ID_ESTADO_REVISION == 1){
            //             this.check = false;
            //         }else{
            //             this.check = true;
            //         }
            //         return this.check;
            //     },
            //     set: function (newValue) {
            //         this.check = newValue
            //     }
            // },
            orderedRevisiones: function () {
                return _.orderBy(this.revisiones, 'created_at')
            },
                
        }
    }
</script>