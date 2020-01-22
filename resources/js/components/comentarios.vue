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
            <div class="row float-right">
<!-- ---------------------------------ESTO FUNCIONA (tiene un error pero funciona) --------------------------------------------------------------- -->
              <div v-for="(miInteraccion, indice) in misInteracciones" :key="indice">
                <div v-if="datos.id == miInteraccion.id">
                  {{ usuarioDioLike() }}
                  <button type="button"  class="btn btn-default btn-sm " @click="dislike(miInteraccion.int)"><i class="fas fa-thumbs-up">{{ datos.total_likes }}</i> Dislike</button>
                </div>
              </div>

              <div v-if="dioLike === 1">
                {{ setDioLike() }}
              </div>
              <div v-else>
                <button type="button"  class="btn btn-default btn-sm " @click="like(datos.id)"><i class="far fa-thumbs-up">{{ datos.total_likes }}</i> Like</button>
              </div>
<!-- ---------------------------------------------------------------// PRUEBAS --------------------------------------------------------------- -->
              <!-- <input id="interaccion_usuario" v-model="dioLike">

               <div v-if="interactue_prueba(datos.id) == 'si'">
                Interactue
              </div>
              <div v-if="interactue_prueba(datos.id) == 'no'">
                No interactue
              </div> -->



              <!-- <div v-for="(item, indice) in misInteracciones" :key="indice">
                <div v-if="item.ID_COMENTARIO == datos.id">
                  Entra
                  <div v-if="item.ID_USUARIO_INTERACCION == usuario ">
                    Yo Interactue
                  </div>
                  <div v-else>
                    No es mio
                  </div>
                </div>
                
              </div> -->

              <!-- <div v-if="interactue(datos.id) == true">
                Di like
              </div>
              <div v-else>
                No di Like
              </div> -->

              <!-- <button type="button"  class="btn btn-default btn-sm " @click="like(datos.id)"><i class="far fa-thumbs-up">{{ datos.total_likes }}</i> Like</button> -->
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

            interaccionesConLike: [],
            dioLike:null,
            misInteracciones_prueba: [],



            ocultar:false,
            nuevo: '',
            listaMalasPalabras: '',
            comentarios: [],
            misInteracciones: [],
            interacciones: [],
            palabrasProhibidas: [],
            Comentario : {  COMENTARIO:'', ID_USUARIO:this.usuario, ID_APORTE: this.aporte },
            InteraccionComentario: { DESCRIPCION:'', ID_TIPO_INTERACCION:'', ID_COMENTARIO:'', ID_USUARIO:this.usuario }
          }
        },
        created(){
          this.cargar_comentarios();
          //this.cargar_interacciones();
          this.cargar_malas_palabras();
          this.interactue();
        },
        methods:{
          refresh(){
            this.cargar_comentarios();
            this.cargar_malas_palabras();
            this.interactue();
          },

          cargar_comentarios(){
            axios.get('/comentarios?id='+this.aporte).then(res=>{
                this.comentarios = res.data;            
                })
          },
          // Quiza no me sirva
          cargar_interacciones_backup(){
            axios.get('/interaccionesComentario/'+this.aporte).then(res=>{
                this.misInteracciones = res.data;
              //  console.log(this.misInteracciones);
                })
          },

          // cargar_interacciones(){
          //   axios.get('/interacciones'+this.aporte).then(res=>{
          //       this.interacciones = res.data;
          //       console.log(this.interacciones);
          //       })
          // },

          usuarioDioLike(){
            this.dioLike = 1;
            console.log('usuario dio like'+this.dioLike);
          },

          setDioLike(){
            this.dioLike = null;
            console.log('Seteado a null');
          },

          interactue(){
            axios.get('/interactue').then(res => {
              this.misInteracciones = res.data;
              // console.log(this.misInteracciones);
            })
          },

          interactue_prueba(id){
            var respuesta;
            axios.get('/interactue_prueba/'+this.aporte+'/'+id).then(res => {
              // this.misInteracciones_prueba = res.data;
              console.log('dataaaaaaa: '+res.data)
              respuesta = res.data;
              $('#interaccion_usuario').val(5);
              return res.data;
              return 'si'
              // console.log(this.misInteracciones_prueba);
            })
            return respuesta;
          },

          
          cargar_malas_palabras(){
            axios.get('/palabraProhibida').then(res=>{
                this.listaMalasPalabras = res.data;
                // console.log(this.listaMalasPalabras);
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
              this.refresh();
              this.InteraccionComentario.ID_TIPO_INTERACCION = "";
              this.InteraccionComentario.ID_COMENTARIO = "";
            }).catch(e=>{
                  alert("Error al Guardar" + e);
              })
          },

          dislike(idInteraccion){
            axios.post(`/dislikeComentario/${idInteraccion}`)
                .then(()=>{
                      toastr.clear();
                      toastr.options.closeButton = true;
                      toastr.success('Ya no te gusta el Comentario', 'Dislike :(');
                      this.refresh();
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
                  var regex = new RegExp("("+this.listaMalasPalabras+")",'igm')
                  console.log(regex)
               // const regex = /()/igm;
                const str = this.Comentario.COMENTARIO;
                let palabra_en_comentario;
                if ((palabra_en_comentario = regex.exec(str)) !== null) {
console.log('Llego antes del if')
                  if (palabra_en_comentario.index === regex.lastIndex) {
                    regex.lastIndex++;
                  }
                  
                  this.mostrar_alerta("Puede que su comentario tenga palabras inadecuadas.\n¿Desea continuar?");        
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
