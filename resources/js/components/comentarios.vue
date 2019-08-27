<template>
<div>
    <div class="card-footer card-comments">
        <div class="card-comment"  v-for="(item, index) in comentarios" :key="index">
          <!-- User image -->
            <img class="img-circle img-sm" src="" alt="">
        
            <div class="comment-text">
              <span class="username">
                {{item.name}}.
              <span class="text-muted float-right">{{ item.created_at}}</span>
              </span><!-- /.username -->
              {{ item.COMENTARIO}}
            </div>
                          <!-- /.comment-text -->
            <div class="row float-right">
              <button type="button" class="btn btn-default btn-sm "><i class="far fa-thumbs-up"></i> Like</button>
              <button type="button" class="btn btn-default btn-sm "><i class="fas fa-ban"></i> Report</button>
            </div>
        </div>
                        <!-- /.card-comment -->
    </div>
    <div class="card-footer">
                       
      <img class="img-fluid img-circle img-sm" src="" alt="">
      <!-- .img-push is used to add margin to elements next to floating images -->
      <div class="img-push">
        <form @submit.prevent="Agregar_comentario">
          <input class="form-control form-control-lg" placeholder="Escribe un comentario..." v-model="Comentario.COMENTARIO">
        </form>  
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
              this.cargar_comentarios();
              this.Comentario.COMENTARIO = "";

            }).catch(e=>{
                  alert("Error al Guardar" + e);
              })
          }
        }
    }
</script>
