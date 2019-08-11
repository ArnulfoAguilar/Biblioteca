<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo Aporte</div>

                    <div class="card-body">
                        <form  >
                                <div class="row">
                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="NOMBRE">Titulo</label>
                                    <input type="text" v-model="APORTE.TITULO" class="form-control" id="Titulo"
                                        aria-describedby="emailHelp" required>
                                </div>

                                <div class="form-group col-md-6 col-xs-12">
                                    <label for="">
                                       Area
                                    </label>
                                    <div >
                                        <select2  :options="Areas" v-model="APORTE.ID_AREA" >
                                        </select2>
                                    </div>
                                </div>
                                </div>


                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="Summernote" v-model="APORTE.DESCRIPCION"
                                        rows="20" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="PALABRAS_CLAVE">Palabras Clave</label>
                                    <input type="text" v-model="APORTE.PALABRAS_CLAVE" class="form-control" id="NOMBRE"
                                        aria-describedby="emailHelp" required>
                                </div>

                                
                                <div class="form-group">
                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" class="custom-control-input" id="customSwitch3">
                                    <label class="custom-control-label" for="customSwitch3">¿Permitir comentarios?</label>
                                    </div>
                                </div>     
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="submit" 
                                    data-dismiss="modal">Cancelar</button>
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
            console.log('Component mounted.')
        },
        data() {
            return {
                Areas:[],
                APORTE: { TITULO: '', DESCRIPCION: '', PALABRAS_CLAVE: '',  ID_AREA: '', COMENTARIOS:'' },
            }
        },
    }
</script>