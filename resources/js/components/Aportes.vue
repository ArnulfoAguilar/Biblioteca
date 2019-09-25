<template>
    <div class="container">   
        <div class="col-md-12" v-for="(item, index) in Aportes" :key="index">
            <!-- Box Comment -->
           <a href="#" @click="verAporte(item.id)" style="text-decoration:none!important; color:black!important;">
            <div class="card card-widget" >
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="" alt="">
                  <span class="username"><a href="#">{{ item.name }}</a></span>
                  
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  
                  <span class="description">{{ item.created_at}}</span>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <h1>{{ item.TITULO }}</h1>
                <p>{{ item.DESCRIPCION}}</p>
                <p>{{ item.CONTENIDO}}</p>
                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                <span class="float-right text-muted">2 comentarios</span>
              </div>
            </div>
            <!-- /.card -->
            </a>
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
                Aporte: { TITULO:'', DESCRIPCION:'', CREATED_AT:'', NAME:''}
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
                  console.log(this.Aportes);
                  }
                )
              }else{
                axios.get('/listaAportes').then(response=>{
                  this.Aportes = response.data;
                  console.log(this.Aportes);
                  }
                )
              }
                
            },
            
            verAporte(id){
              window.location.href='/aportes/'+id;
            }, 

        },
      

    }
</script>
