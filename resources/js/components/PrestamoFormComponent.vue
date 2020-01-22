<template>
<div>
    <!-- Modal content-->
    <form v-on:submit.prevent="guardarSolicitudPrestamo()">
            <div class="form-group">
            <label for="NOMBRE">Nombre del libro</label>
            <input
                v-model="prestamo.EJEMPLAR"
                type="text"
                class="form-control"
                id="NOMBRE"
                aria-describedby="emailHelp"
                readonly
                />
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="AUTOR">Autor/es</label>
                    <input
                    v-model="prestamo.AUTOR"
                    type="text"
                    class="form-control"
                    id="AUTOR"
                    aria-describedby="emailHelp"
                    readonly
                    />
                </div>
                <div class="form-group col-md-6">
                    <label for="EDICION">Edición</label>
                    <input
                    v-model="prestamo.EDICION"
                    type="text"
                    class="form-control"
                    id="EDICION"
                    aria-describedby="emailHelp"
                    readonly
                    />
                </div>
            </div>
            <div class="row" v-if="isBibliotecario">
            <div class="form-group col-md-6">
                <label for="tipoAdquisición">Tipo Adquisición</label>
                <select2 :options="tipoAdquisicion" :value="prestamo.ID_TIPO_ADQUISICION" disabled></select2>
            </div>
            <div class="form-group col-md-6" v-if="isBibliotecario">
                <label for="tipoPrestamo">Tipo Préstamo</label>
                <select2 :options="tipoPrestamos" v-model="solicitud.ID_TIPO_PRESTAMO"></select2>
            </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="DESCRIPCION">Descripción</label>
                    <textarea
                    v-model="prestamo.DESCRIPCION"
                    class="form-control"
                    name
                    id="DESCRIPCION"
                    rows="3"
                    readonly></textarea>
                </div>
            </div>
            <div class="row text-center" v-if="!isBibliotecario">
                <div class="form-group col-md-11">
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <label class="btn btn-info active">
                        <input type="radio" name="options" id="option1" autocomplete="off" /> Solicitar préstamo
                    </label>
                    <label class="btn btn-info">
                        <input type="radio" name="options" id="option2" autocomplete="off" /> Realizar reserva
                    </label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="COPIA">Código de barra</label>
                    <input
                    v-model="prestamo.CODIGO_BARRA"
                    type="text"
                    class="form-control"
                    id="PAGINAS"
                    aria-describedby="emailHelp"
                    readonly
                    />
                </div>
                <div class="form-group col-md-6">
                    <label for="PAGINAS">Fecha y hora de préstamo</label>
                    <input
                    class="form-control"
                    id="PAGINAS"
                    v-model="fechaPrestamo"
                    aria-describedby="emailHelp"
                    readonly
                    />
                </div>
                <div class="form-group col-md-6" v-if="isBibliotecario">
                    <label for="PAGINAS">Fecha de devolución</label>
                    <input
                    class="form-control"
                    id="PAGINAS"
                    v-model="fechaDevolucion"
                    aria-describedby="emailHelp"
                    readonly
                    />
                </div>

            </div>
        <div class="modal-footer">
            <button class="btn btn-success float-left" type="submit">Finalizar</button>
            <button class="btn btn-dark" type="reset" data-dismiss="modal">Cancelar</button>
        </div>
    </form>
</div>
</template>

