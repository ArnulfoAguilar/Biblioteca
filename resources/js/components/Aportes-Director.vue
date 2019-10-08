<template>
    <div class="container"> 
      <!-- TIMELINE -->
      <div class="tab-pane active" id="timeline">
        <ul class="timeline timeline-inverse">
            <li v-for="(item, index) in Aportes" :key="index">
                <i class="fas fa-check-circle bg-success" v-if="item.HABILITADO == true"></i>
                <i class="fas fa-eye bg-warning" v-else></i>
                <div class="timeline-item">
                    <span class="time"><i class="far fa-clock"></i> {{item.created_at}}</span>                    
                    <div class="timeline-header">
                      {{ item.TITULO }}
                    </div>
                    <div class="timeline-body">
                      {{ item.DESCRIPCION}}
                      <a href="#" class="btn btn-primary btn-sm float-right" @click="verAporte(item.id)" > <i class="far fa-eye"></i> Ver </a> 
                      <!-- <a href="#" class="btn btn-secondary btn-sm float-right" @click="alerta()" > <i class="far fa-circle"></i> Ver </a>  -->
                    </div>
                </div>
            </li>
            <!-- END timeline item -->
            <li>
              <i class="far fa-clock bg-gray"></i>
              <div class="timeline-item">
                <div class="timeline-header bg-gray" v-if="Aportes < 1">
                  No hay Aportes
                </div>
                <div class="timeline-header bg-gray" v-else>
                  Fin de los Aportes
                </div>
              </div>
            </li>
        </ul>
      </div>
      <!-- FIN TIMELINE -->

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
              axios.get('/listaAportesDirector').then(response=>{
                this.Aportes = response.data;
                console.log(this.Aportes);
                }
              )
            },
            
            verAporte(id){
              window.location.href='/aportes/'+id;
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
      

    }
</script>
