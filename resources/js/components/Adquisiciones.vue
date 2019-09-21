<template>
      <div class= "card" >
        <!-- <div class="card-header">
        </div> -->
        <div class="card-body" v-for="(item,index) in Adquisiciones" :key="index">
            <div class="post">
                <div class="user-block">
                <!-- <img class="img-circle img-bordered-sm" src="../../public/iconos/spy.jpg" > -->
                  <span class="float-right">
                    <a href="#" class="link-black text-sm">
                    <i class="far fa-thumbs-up mr-1"></i> Like
                    </a>
                  </span>
                <span class="username">
                  <div v-for="(user,index) in Usuarios" :key="index">
                    <a href="#" v-if="user.id == item.ID_USUARIO">{{user.name}}</a>
                  </div>
                    
                    
                </span>
                <span class="description">Compartido publicamente - {{item.created_at}}</span>
                </div>
                <!-- /.user-block -->
                <h4></h4>
                <p><b>{{item.TITULO}}: </b>{{item.CONTENIDO}}</p>
            
                <p>
                <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> -->
                <a href="#" class="link-black text-sm"></a>
                <!-- <span class="float-right">
                    <a href="#" class="link-black text-sm">
                    <i class="far fa-comments mr-1"></i> Comments (5)
                    </a>
                </span> -->
                </p>
            
                <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
            </div>

        </div>

      </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Componente Adquisiciones montado.')
        },
        props: ['habilitado'],
        data(){
            return{
              fecha:'',
                Adquisiciones: [],
                Usuarios:[],
                Adquisicion: { TITULO:'', DESCRIPCION:'', CONTENIDO:'', ID_AREA:'', ID_USUARIO:'', CREATED_AT:'', NAME:''}
            }
        },
        created(){
            this.cargarAdquisiciones();
        },
        methods :{
            cargarAdquisiciones(){
              axios.get('/adquisiciones').then(response=>{
                this.Adquisiciones = response.data;
                console.log(this.Adquisiciones);
                }
              )
              axios.get('/users').then(response=>{
                this.Usuarios = response.data;
                console.log(this.Usuarios);
                }
              )
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