<script>
export default {
    created(){
        if(this.isBibliotecario){
            axios.get('/TipoPrestamoSelect').then(estados=>{
                this.tipoPrestamos = estados.data;
            });
            axios.get('/TipoAdquisicionSelect').then(adquisiciones=>{
                this.tipoAdquisicion = adquisiciones.data;
            }).then(()=>{
                this.materialSeleccionado();
            });
        }else{
            this.materialSeleccionado();
        }
    },
    data(){
        return{
            hoy: this.$moment(new Date()),
            fechaDevolucion: '',
            fechaPrestamo: '',
            tipoPrestamos: [],
            tipoAdquisicion: [],
            prestamo:{
                ID_MATERIAL: "",
                ID_CATALOGO_MATERIAL: "",
                EJEMPLAR: "",
                AUTOR: "",
                EDICION: "",
                DESCRIPCION: "",
                ISBN: "",
                COPIA_NUMERO: "",
                ID_TERCER_SUMARIO: "",
                CODIGO_BARRA: "",
                ID_BIBLIOTECA: "",
                ID_ESTANTE: "",
                FILAESTANTE: "",
                ID_TIPO_ADQUISICION: ""
            },
            solicitud:{
                FECHA_PRESTAMO: "",
                ID_USUARIO: "",
                ID_TIPO_PRESTAMO: "",
                ID_ESTADO_PRESTAMO: "",
                ID_MATERIAL: "",
                ID_PRESTAMO: ''
            }
        }
    },
    methods:{
        guardarSolicitudPrestamo() {
            debugger;
            if(!this.isBibliotecario){
                if ($("#option2").val() === "on") {
                    this.solicitud.ID_ESTADO_PRESTAMO = 2;
                } else {
                    this.solicitud.ID_ESTADO_PRESTAMO = 1;
                }
            }
            this.solicitud.ID_MATERIAL = this.material.ID_MATERIAL;
            this.solicitud.FECHA_PRESTAMO = this.hoy.format("DD-MM-YYYY HH:mm");
            this.solicitud.FECHA_DEVOLUCION = '';
            const solicitudPrestamoToSave = this.solicitud;
            if(this.isBibliotecario){
                solicitudPrestamoToSave.FECHA_DEVOLUCION = this.hoy.add(8,'d').format("DD-MM-YYYY HH:mm")
                solicitudPrestamoToSave.ID_ESTADO_PRESTAMO = 3
                if(solicitudPrestamoToSave.ID_PRESTAMO !== undefined && solicitudPrestamoToSave.ID_PRESTAMO !==''){
                    axios.put(`/biblioteca/prestamos/${solicitudPrestamoToSave.ID_PRESTAMO}`,solicitudPrestamoToSave).then(res => {
                        this.showToastr();
                    });
                }else{
                    axios.post("/biblioteca/prestamos", solicitudPrestamoToSave).then(res => {
                        this.showToastr();
                    });
                }
            }else{
                axios.post("/biblioteca/prestamos", solicitudPrestamoToSave).then(res => {
                    this.showToastr();
                });
            }
        },
        materialSeleccionado(){
            this.prestamo.ID_MATERIAL= this.material.ID_MATERIAL;
                this.prestamo.ID_CATALOGO_MATERIAL=this.material.ID_CATALOGO_MATERIAL;
                this.prestamo.EJEMPLAR=this.material.EJEMPLAR;
                this.prestamo.AUTOR=this.material.AUTOR;
                this.prestamo.EDICION=this.material.EDICION;
                this.prestamo.DESCRIPCION=this.material.DESCRIPCION;
                this.prestamo.ISBN=this.material.ISBN;
                this.prestamo.COPIA_NUMERO=this.material.COPIA_NUMERO;
                this.prestamo.CODIGO_BARRA=this.material.CODIGO_BARRA;
                this.prestamo.ID_TERCER_SUMARIO=this.material.ID_TERCER_SUMARIO;
                this.prestamo.ID_BIBLIOTECA=this.material.ID_BIBLIOTECA;
                this.prestamo.ID_ESTANTE=this.material.ID_ESTANTE;
                this.prestamo.FILAESTANTE=this.material.FILAESTANTE;
                this.prestamo.ID_TIPO_ADQUISICION=this.material.ID_TIPO_ADQUISICION;
                this.fechaPrestamo = this.hoy.format("DD-MM-YYYY HH:mm");
                if(this.material.id!==undefined && this.material.id!=='')
                    this.solicitud.ID_PRESTAMO = this.material.id;
                if(this.isBibliotecario)
                    this.fechaDevolucion = this.hoy.add(8,'d').format("DD-MM-YYYY HH:mm");
        },
        showToastr(){
            toastr.clear();
            toastr.options.closeButton = true;
            toastr.success("Solicitud guardada correctamente", "Éxito");
            this.$emit('close',false);
        }
    },
    props:{
        isBibliotecario: Boolean,
        material: Object
    }
}
</script>

<style>

</style>
