<template>
    <div class="container">    
        <div class="col-md-12" v-for="(item, index) in Aportes" :key="index">
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="" alt="">
                  <span class="username"><a href="#">{{ item.name }}</a></span>
                  <span class="description">{{ item.created_at}}</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                 
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <h1>{{ item.TITULO }}</h1>
                <p>{{ item.DESCRIPCION}}</p>
                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
                <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                <span class="float-right text-muted">2 comentarios</span>
              </div>
            </div>
            <!-- /.card -->
          </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
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
                axios.get('/listaAportes').then(response=>{
                    this.Aportes = response.data;
                    console.log(this.Aportes);
                }
                )
            }
        }
    }
</script>
