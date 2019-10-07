<template>
    <div class="container ">   
        <div class="row" >
            <!-- Box Comment -->
            <div class="card card-widget col-md-5 col-xs-12" v-for="(item, index) in Aportes" :key="index" style="margin-left:25px;" >
              <div class="card-header" style="background-color:white;">
                <div class="user-block">
                   <a href="#" @click="verAporte(item.id)" style="text-decoration:none!important; color:black!important;">
                  <img class="img-circle" src="" alt="">
                  <span class="username"><a href="#">{{ item.AUTOR_APORTE }}</a></span>
                  </a>
                  <span class="description">{{ item.created_at}}</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <h5>{{ item.TITULO }}</h5>
                <p>{{ item.DESCRIPCION}}</p>                
              </div>
              <div class="card-footer" style="background-color:white">
                <span class="float-right text-muted"> {{item.CANTIDAD_COMENTARIOS == 0 ? "Sin ":item.CANTIDAD_COMENTARIOS}} comentarios</span>
              </div>
            </div>
            <!-- /.card -->
            <!--</a>-->
          </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['habilitado'],
        data(){
            return{
                Aportes: [],
                Aporte: { TITULO:'', DESCRIPCION:'', CREATED_AT:'', AUTOR_APORTE:'', CANTIDAD_COMENTARIOS:''}
            }
        },
        created(){
            this.cargarAportes();
        },
        methods :{
            cargarAportes(){
              if(this.habilitado != ''){
                axios.get('/listaTodosAportes?id='+this.habilitado).then(response=>{
                  this.Aportes = response.data;
                  console.log(this.Aportes)
                  }
                )
              }else{
                axios.get('/listaAportes').then(response=>{
                  this.Aportes = response.data;
               
                  }
                )
              }
                
            },
            
            verAporte(id){
              console.log(id)
              window.location.href='/aportes/'+id;
            }, 

        },
      

    }
</script>
