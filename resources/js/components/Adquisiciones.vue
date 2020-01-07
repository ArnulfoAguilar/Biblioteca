<template>
<div>
      <div class="d-flex justify-content-end" v-for="(user,index) in Usuarios" :key="index">
          <button v-if="usuario == user.id && user.ID_ROL == 4 && user.ID_COMITE != null" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEditar">Crear nueva sugerencia</button>
      </div>

      <br>

      <div v-if="Sugerencias < 1">
        <ul class="timeline timeline-inverse">
            <li>
              <i class="far fa-clock bg-gray"></i>
              <div class="timeline-item">
                <div class="timeline-header bg-gray">
                  No hay sugerencias
                </div>
              </div>
            </li>
        </ul>
      </div>

      <div class= "card" v-for="(item,index) in Sugerencias" :key="index">
        <!-- <div class="card-header">
        </div> -->
        <div class="card-body" >
            <div class="post">
                <div class="user-block">
                  <img class="img-circle img-bordered-sm" src="/iconos/spy.jpg" >
                  <span class="float-right">
                    <!-- <a :href="'/adquisicion/nueva/interaccion?id=' + item.id" class="link-black text-sm">
                        <i class="far fa-thumbs-up mr-1"></i> Me gusta
                    </a> -->
                    {{interacciones[index][0]}} Likes

                    <a :href="'/adquisicion/quitar/interaccion?id=' + item.id" v-if="interacciones[index][1] == true" class="link-black text-sm">
                        <i class="far fa-thumbs-down mr-1"></i> Ya no me gusta
                    </a>
                    <a :href="'/adquisicion/nueva/interaccion?id=' + item.id" v-else class="link-black text-sm">
                        <i class="far fa-thumbs-up mr-1"></i> Me gusta
                    </a>

                  </span>
                  
                  

                  <span class="username">
                    <div v-for="(user,index) in Usuarios" :key="index">
                      <a href="#" v-if="user.id == item.ID_USUARIO">{{user.name}}</a>
                    </div>
                    <div v-for="(area,index) in Areas" :key="index">
                      <p class="mb-0" v-if="item.ID_AREA == area.id">{{area.text}}</p>
                    </div>
                      
                  </span>
                  <span class="description">Compartido publicamente - {{item.created_at}}</span>
                </div>
                <!-- /.user-block -->
                <p class="mb-0">
                  <b>{{item.TITULO}}: </b>{{item.CONTENIDO}}
                  <button v-if="usuario == item.ID_USUARIO" @click="editarSugerencia(item)" type="button" class="btn btn-warning btn-sm float-right" data-toggle="modal" data-target="#modalEditar">Editar</button>
                  <button v-if="usuario == item.ID_USUARIO" @click="eliminarSugerencia(item, index)" type="button" class="btn btn-danger btn-sm float-right" >Eliminar</button>
                </p>

            </div>
        </div>
      </div>

<!-- Modal para editar-->
            <div id="modalEditar" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <form @submit.prevent="guardarSugerencia(Sugerencia)">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Sugerencia</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="NOMBRE">Título de la sugerencia</label>
                                    <input type="text" v-model="Sugerencia.TITULO" class="form-control" id="NOMBRE" autocomplete="off"
                                        aria-describedby="emailHelp" required maxlength="250">
                                </div>
                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="Sugerencia.DESCRIPCION"
                                        rows="3" required maxlength="250"></textarea>
                                    <!-- <input type="text" class="form-control" v-model="Sugerencia.DESCRIPCION" id="ISBN"
                                        aria-describedby="emailHelp" required> -->
                                </div>
                                <div class="form-group">
                                    <label for="ISBN">Justificación de la sugerencia</label>
                                    <textarea class="form-control" id="DESCRIPCION" v-model="Sugerencia.CONTENIDO"
                                        rows="3" required maxlength="50000"></textarea>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-success float-left" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="submit"
                                    @click="cancelarEdicion" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- fin modal editar-->
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Componente Sugerencias montado.')
        },
        props: ['usuario'],
        data(){
            return{
                modoEditar: false,
                interacciones: [],
                Sugerencias: [],
                Usuarios:[],
                Areas:[],
                Sugerencia: { id:'', TITULO:'', DESCRIPCION:'', CONTENIDO:'', ID_AREA:'', ID_USUARIO:'',}
            }
        },
        created(){
            this.cargarSugerencias();
        },
        methods :{
            cargarSugerencias(){
              axios.get('/adquisiciones').then(response=>{
                this.Sugerencias = response.data;
                }
              )
              axios.get('/users').then(response=>{
                this.Usuarios = response.data;
                }
              )
              axios.get('/Area').then(response=>{
                this.Areas = response.data;
                }
              )
              axios.get('/getInteracciones').then(response=>{
                this.interacciones = response.data;
                }
              )
              console.log(this.interacciones)
            },
            
            alerta(){
              this.$swal(
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
              );
            },

            cancelarEdicion(){
                this.modoEditar = false;
                this.Sugerencia= { id:'', TITULO:'', DESCRIPCION:'', CONTENIDO:'', ID_AREA:'', ID_USUARIO:'',}
            },

            editarSugerencia(item){
              this.Sugerencia.id = item.id;
              this.Sugerencia.TITULO = item.TITULO;
              this.Sugerencia.DESCRIPCION = item.DESCRIPCION;
              this.Sugerencia.CONTENIDO = item.CONTENIDO;
              this.Sugerencia.ID_AREA = item.ID_AREA;
              this.Sugerencia.ID_USUARIO = item.ID_USUARIO;
              this.modoEditar = true;
            },

            guardarSugerencia(Sugerencia){
              const nuevaSugerencia = this.Sugerencia;
              if(this.modoEditar){
                axios.put(`/adquisiciones/${Sugerencia.id}`, nuevaSugerencia)
                .then(res=>{
                  this.modoEditar = false;
                  console.log("Actualizado correctamente");
                  toastr.clear();
                  toastr.options.closeButton = true;
                  toastr.success('Datos de la sugerencia actualizados correctamente', 'Exito');
                })

              }else{
                axios.post('/adquisiciones', nuevaSugerencia)
                .then(res=>{
                  console.log("Guardado correctamente");
                  toastr.clear();
                  toastr.options.closeButton = true;
                  toastr.success('Datos de la sugerencia guardados correctamente', 'Exito');
                })
              }
              this.cargarSugerencias();
              $("#modalEditar").modal('hide');
              this.Sugerencia= { id:'', TITULO:'', DESCRIPCION:'', CONTENIDO:'', ID_AREA:'', ID_USUARIO:'',}

            },

            eliminarSugerencia(Sugerencia, index){
              this.$swal(
                {
                  title: '¿Estas seguro?',
                  text: "¡Esta acción no se puede revertir!",
                  icon: 'warning',
                   buttons: {
                      confirm: true,
                      cancel: true,
                    },
                }).then((value) => {
                  if (value) {
                    axios.delete(`/adquisiciones/${Sugerencia.id}`)
                    .then(()=>{
                        swal('Exito','Registro Borrado','success')
                        this.cargarSugerencias();
                    })
                  }
                }
              );
                
            },

        },

        // computed: {
        //   // a computed getter
        //   momento: function (date) {
        //     var now = moment(date);
        //     return now.startOf('hour').fromNow();
        //   }
        // },
      

    }
</script>
