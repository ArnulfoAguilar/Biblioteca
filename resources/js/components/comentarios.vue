<template>
<div>
    <div class="card-footer card-comments">
        <div class="card-comment"  v-for="(datos, indice) in comentarios" :key="indice" >
          <!-- User image -->
            <img class="img-circle img-sm" src="" alt="">
        
            <div class="comment-text">
              <span class="username">
                {{datos.name}}
              <span class="text-muted float-right">{{ datos.created_at}}</span>
              </span><!-- /.username -->
              {{ datos.COMENTARIO}}
            </div>
                          <!-- /.comment-text -->
            <div class="row float-right" >

              <button type="button"  class="btn btn-default btn-sm " @click="like(datos.id)"><i class="far fa-thumbs-up">{{ datos.total_likes }}</i> Like</button>
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
            InteraccionComentarios: [],
            Comentario : {  COMENTARIO:'', ID_USUARIO:this.usuario, ID_APORTE: this.aporte },
            InteraccionComentario: { DESCRIPCION:'', ID_TIPO_INTERACCION:'', ID_COMENTARIO:'', ID_USUARIO:this.usuario }
          }
        },
        created(){
          this.cargar_comentarios();
          this.cargar_interacciones()
        },
        methods:{
          cargar_comentarios(){
            axios.get('/comentarios?id='+this.aporte).then(res=>{
                this.comentarios = res.data;
                
                })
          },
          cargar_interacciones(){
            axios.get('/interaccionesComentario/'+this.aporte).then(res=>{
                this.InteraccionComentarios = res.data;
               
                })
          },
          like(IdComentario){
            this.InteraccionComentario.ID_TIPO_INTERACCION= 1;
            this.InteraccionComentario.ID_COMENTARIO= IdComentario;
            const nuevaInteraccion =this.InteraccionComentario;
            axios.post('/likeComentario',nuevaInteraccion)
            .then((response) => {
              toastr.clear();
              toastr.options.closeButton = true;
              toastr.success('Te ha gustado el Comentario', 'Like!!');
              this.cargar_comentarios();
              this.InteraccionComentario.ID_TIPO_INTERACCION = "";
              this.InteraccionComentario.ID_COMENTARIO = "";
            }).catch(e=>{
                  alert("Error al Guardar" + e);
              })
          },
          Report(IdComentario){
            this.InteraccionComentario.ID_TIPO_INTERACCION= 2;
            this.InteraccionComentario.ID_COMENTARIO= IdComentario;
            const nuevaInteraccion =this.InteraccionComentario;
            axios.post('/reportComentario',nuevaInteraccion)
            .then((response) => {
              toastr.clear();
              toastr.options.closeButton = true;
              toastr.success('El administrador revisara este comentario. ¡Gracias!', 'Reportado');
              this.cargar_comentarios();
              this.InteraccionComentario.ID_TIPO_INTERACCION = "";
              this.InteraccionComentario.ID_COMENTARIO = "";
            }).catch(e=>{
                  alert("Error al Guardar" + e);
              })
          },
          Agregar_comentario(){
                /*const regex = /(puto|basura|gay )/gm;
                const str = this.Comentario.COMENTARIO;
                
                let m;
                while ((m = regex.exec(str)) !== null) {
                  // This is necessary to avoid infinite loops with zero-width matches
                  if (m.index === regex.lastIndex) {
                    regex.lastIndex++;
                  }
    
                  // The result can be accessed through the `m`-variable.
                  console.log(m);
                  m.forEach((match, groupIndex) => {
                  console.log(`Found match, group ${groupIndex}: ${match}`);
                  }); 
                }*/
            const comentarioNuevo =this.Comentario;
            axios.post('/comentarios',comentarioNuevo)
            .then((response) => {
              toastr.clear();
              toastr.options.closeButton = true;
              toastr.success('Espera por la aprobación', 'Guardado!!');
              this.cargar_comentarios();
              this.Comentario.COMENTARIO = "";

            }).catch(e=>{
                  alert("Error al Guardar" + e);
              })
          }
        },
    }
</script>
