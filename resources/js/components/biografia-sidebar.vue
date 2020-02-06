<template>

       <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid " v-bind:src="src"  alt="">
                </div>

                <h3 class="profile-username text-center">{{ this.usuarioname }}</h3>

                <p class="text-muted text-center">{{this.rol}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Aportes</b> <a class="float-right">{{this.CantidadAportesRealizados}}</a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Acerca de mí</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-book mr-1"></i>Biografía</strong>

                <p class="text-muted">
                  {{this.biografia}}
                </p>

                <hr>
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
        props: ['usuarioid','usuarioname','rol','biografia','idnivel'],
        data(){
            return{
                src: '',
                CantidadAportesRealizados:'',
                Niveles:[],
                Nivel:{id:'',NIVEL:'',PUNTAJE_MINIMO:'',BAGDE:''},
                Usuario: { usuario_id:'', name:'', email:'', rol_id:'', ROL:'', biografia:''}
            }
        },created(){
          this.totalAportes();
          this.Insignia();
        },
         methods :{
            totalAportes()
            {
                 axios.get('/Usuario/totalAportesCreados/'+this.usuarioid).then(response=>{
                  this.CantidadAportesRealizados = response.data;
                  }
                )
            },
            Insignia()
            {

                 axios.get('/Niveles/'+this.idnivel).then(response=>{
                  console.log("nivellllll"+response.data);
                  this.Niveles = response.data;

                  console.log(this.Niveles);
                  this.src=this.Niveles.BAGDE;
                  // console.log(this.src);
                  }
                )
            },
            verAporte(id){
              window.location.href='/aportes/'+id;
            },

        },

    }
</script>
