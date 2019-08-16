<template>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 mb-3">
                <!-- <div class="card"> -->
                    <!-- <div class="card-header">Información de la Biblioteca</div> -->
                    <!-- <div class="card-body"> -->
                        <form @submit.prevent="editarRevision(Revision)" v-if="modoEditar">
                            <label for="NOMBRE">Nueva Observación:</label>
                            <div class="input-group">
                                <input type="text" v-model="Revision.DETALLE_REVISION" class="form-control col-md-8" id="NOMBRE"
                                    placeholder="Escriba aca la nueva Observación..." required>
                                <button class="btn btn-success col-md-2" type="submit">Editar Observación</button>
                                <button class="btn btn-danger col-md-2" type="submit" 
                                    @click="cancelarEdicion">Cancelar edición</button>
                            </div>
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

                        <ul class="list-group">
                            <li class="list-group-item" v-for="(item, index) in revisiones" :key="index" >
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="mb-0">Observación: {{item.DETALLE_REVISION}}</p>
                                    </div>
                                    <div>
                                        <p class="mb-0">
                                            <button class="btn btn-warning btn-sm" 
                                            @click="editarFormulario(item)">Editar</button>
                                            <button class="btn btn-danger btn-sm" 
                                            @click="eliminarRevision(item, index)">Eliminar</button>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>

                    <!-- </div> -->
                <!-- </div> -->
            </div>

        </div>
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
                revisiones: [],
                modoEditar: false,
                Revision: { id:'', DETALLE_REVISION: '', ID_ESTADO_REVISION:'1', ID_COMITE:this.area, ID_APORTE:this.aporte , ID_USUARIO:''},
            }
        },
        created(){
            this.cargar()
        },
        methods: {
            cargar(){
                axios.get('/revisiones').then(res=>{
                this.revisiones = res.data;
                })
                console.log('Datos leidos');
            },

            agregar() {
                const revisionNueva = this.Revision;
                axios.post('/revisiones', revisionNueva)
                    .then((response) =>{
                        alert("Guardado correctamente");
                        console.log("Guardado");
                        this.cargar();
                        this.Revision.DETALLE_REVISION = '';
                    
                    }).catch(e=>{
                            alert("Error al Guardar" + e);
                            })
            },

            editarFormulario(item){
            this.Revision.DETALLE_REVISION = item.DETALLE_REVISION;
            this.Revision.id = item.id
            this.modoEditar = true;
            },

            editarRevision(Revision){
            const parametros = {
                DETALLE_REVISION: Revision.DETALLE_REVISION,
                ID_ESTADO_REVISION:'1',
                ID_COMITE:this.area,
                ID_APORTE:this.aporte 
                };
            axios.put(`/revisiones/${Revision.id}`, parametros)
                .then(response=>{
                this.modoEditar = false;
                alert("Editado correctamente");
                console.log("Editado correctamente");
                this.cargar();
                })
            },

            eliminarRevision(Revision, index){
                const confirmacion = confirm(`¿Eliminar Revision ${Revision.DETALLE_REVISION}?`);
                if(confirmacion){
                    axios.delete(`/revisiones/${Revision.id}`)
                    .then(()=>{
                        //this.ejemplars.splice(index, 1);
                        alert("Revision ELIMINADO");
                        console.log("Revision ELIMINADO");
                        this.cargar();
                    })
                }
            },
            
            cancelarEdicion(){
                this.modoEditar = false;
                this.Biblioteca = {id: '', BIBLIOTECA: '',};
            }
        },
        // computed:{
        //     searchEjemplar: function(){
        //         return this.revisiones.filter((item) => 
        //             item.DETALLE_REVISION.includes(this.search) 
        //         );
        //     }
        // }
    }
</script>