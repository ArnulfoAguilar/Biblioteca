<template>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 mb-3">
                <!-- <div class="card"> -->
                    <!-- <div class="card-header">Información de la Biblioteca</div> -->
                    <!-- <div class="card-body"> -->
                        <form @submit.prevent="editarUsuario(usuario)" v-if="modoEditar">
                            <label for="NOMBRE">Editar Asignacion de Comite:</label>
                            <div class="input-group">
                                <input type="text" v-model="usuario.name" class="form-control col-md-6" id="NOMBRE"
                                    placeholder="Seleccione un usuario..." required disabled> 
                                    <select class="form-control col-md-4" v-model="usuario.ID_COMITE">
                                        <option disabled value="">Por favor seleccione una</option>
                                        <option v-for="(item, index) in comites" :key="index" v-bind:value="item.id">
                                        {{ item.COMITE }}
                                        </option>
                                    </select>
                                <div class="row col-md-3">
                                    <button class="btn btn-success col-md-6" type="submit">Guardar</button>
                                    <button class="btn btn-danger col-md-6" type="submit" 
                                    @click="cancelarEdicion">Cancelar</button>
                                </div>
                            </div>
                        </form>
                        <form @submit.prevent="agregar" v-else>
                            <label for="NOMBRE">Editar Asignacion de Comite:</label>
                            <div class="input-group">
                                <input type="text" v-model="usuario.name" class="form-control col-md-6" id="NOMBRE"
                                    placeholder="Seleccione un usuario..." required disabled> 
                                    <select class="form-control col-md-4" v-model="usuario.ID_COMITE" disabled>
                                        <option disabled value="">Por favor seleccione una</option>
                                        <option v-for="(item, index) in comites" :key="index" v-bind:value="item.id">
                                        {{ item.COMITE }}
                                        </option>
                                    </select>
                                <div class="row col-md-3">
                                    <button class="btn btn-success col-md-6" type="submit" disabled>Guardar</button>
                                    <button class="btn btn-danger col-md-6" type="submit" 
                                    @click="cancelarEdicion" disabled>Cancelar</button>
                                </div>
                            </div>
                        </form>

                        
                    <!-- </div> -->
                <!-- </div> -->
            </div>

            <div class="col col-12">
                <div class="card">
                    <div class="card-header bg-dark">
                        Usuarios
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Comite</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in usuarios" :key="index">
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.name}}</td>
                                <td>{{item.email}}</td>
                                <div v-for="(comite, index) in comites" :key="index">
                                    <td v-if="comite.id == item.ID_COMITE">
                                        {{comite.COMITE}}
                                    </td>
                                </div>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" @click="editarFormulario(item)">Asignar Comite</a>
                                </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
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
</template>


<script>
    export default {
        
        mounted() {
            console.log('Asigancion de comites mounted.')
        },
        data() {
            return {
                // search:'',
                modoEditar: false,
                //NUEVO
                usuario: {id:'', name:'', email:'', ID_ROL:'', ID_COMITE:'',},
                usuarios: [],
                comites:[],
            }
        },
        created(){
            this.cargar()
        },
        methods: {
            cargar(){
                axios.get('/users').then(res=>{
                    this.usuarios = res.data;
                });
                axios.get('/comites').then(res=>{
                    this.comites = res.data;
                });
            },

            

            editarFormulario(item){
                this.usuario.id = item.id
                this.usuario.name = item.name;
                this.usuario.email = item.email;
                this.usuario.ID_ROL = item.ID_ROL;
                this.usuario.ID_COMITE = item.ID_COMITE;
                this.modoEditar = true;
            },

            editarUsuario(usuario){
                
            const parametros = {
                id: usuario.id,
                ID_COMITE: usuario.ID_COMITE,
                };
                
            axios.post('/administracion/asignar/comite', parametros)
                .then(response=>{
                    this.modoEditar = false;
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Comite asignado correctamente', 'Exito');
                    console.log("Editado correctamente");
                    this.usuario= {id:'', name:'', email:'', ID_ROL:'', ID_COMITE:''};
                    this.cargar();
                })
            },
            
            cancelarEdicion(){
                this.modoEditar = false;
                this.usuario= {id:'', name:'', email:'', ID_ROL:'', ID_COMITE:''};
                this.check='';
            }
        },
        computed:{
                RolUsuario: function (user) {
                    var rolito='Nada';
                    console.log(rolito, user);
                    this.comites.forEach(element => {
                        if (user.ID_ROL === element.id) {
                            rolito = element.name
                            console.log(element);
                        }
                    });
                    return rolito
                }
        }
    }
</script>