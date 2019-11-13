<template>
    <div class="container ">
      
      <div class="row" >      
        <div class="input-group mb-1 col-12">
            <input type="text" class="form-control" name="" id=""  v-model="search_titulo" autofocus>
        </div>   
        <br> <br><br> 
            <!-- Box Comment -->
            <div class="card card-widget col-md-5 col-xs-12" v-for="(item, index) in searchEjemplar" :key="index" style="margin-left:25px;" >
              <div class="card-header" style="background-color:white;">
                <div class="user-block">
                   
                  <img class="img-circle" src="" alt="">
                  <span class="username"><a href="#" @click="verAutor(item.ID_AUTOR)">{{ item.AUTOR_APORTE }}</a></span>
                  
                  <span class="description">{{ item.created_at}}</span>
                </div>
                <!-- /.user-block -->
                
                <div class="card-tools">
                </div>
                <!-- /.card-tools -->
              </div>
              <a href="#" @click="verAporte(item.id)" style="text-decoration:none!important; color:black!important;">
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <h5>{{ item.TITULO }}</h5>
                <p>{{ item.DESCRIPCION}}</p>                
              </div>
              <div class="card-footer" style="background-color:white">
                <span class="float-right text-muted"> {{item.CANTIDAD_COMENTARIOS == 0 ? "Sin ":item.CANTIDAD_COMENTARIOS}} comentarios</span>
              </div>
              </a>
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
                search_titulo:'',
                Aportes: [],
                Aporte: { TITULO:'', DESCRIPCION:'', CREATED_AT:'', AUTOR_APORTE:'', CANTIDAD_COMENTARIOS:''}
            }
        },
        created(){
            this.cargarAportes();
        },
        methods :{
            cargarAportes()
            {
                axios.get('/listaTodosAportes?id='+this.habilitado).then(response=>{
                  this.Aportes = response.data;
                  console.log( this.Aportes)
                  }
                )                
            },
            verAporte(id){
              window.location.href='/aportes/'+id;
            },
            verAutor(id){
              window.location.href='/users/'+id;
            },  

        },
        computed:{
            searchEjemplar: function(){
              console.log(this.search_titulo.length)
                if(this.search_titulo!='' && this.search_titulo.length > 2){
                   
                   return this.Aportes.filter((item) => 
                                item.TITULO.toUpperCase().includes(this.search_titulo.toUpperCase()) ||
                                item.DESCRIPCION.toUpperCase().includes(this.search_titulo.toUpperCase())
                            );
                }else{
                   return this.Aportes         
                }
            }
        }
      

    }
</script>
