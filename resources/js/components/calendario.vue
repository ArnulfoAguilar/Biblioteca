<template>
    <div>
        <FullCalendar
        :defaultView="calendar.defaultView"
        :themeSystem='calendar.defaultTheme'
        :plugins='calendar.calendarPlugins'
        :locale='calendar.defaultLocale'
        :selectable='calendar.selectable'
        @dateClick='dateClick'
        @select='dateRange'
        @eventClick='eventClick'
        ref="Calendar"
        :events="eventos"
        :displayEventTime="false"
        ></FullCalendar>
        <bootbox-modal v-if="modalShowFlag" @close="modalClosing" :title="modalTitle">
            <form @submit.prevent="submitHandler">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Nombre de asueto:</label>
                        <input type="text" class="form-control" v-model="evento.title" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Fecha de inicio:</label>
                        <input type="text" class="form-control" v-model="evento.start" disabled>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Fecha de fin:</label>
                        <input type="text" class="form-control" v-model="evento.end" disabled>
                    </div>
                    <div class="col-md-6" v-if="(eventoFromCalendar.id!==undefined && eventoFromCalendar.id>0)">
                        <button class="btn btn-danger" type="button" @click="eliminarEvento">Eliminar</button>
                    </div>
                    <div :class="(eventoFromCalendar.id!==undefined && eventoFromCalendar.id>0)?'col-md-6':'col-md-12'">
                        <button class="btn btn-success float-right" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
        </bootbox-modal>
    </div>
</template>

<script>
    import FullCalendar from "@fullcalendar/vue";
    import dayGridPlugin from '@fullcalendar/daygrid';
    import esLocale from '@fullcalendar/core/locales/es';
    import bootstrapPlugin from '@fullcalendar/bootstrap';
    import interactionPlugin from '@fullcalendar/interaction';
    export default {
        components:{
            FullCalendar
        },
        data(){
            const vm = this;
            return{
                calendar:{
                    defaultView:'dayGridMonth',
                    calendarPlugins:[
                        dayGridPlugin,
                        bootstrapPlugin,
                        interactionPlugin
                    ],
                    defaultLocale: esLocale,
                    defaultTheme: 'bootstrap',
                    selectable: true
                },
                eventos: [],
                evento:{
                    id:'',
                    start:'',
                    end:'',
                    year:'',
                    title:'',
                    allDay:true
                },
                eventoFromCalendar:{},
                modalShowFlag:false,
                modalTitle:''

            }
        },
        created(){
            axios.get('/administracion/calendarios').then(response=>{
                this.eventos = response.data;
            });
        },
        methods:{
            dateClick(info){
                this.eventoFromCalendar=info;
                var fecha = this.$moment(info.dateStr);
                this.modalShowFlag=true;
                this.modalTitle='Asignar fecha no hábil';
                this.evento.start=fecha.format('DD-MM-YYYY');
                this.evento.year=fecha.year();
            },
            dateRange(info){
                debugger;
                var a = this.$moment(info.end);
                var b = this.$moment(info.start);
                var c = a.diff(b,'days');
                if(c>1){
                    this.eventoFromCalendar=info;
                    this.modalTitle='Agregar fechas no hábiles';
                    this.evento.start=b.format('DD-MM-YYYY');
                    this.evento.end=a.format('DD-MM-YYYY');
                    this.evento.year=this.$moment().year();
                    this.modalShowFlag=true;
                }
            },
            eventClick(info){
                var fin;
                this.eventoFromCalendar = info.event
                this.modalTitle='Detalles de fecha fecha no hábil';
                var inicio = this.$moment(info.event.start).format('DD-MM-YYYY');
                this.evento.start = inicio;
                this.evento.id = info.event.id;
                if(info.event.end!==undefined && info.event.end!==null){
                    fin = this.$moment(info.event.end).subtract(1,'days').format('DD-MM-YYYY');
                    this.evento.end = fin;
                }
                this.evento.title = this.eventoFromCalendar.title;
                this.modalShowFlag=true;
            },
            modalClosing(){
                this.evento.start='';
                this.evento.end='';
                this.evento.title='';
                this.evento.year='';
                this.eventoFromCalendar={};
                this.modalShowFlag=false;
            },
            async submitHandler(){
                const fechaToSave = this.evento;
                var fechaInicio;
                var fechaFin;
                var msg = '';
                if(this.eventoFromCalendar.dateStr!==undefined){
                    fechaInicio=this.$moment(this.eventoFromCalendar.dateStr).format('YYYY-MM-DD');
                }else{
                    fechaInicio=this.$moment(this.eventoFromCalendar.start).format('YYYY-MM-DD');
                }
                if(this.eventoFromCalendar.end!==undefined && this.eventoFromCalendar.end!==null && this.eventoFromCalendar.end!==''){
                    fechaFin=this.$moment(this.eventoFromCalendar.end).format('YYYY-MM-DD');
                    fechaToSave.end = fechaFin;
                }
                fechaToSave.start=fechaInicio
                if(this.eventoFromCalendar.id!==undefined&&this.eventoFromCalendar.id>0){
                    await axios.put(`/administracion/calendarios/${this.eventoFromCalendar.id}`,fechaToSave);
                    msg = 'Actualizado correctamente';
                }
                else{
                    await axios.post('/administracion/calendarios',fechaToSave);
                    msg = 'Guardado correctamente';

                }
                const response = await axios.get('/administracion/calendarios');
                this.eventos=response.data;
                toastr.clear();
                toastr.options.closeButton = true;
                toastr.success(msg, 'Exito');
                this.modalClosing();
            },
            async eliminarEvento(){
                // swal.fire('¿Está seguro de eliminar ese registro?','Esta accion es irreversible','question');
                this.modalClosing();
                const confirmacion = confirm(`¿Esta seguro de eliminar "Evento ${this.evento.title}"?`);
                if(confirmacion){
                    axios.delete(`/administracion/calendarios/${this.evento.id}`)
                    .then(()=>{
                        toastr.clear();
                        toastr.options.closeButton = true;
                        toastr.success('Eliminado correctamente', 'Exito');
                    })
                    const response = await axios.get('/administracion/calendarios');
                    this.eventos=response.data;
                }
            },

        }
    }
</script>

<style>

</style>
