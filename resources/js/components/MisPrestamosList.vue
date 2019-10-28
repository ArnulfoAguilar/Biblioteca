<template>
  <div class="contener-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12" style="overflow: auto">
        <div class="card">
          <div class="card-header bg-dark">Mis préstamos bibliotecarios</div>
          <div class="card-body">
            <form></form>
            <br />
            <ul class="list-group" v-for="(item,index) in misPrestamos" :key="index">
              <li class="list-group-item">
                <span
                  class="badge float-right"
                  :class="{'bg-info': item.ID_ESTADO_PRESTAMO == 1, //Solicitado
                         'bg-success': item.ID_ESTADO_PRESTAMO == 3, //Prestado
                         'bg-warning': item.ID_ESTADO_PRESTAMO == 2, //Reservado y 4.Pendiente de Devolucion
                         'bg-danger': item.ID_ESTADO_PRESTAMO == 4}"
                >{{item.ESTADO_PRESTAMO}}</span>
                <label class="col-lg-5">Título: {{item.EJEMPLAR}}</label>
                <label class="col-lg-5">Autor: {{item.AUTOR}}</label>
                <label class="col-lg-5">Biblioteca:</label>
                <label class="col-lg-5">Tipo de préstamo: {{item.TIPO_PRESTAMO}}</label>
                <label
                  class="col-lg-5"
                >Fecha de préstamo: {{$moment(item.FECHA_PRESTAMO).format("lll")}}</label>
                <label
                  class="col-lg-5"
                >Fecha de devolución: {{$moment(item.FECHA_DEVOLUCION).format("lll")}}</label>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      misPrestamos: []
    };
  },
  created() {
    this.$moment.locale("es");
    axios.get("/bibioteca/lista/mis-prestamos").then(res => {
      this.misPrestamos = res.data;
    });
  }
};
</script>
