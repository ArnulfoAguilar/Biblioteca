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
              {{datos.id}}--{{datos_prueba}}
              <!-- <div v-if="datos.id in datos_prueba">
                est{á}
              </div> -->

              <!-- <div v-for="(dato, indice) in datos_prueba" :key="indice">
                <div v-if="datos.id == dato">
                  esta prrito
                </div>
              </div> -->
              
              <!-- <div v-for="(item, indice) in InteraccionComentarios" :key="indice">
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

              <div v-if="interactue(datos.id) == true">
                Di like
              </div>
              <div v-else>
                No di Like
              </div>

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
            datos_prueba:['1','2','3','7'],

            interaccionesConLike: [],
            dioLike:'',
            ocultar:false,
            nuevo: '',
            listaMalasPalabras: '',
            comentarios: [],
            InteraccionComentarios: [],
            interacciones: [],
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
          // Quiza no me sirva
          cargar_interacciones(){
            axios.get('/interaccionesComentario/'+this.aporte).then(res=>{
                this.InteraccionComentarios = res.data;
              //  console.log(this.InteraccionComentarios);
                })
          },

          // cargar_interacciones(){
          //   axios.get('/interacciones'+this.aporte).then(res=>{
          //       this.interacciones = res.data;
          //       console.log(this.interacciones);
          //       })
          // },

          // prueba(id){
          //   axios.get('/interacciones/'+id).then(res=>{
          //     this.interaccionesConLike = res.data;
          //     console.log(this.interaccionesConLike);
          //   })

            // if( this.interaccionesConLike == 0 ){
            //   return false;
            // }else{
            //   return true;
            // }
          // },

          interactue(id){
            
            

            // this.datos = {idA:this.aporte, idC:id};

            // console.log(this.datos);

            var retorno_axios='algo';

            // axios.get('/interactue/'+this.aporte+'/'+id).then(res=>{
            //   console.log('data'+res.data);
            //   this.dioLike = res.data
            //   retorno_axios = res.data;
            //   // if(res.data == 1){
            //   //   this.dioLike = 1;
            //   //   }
              


            //   if(res.data == 1 || res.data == '1'){
            //     return true;
            //   } else{
            //     return false;
            //   }
              
            // });

            async function getInte() {
            try {
              const response = await axios.get('/interactue/'+this.aporte+'/'+id);
              console.log(response);
              comsole.log('entra');
            } catch (error) {
              console.error(error);
            }
          }


            // return true;
            console.log('dio like'+retorno_axios);


            // var retorno_axios='1';

            // if(id < 5){
            //   retorno_axios = '1';
            // }else{
            //   retorno_axios = '0';
            // }

            //  if(retorno_axios == 1 || retorno_axios == '1'){
            //    return true;
            //  } else{
            //    return false;
            //  }
          },


          
          cargar_malas_palabras(){
            axios.get('/palabraProhibida').then(res=>{
                this.listaMalasPalabras = res.data;
                console.log(this.listaMalasPalabras);
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

          disLike(idInteraccion){
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
                  axios.delete(`/adquisiciones/${idInteraccion}`)
                  .then(()=>{
                      swal('Exito','Registro Borrado','success')
                      this.cargarSugerencias();
                  })
                }
              }
            );
              
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

        // computed:{
        //   interactue: function(){
            
        //     // this.datos = {idA:this.aporte, idC:id};
        //     // console.log(this.datos);
        //     var retorno_axios='algo';
        //     axios.get('/interactue/'+this.aporte+'/'+id).then(res=>{
        //       console.log('data'+res.data);
        //       // this.dioLike = res.data
        //       retorno_axios = res.data;
        //       // if(res.data == 1){
        //       //   this.dioLike = 1;
        //       //   }

        //       if(res.data == 1 || res.data == '1'){
        //         return true;
        //       } else{
        //         return false;
        //       }
              
        //     });
        //     // return true;
        //     console.log('dio like'+retorno_axios);

        //     // var retorno_axios='1';

        //     // if(id < 5){
        //     //   retorno_axios = '1';
        //     // }else{
        //     //   retorno_axios = '0';
        //     // }

        //     //  if(retorno_axios == 1 || retorno_axios == '1'){
        //     //    return true;
        //     //  } else{
        //     //    return false;
        //     //  }
        //   },
        // },
    }
</script>
