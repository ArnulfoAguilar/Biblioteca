<template>
<div class="card">
                    <div class="card-header">
                       <form @submit.prevent="Agregar_comentario">
                        <input class="col-md-12 form-control form-control-lg" placeholder="Escribe un comentario..." v-model="Comentario.COMENTARIO">
                       </form>
                    </div>
                    <div class="card-body">
                      <div class="container">
                        <div class="col-12" >
                          <div class="post" v-for="(item, index) in comentarios" :key="index">
                            <div class="user-block">
                              <img class="img-circle img-bordered-sm" src="" alt="">
                              <span class="username">
                                <a href="#">{{item.name}}.</a>
                              </span>
                              <span class="description">{{ item.created_at}}</span>
                            </div>
                      <!-- /.user-block -->
                            <p>
                              {{ item.COMENTARIO}}
                            </p>

                            <p>
                              <a href="#" class="link-black text-sm float-right"><i class="fas fa-link mr-1"></i> Reportar</a>
                               
                               <a href="#" class="link-black text-sm" ><i class=""></i> Editar</a>
                            </p>
                          </div>    
                        </div>
                      </div>
                    </div>
                </div>
   
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['aporte','usuario'],
        data(){
          return{
            ocultar:false,
            nuevo: '',
            comentarios: [],
            Comentario : {  COMENTARIO:'', ID_USUARIO:this.usuario, ID_APORTE: this.aporte }
          }
        },
        created(){
          this.cargar_comentarios();
        },
        methods:{
          cargar_comentarios(){
            axios.get('/comentarios?id='+this.aporte).then(res=>{
                this.comentarios = res.data;
                console.log();
                })
          },
          Agregar_comentario(){
            const comentarioNuevo =this.Comentario;
            axios.post('/comentarios',comentarioNuevo)
            .then((response) => {
              alert("Guardado Correctamente");
              this.cargar_comentarios();
              this.Comentario.COMENTARIO = "";

            }).catch(e=>{
                  alert("Error al Guardar" + e);
              })
          }
        }
    }
</script>
