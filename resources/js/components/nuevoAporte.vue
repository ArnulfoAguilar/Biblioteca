<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo Aporte</div>

                    <div class="card-body">
                        <form  @submit.prevent="Agregar">
                                <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="Titulo">Titulo{{this.Summernote}}</label>
                                    <input type="text" v-model="Summernote" class="form-control" name="Titulo"
                                        aria-describedby="emailHelp" required>
                                </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="AREAS">
                                       Area
                                    </label>
                                    <div >
                                        <select2  name="AREAS" :options="Areas" v-model="APORTE.ID_AREA" >
                                        </select2>
                                    </div>
                                </div>
                                </div>
                 

                                <div class="form-group">
                                    <label for="Summernote">Descripción {{this.Summernote}}</label>
                                    <textarea type="text" class="form-control" id="Summernote" v-model="Summernote"  rows="20" required  v-on:change="value => { this.Summernote = value }">
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="PALABRAS_CLAVE">Palabras Clave</label>
                                    <input type="text" v-model="APORTE.PALABRAS_CLAVE" class="form-control" name="PALABRAS_CLAVE"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3" v-model="APORTE.COMENTARIOS">
                                    <label class="custom-control-label" for="customSwitch3">¿Permitir comentarios?</label>
                                    </div>
                                </div>     
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit" @click="Agregar">Guardar</button>
                                <button class="btn btn-danger" type="submit" @click="Cancelar">Cancelar</button>
                            </div>
                        
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
             axios.get('/area').then((response)=>{
                this.Areas = response.data;
            });
            console.log('Component mounted.');
            this.APORTE.COMENTARIOS= 'True';

        

  

    
        },
        data() {
            return {
                Areas:[],
                Summernote: '',
                APORTE: { TITULO: '', DESCRIPCION: '', PALABRAS_CLAVE: '',  ID_AREA: '', COMENTARIOS:'' },
            }
        },
        methods:{
            Agregar(){
                     
                    const AporteNuevo = this.APORTE;
                    console.log(this.Summernote)
                    console.log(AporteNuevo);
                    axios.post('/aportes', AporteNuevo)
                        .then(response=>{
                            console.log("Guardado");     
                        }).catch(e=>{
                            alert("Error al Guardar" + e);
                        })
            },
            Cancelar(){
                this.APORTE= { TITULO: '', DESCRIPCION: '', PALABRAS_CLAVE: '',  ID_AREA: '', COMENTARIOS:'' };
            }
        }
    }
</script>