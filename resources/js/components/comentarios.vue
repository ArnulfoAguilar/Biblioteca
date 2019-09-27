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
        <form @submit.prevent="comprobar_comentario">
          <input class="form-control form-control-lg" placeholder="Escribe un comentario..." v-model="Comentario.COMENTARIO">
        </form>  
      </div>
    </div>
</div>
   
</template>

<script>
    export default {
        mounted() {
        },
        props: ['aporte','usuario'],
        data(){
          return{
            ocultar:false,
            nuevo: '',
            listaMalasPalabras: '',
            comentarios: [],
            InteraccionComentarios: [],
            palabrasProhibidas: [],
            Comentario : {  COMENTARIO:'', ID_USUARIO:this.usuario, ID_APORTE: this.aporte },
            InteraccionComentario: { DESCRIPCION:'', ID_TIPO_INTERACCION:'', ID_COMENTARIO:'', ID_USUARIO:this.usuario }
          }
        },
        created(){
          this.cargar_comentarios();
          this.cargar_interacciones();
          this.cargar_malas_palabras();
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
          cargar_malas_palabras(){
            axios.get('/palabraProhibida').then(res=>{
                this.listaMalasPalabras = res.data;
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
          comprobar_comentario(){
                if(this.Comentario.COMENTARIO !=""){
                const regex = /(^Puto| Puto | Puto$|^Negro| Negro | Negro$)/igm;
                const str = this.Comentario.COMENTARIO;
                let palabra_en_comentario;
                if ((palabra_en_comentario = regex.exec(str)) !== null) {

                  if (palabra_en_comentario.index === regex.lastIndex) {
                    regex.lastIndex++;
                  }
                  this.mostrar_alerta("Puede que su comentario tenga palabras inadecuadas");        
                }else{
                  this.agregar_comentario();
                }
                }else{
                  this.mostrar_alerta("Debe escribir un comentario");
                }
                
          },
          mostrar_alerta(texto)
          {
              this.$swal(
                  {
                    title: 'Alto',
                    text: texto,
                    icon: 'warning',
                    buttons: {
                      cancel: true,
                      confirm: true,
                    },
                  }).then((value) => {
                    if (value) {
                      this.agregar_comentario();
                    }
                  }
                  );        
          },
          agregar_comentario(){
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
          },
          traer_malas_palabras(){
             axios.get('/palabraProhibida').then(res=>{
                console.log(res.data);
            });
          }
        },
    }
</script>
