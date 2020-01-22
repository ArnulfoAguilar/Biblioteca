<template>

    <div class="card">
        <div class="card-header bg-dark">
            <h3>Observaciones</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row ">

                    <div v-if="rol == 1 || rol == 3 || rol == 4" class="col-sm-12 mb-3">
                        <form @submit.prevent="editarRevision(Revision)" v-if="modoEditar">
                            <label for="NOMBRE">Nueva Observación:</label>
                            
                            <div class="row">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-7" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                <div class="col-md-2">
                                        <input type="checkbox" class="col-md-2" id="check_titulo" v-model="check">
                                        <label class="form-check-label" for="exampleCheck1">Solventado</label>
                                
                                </div>
                                <div class="row col-md-3">
                                    <button class="btn btn-success col-md-6" type="submit">Guardar</button>
                                    <button class="btn btn-danger col-md-6" type="submit" 
                                    @click="cancelarEdicion">Cancelar</button>
                                </div>
                                
                            </div>

                        </form>
                        <form @submit.prevent="agregar" v-else >
                            <label for="NOMBRE">Nueva Observación:</label>
                            <div class="input-group">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-10" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                <button class="btn btn-primary" type="submit">Agregar Observación</button>
                            </div>
                        </form>
                                
                    </div>
                    
                    <div class=" col sm-12">
                        <label for="">Lista de Observaciones:</label>
                        <div class="tab-pane active" id="timeline">
                            <!-- The timeline -->
                            <ul class="timeline timeline-inverse">
                                <!-- timeline time label -->
                                <!-- <li class="time-label">
                                <span class="bg-danger">
                                   Creado el {{this.aporte_local[0].created_at}} 
                                </span>
                                </li> -->
                                <!-- /.timeline-label -->
                                <!-- timeline item -->
                                <li v-for="(item, index) in revisiones" :key="index">
                                    <i class="fas fa-check-circle bg-success" v-if="item.ID_ESTADO_REVISION == 1"></i>
                                    <i class="fas fa-eye bg-warning" v-else></i>
            
                                    <div class="timeline-item">
                                        <span class="time"><i class="far fa-clock"></i> {{item.created_at}}</span>
                                        
                                        <div class="timeline-header">
                                            <div v-for="(user, index) in usuarios" :key="index">
                                                <div v-if="user.id == item.ID_USUARIO">
                                                    <p  v-if="item.ID_ESTADO_REVISION == 1">Observación de <b >{{user.name}}</b> solventada</p>
                                                    <p  v-else><b>{{user.name}}</b> hizo una observación</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="timeline-body">
                                            {{item.DETALLE_REVISION}}
                                        </div>
                                        <div class="timeline-footer" v-if="usuario == item.ID_USUARIO && item.ID_ESTADO_REVISION == 2">
                                            <a href="#" class="btn btn-primary btn-sm" @click="editarFormulario(item)" >Editar</a>
                                            <a href="#" class="btn btn-danger btn-sm" @click="eliminarRevision(item, index)" >Eliminar</a>
                                        </div>
                                    </div>
                                </li>
                                <!-- END timeline item -->
                                

                                <li>
              <i class="far fa-clock bg-gray"></i>
              <div class="timeline-item">
                <div class="timeline-header bg-gray" v-if="revisiones < 1">
                  No hay revisiones
                </div>
                <div class="timeline-header bg-gray" v-else>
                  Fin de las revisiones
                </div>
              </div>
            </li>




                            </ul>
                        </div>
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
        </div>
    </div>

    
</template>


<script>
    export default {
        
        mounted() {
            console.log('Revisiones mounted.')
        },
        props: ['aporte','area', 'rol', 'usuario'],
        data() {
            return {
                // search:'',
                usuarios:'',
                aporte_local:'',
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
                axios.get('/aporte/obtener?id='+this.aporte).then(res=>{
                    this.aporte_local = res.data;                  
                })
                axios.get('/users').then(res=>{
                    this.usuarios = res.data;                   
                })
                axios.get('/revisiones?id='+this.aporte).then(res=>{
                    this.revisiones = res.data;                
                })
               
            },

            agregar() {
                const revisionNueva = this.Revision;
                axios.post('/revisiones', revisionNueva)
                    .then((response) =>{
                       
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.success('Revisión guardada correctamente', 'Exito');
                        
                        this.Revision= { id:'', DETALLE_REVISION: '', ID_ESTADO_REVISION:'', ID_COMITE:this.area, ID_APORTE:this.aporte , ID_USUARIO:''};
                        this.check='';
                        this.cargar();

                
                    }).catch(e=>{
                        console.log(e);
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

            orderedRevisiones: function () {
                return _.orderBy(this.revisiones, 'created_at')
            },
                
        }
    }
</script>