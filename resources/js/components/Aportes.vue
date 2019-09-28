<template>
    <div class="container">   
        <div class="col-md-12" v-for="(item, index) in Aportes" :key="index">
            <!-- Box Comment -->
           <a href="#" @click="verAporte(item.id)" style="text-decoration:none!important; color:black!important;">
            <div class="card card-widget" >
              <div class="card-header" style="background-color:white;">
                <div class="user-block">
                  <img class="img-circle" src="" alt="">
                  <span class="username"><a href="#">{{ item.name }}</a></span>
                  <span class="description">{{ item.created_at}}</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                 <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                    <i class="far fa-circle"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <h5>{{ item.TITULO }}</h5>
                <p>{{ item.DESCRIPCION}}</p>
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
              window.location.href='/aportes/'+id;
            }, 

        },
      

    }
</script>
