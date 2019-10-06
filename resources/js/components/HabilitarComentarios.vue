<template>
    <div class="container"> 
      <!-- TIMELINE -->
      <div class="tab-pane active" id="timeline">
        <ul class="timeline timeline-inverse">
            <li v-for="(item, index) in Comentarios" :key="index">
                <i class="fas fa-eye bg-success" v-if="item.HABILITADO == true"></i>
                <i class="fas fa-eye-slash bg-warning" v-else></i>
                <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> {{item.created_at}}</span>                    
                    <div class="timeline-header">
                      <div v-for="(user, index) in Users" :key="index">
                        <div v-if="user.id == item.ID_USUARIO">
                           Comentario de <a href="#">{{ user.name }}</a> 
                           <b v-if="item.HABILITADO == true">(Visible)</b>
                           <b v-else>(Oculto)</b>
                        </div>
                      </div>
                    </div>
                    <div class="timeline-body">
                      {{ item.COMENTARIO}}
                      <a href="#" class="btn btn-success btn-sm float-right" @click="habilitar(item.id)" v-if="item.HABILITADO == false"> <i class="fas fa-check"></i> Habilitar </a> 
                      <a href="#" class="btn btn-secondary btn-sm float-right" @click="habilitar(item.id)"  v-else> <i class="fas fa-times"></i> Deshabilitar </a> 
                    </div>
                </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="far fa-clock bg-gray"></i>
              <div class="timeline-item">
                <div class="timeline-header bg-gray" v-if="Comentarios < 1">
                  No hay Comentarios
                </div>
                <div class="timeline-header bg-gray" v-else>
                  Fin de los Comentarios
                </div>
              </div>
            </li>
        </ul>
      </div>
      <!-- FIN TIMELINE -->

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['aporte'],
        data(){
            return{
                Comentarios: [],
                Users: [],
            }
        },
        created(){
            this.cargarComentarios();
        },
        methods :{
            cargarComentarios(){
              axios.get('/comentariostodos?id='+this.aporte).then(response=>{
                this.Comentarios = response.data;
                }
              )
              axios.get('/users').then(response=>{
                this.Users = response.data;
                }
              )
            },
            
            habilitar(id){
              this.$swal(
                {
                  title: '¿Estas seguro?',
                  text: "¡Esta a punto de hacer publico algo !",
                  icon: 'warning',
                  buttons: { cancel: true, confirm: true, },
                }).then((value) => {
                  if (value) {
                    axios.get('/comentario/habilitar?id='+id).then(response=>{
                      if(response.data == '1'){
                        swal('Exito','Cambio efectuado exitosamente','success')
                        this.cargarComentarios()
                      }else{
                        swal('Error','Ocurrio un error al procesar su solicitud','error')
                        this.cargarComentarios()
                      }
                    })
                  }
                },
                
              );

              
            },

        },
      

    }
</script>
