<template>
    <div class="d-flex justify-content-end">   
        <button class="btn btn-primary" @click="habilitar()">
          <i class="fas fa-check"></i> Habilitar
        </button>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Componente habilitar-aporte momtado.')
        },
        props: ['aporte'],
        data(){
            return{
                Aportes: [],
            }
        },
        created(){
        },
        methods :{
            habilitar(){
              axios.get('/aporte/habilitar?id='+this.aporte).then(response=>{
                  if(response.data == '1'){
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.success('Aporte aprobado y habilitado', 'Exito');
                  }else{
                    toastr.clear();
                    toastr.options.closeButton = true;
                    toastr.error('Deben de solventarse todas las observaciones antes de habilitar el aporte', 'Imposible');
                  }
                  }
                )
            },
        },
    }
</script>
