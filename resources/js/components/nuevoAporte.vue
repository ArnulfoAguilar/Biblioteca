<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Nuevo Aporte</div>

                    <div class="card-body">
                        <form @submit.prevent="agregar" >
                        
                                <div class="form-group">
                                    <label for="NOMBRE">Nombre</label>
                                    <input type="text" v-model="EJEMPLAR.EJEMPLAR" class="form-control" id="NOMBRE"
                                        aria-describedby="emailHelp" required>
                                </div>
                                <div class="form-group">
                                    <label for="DESCRIPCION">Descripción</label>
                                    <textarea class="form-control" id="DESCRIPCIONSummernote" v-model="EJEMPLAR.DESCRIPCION"
                                        rows="10" required></textarea>
                                </div>
                                
                                              
                            <div class="modal-footer">
                                <button class="btn btn-primary" type="submit">Agregar Ejemplar</button>
                                <button class="btn btn-danger" type="submit" 
                                    @click="cancelarEdicion" data-dismiss="modal">Cancelar</button>
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
            console.log('Component mounted.')
        },
        data() {
            return {
                search:'',
                ejemplars: [],
                modoEditar: false,
                EJEMPLAR: { EJEMPLAR: '', DESCRIPCION: '', ISBN: '',  AUTOR: '', NUMERO_PAGINAS: '', COPIAS:'', },
            }
        },
    }
</script>