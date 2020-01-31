<template>
    <div class="container-fluid">
        <div class="row ">
            <div class="col-sm-12 mb-3">
                <!-- <div class="card"> -->
                    <!-- <div class="card-header">Información de la Biblioteca</div> -->
                    <!-- <div class="card-body"> -->
                        <form @submit.prevent="editarUsuario(usuario)" v-if="modoEditar">
                            <label for="NOMBRE">Editar Asignacion de Rol:</label>
                            <div class="input-group">
                                <input type="text" v-model="usuario.name" class="form-control col-md-6" id="NOMBRE"
                                    placeholder="Seleccione un usuario..." required disabled> 
                                    <select class="form-control col-md-4" v-model="usuario.ID_ROL">
                                        <option disabled value="">Por favor seleccione una</option>
                                        <option v-for="(item, index) in roles" :key="index" v-bind:value="item.id">
                                        {{ item.ROL }}
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
                            <label for="NOMBRE">Editar Asignacion de Rol:</label>
                            <div class="input-group">
                                <input type="text" v-model="usuario.name" class="form-control col-md-6" id="NOMBRE"
                                    placeholder="Seleccione un usuario..." required disabled> 
                                    <select class="form-control col-md-4" v-model="usuario.ID_ROL" disabled>
                                        <option disabled value="">Por favor seleccione una</option>
                                        <option v-for="(item, index) in roles" :key="index" v-bind:value="item.id">
                                        {{ item.ROL }}
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
                    <div class="card-header bg-dark d-flex justify-content-between">
                        <div class="card-title">Usuarios</div>
                        <div class="card-options">
                            <input type="text" placeholder="Buscar" class="form-control" v-model="name">
                        </div>
                        
                    </div>
                    
                    <div class="card-body">
                        <table class="table table-hover" id="usuarios">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in searchUsuarios" :key="index">
                                <th scope="row">{{item.id}}</th>
                                <td>{{item.name}}</td>
                                <td>{{item.email}}</td>
                                <div v-for="(rol, index) in roles" :key="index">
                                    <td v-if="rol.id == item.ID_ROL">
                                        {{rol.ROL}}
                                    </td>
                                </div>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm" @click="editarFormulario(item)">Asignar Rol</a>
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
            console.log('Asigancion de roles mounted.')
        },
        data() {
            return {
                // search:'',
                modoEditar: false,
                //NUEVO
                usuarios: [],
                roles:[],
                usuario: {id:'', name:'', email:'', ID_ROL:''},
                name: '',
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
                axios.get('/roles').then(res=>{
                    this.roles = res.data;
                });
            },

            

            editarFormulario(item){
                this.usuario.id = item.id
                this.usuario.name = item.name;
                this.usuario.email = item.email;
                this.usuario.ID_ROL = item.ID_ROL;
                this.modoEditar = true;
            },

            editarUsuario(usuario){
                
            const parametros = {
                id: usuario.id,
                ID_ROL: usuario.ID_ROL,
                };
                
            axios.post('/administracion/asignar/rol', parametros)
                .then(response=>{
                    this.modoEditar = false;
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Rol asignado correctamente', 'Exito');
                    console.log("Editado correctamente");
                    this.usuario= {id:'', name:'', email:'', ID_ROL:''};
                    this.cargar();
                })
            },
            
            cancelarEdicion(){
                this.modoEditar = false;
                this.usuario= {id:'', name:'', email:'', ID_ROL:''};
                this.check='';
            }
        },
        computed:{
                RolUsuario: function (user) {
                    var rolito='Nada';
                    console.log(rolito, user);
                    this.roles.forEach(element => {
                        if (user.ID_ROL === element.id) {
                            rolito = element.name
                            console.log(element);
                        }
                    });
                    return rolito
                },

                searchUsuarios: function(){
                    return this.usuarios.filter((item) => item.name.toUpperCase().includes(this.name.toUpperCase())); 
                }
        }
    }
</script>