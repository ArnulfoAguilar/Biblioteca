<template>
       <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <input type="text" class="form-control" name="" id="" placeholder="Busca un aporte" v-model="search_titulo" autofocus>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body" v-for="(item, index) in searchEjemplar" :key="index">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="" alt="">
                        <span class="username">
                          <a href="#" @click="verAporte(item.id)" >{{ item.TITULO }}.</a>
                        </span>
                        <span class="description">Hecho el {{ item.created_at}}</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        {{ item.DESCRIPCION}}.
                      </p>

                      <p>

                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> {{item.CANTIDAD_COMENTARIOS == 0 ? "Sin ":item.CANTIDAD_COMENTARIOS}} comentarios
                          </a>
                        </span>
                      </p>
                    </div>
                    <!-- /.post -->                  
                  </div>
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
          props: ['usuarioid'],
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
                 axios.get('/aportesProfile?id='+this.usuarioid).then(response=>{
                  this.Aportes = response.data;
                  }
                )                
            },
            verAporte(id){
              window.location.href='/aportes/'+id;
            }, 

        },
        computed:{
            searchEjemplar: function(){
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
