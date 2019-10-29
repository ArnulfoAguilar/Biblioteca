<template>
   
       <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="" alt="">
                </div>

                <h3 class="profile-username text-center">{{ this.usuarioname }}</h3>

                <p class="text-muted text-center">{{this.rol}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Aportes</b> <a class="float-right">{{this.CantidadAportesRealizados}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Following</b> <a class="float-right">543</a>
                  </li>
                  <li class="list-group-item">
                    <b>Friends</b> <a class="float-right">13,287</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Acerca de mi</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i>Biografia</strong>

                <p class="text-muted">
                  B.S. in Computer Science from the University of Tennessee at Knoxville
                </p>

                <hr>

                
                <a href="#" class="btn btn-primary btn-block"><b>Editar Biografia</b></a>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        props: ['usuarioid','usuarioname','rol'],
        data(){
            return{
                CantidadAportesRealizados:'',
                Usuario: { usuario_id:'', name:'', email:'', rol_id:'', ROL:''}
            }
        },created(){
          this.totalAportes();
        },
         methods :{
            totalAportes()
            {
                 axios.get('/Usuario/totalAportesCreados/'+this.usuarioid).then(response=>{
                  this.CantidadAportesRealizados = response.data;
                  }
                )                
            },
            verAporte(id){
              window.location.href='/aportes/'+id;
            }, 

        },
         
    }
</script>