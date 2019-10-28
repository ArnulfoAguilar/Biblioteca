<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12" style="overflow: auto">
        <div class="card">
          <div class="card-header bg-dark">Buscar libro</div>
          <div class="card-body">
            <form v-on:submit.prevent="buscarMaterialBibliotecario()">
              <div class="row">
                <div class="input-group mb-1 col-6">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <label class="form-check-label" for="defaultCheck1">Título</label>
                    </div>
                  </div>
                  <input type="text" class="form-control" name id v-model="qry.titulo" autofocus />
                </div>
                <div class="input-group mb-1 col-6">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <label class="form-check-label" for="defaultCheck1">Autor</label>
                    </div>
                  </div>
                  <input type="text" class="form-control" v-model="qry.autor" />
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-1 col-6">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <label class="form-check-label">ISBN</label>
                    </div>
                  </div>
                  <input type="text" class="form-control" name id v-model="qry.isbn" />
                </div>
                <div class="input-group mb-1 col-6" v-if="isBibliotecario">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <label class="form-check-label">Código de Barra</label>
                    </div>
                  </div>
                  <input type="text" class="form-control" name id />
                </div>
              </div>
              <div class="row mt-2" v-if="isBibliotecario">
                <div class="input-group mb-1 col-6">
                  <label class="form-check-label">Biblioteca</label>
                  <select2></select2>
                </div>
                <div class="input-group mb-1 col-6">
                  <label class="form-check-label">Otro filtro(No recuerdo cuál iba aquì XD)</label>
                  <select2></select2>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-1 col-6">
                  <button class="btn btn-success mt-2" type="submit">Buscar</button>
                </div>
              </div>
            </form>
            <br />
            <ul class="list-group" v-for="(item,index) in materialesBibliotecarios" :key="index">
              <li class="list-group-item">
                <span class="badge bg-info float-right">Disponible</span>

                <label class="col-lg-5">Título: {{item.EJEMPLAR}}</label>
                <label class="col-lg-5">Autor: {{item.AUTOR}}</label>
                <label class="col-lg-5">Lugar: {{item.ID_BIBLIOTECA}}</label>
                <label class="col-lg-5">Tipo de ítem: {{item.ID_CATALOGO_MATERIAL}}</label>
                <label class="col-lg-5">Edición: {{item.EDICION}}</label>
                <label class="col-lg-5">Copia número: {{item.COPIA_NUMERO}}</label>
                <label>
                  <button
                    type="button"
                    class="btn btn-success btn-sm"
                    data-toggle="modal"
                    data-target="#modalPrestamo"
                    v-on:click="seleccionarMaterial(item)"
                  >Realizar Prestamo</button>
                </label>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Modal para realizar prestamo -->
      <div id="modalPrestamo" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
          <form v-on:submit.prevent="guardarSolicitudPrestamo()">
            <div class="modal-content">
              <div class="modal-header bg-dark">
                <h4 class="modal-title">Realizar préstamo de libro</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label for="NOMBRE">Nombre del libro</label>
                  <input
                    v-model="materialBibliotecario.EJEMPLAR"
                    type="text"
                    class="form-control"
                    id="NOMBRE"
                    aria-describedby="emailHelp"
                    disabled
                  />
                </div>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="AUTOR">Autor/es</label>
                    <input
                      v-model="materialBibliotecario.AUTOR"
                      type="text"
                      class="form-control"
                      id="AUTOR"
                      aria-describedby="emailHelp"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="EDICION">Edición</label>
                    <input
                      v-model="materialBibliotecario.EDICION"
                      type="text"
                      class="form-control"
                      id="EDICION"
                      aria-describedby="emailHelp"
                      disabled
                    />
                  </div>
                </div>
                <!--<div class="row">
                  <div class="form-group col-md-6">
                    <label for="tipoAdquisición">Tipo Adquisición</label>
                    <input
                      type="text"
                      class="form-control"
                      id="tipoAdquisición"
                      aria-describedby="emailHelp"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="tipoPrestamo">Tipo Préstamo</label>
                    <select class="custom-select">
                      <option selected>Open this select menu</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>-->
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="DESCRIPCION">Descripción</label>
                    <textarea
                      v-model="materialBibliotecario.DESCRIPCION"
                      class="form-control"
                      name
                      id="DESCRIPCION"
                      rows="3"
                    ></textarea>
                  </div>
                </div>
                <div class="row text-center">
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
                      v-model="materialBibliotecario.CODIGO_BARRA"
                      type="text"
                      class="form-control"
                      id="PAGINAS"
                      aria-describedby="emailHelp"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-6">
                    <label for="PAGINAS">Fecha y hora de préstamo</label>
                    <input
                      class="form-control"
                      id="PAGINAS"
                      v-model="this.hoy"
                      aria-describedby="emailHelp"
                      disabled
                    />
                  </div>
                  <!--
                  <div class="form-group col-md-4">
                    <label for="PAGINAS">Fecha de devolución</label>
                    <input
                      type="date"
                      class="form-control"
                      id="PAGINAS"
                      aria-describedby="emailHelp"
                      disabled
                    />
                  </div>-->
                </div>
              </div>
              <div class="modal-footer">
                <button class="btn btn-success float-left" type="submit">Finalizar</button>
                <button class="btn btn-dark" type="reset" data-dismiss="modal">Cancelar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      check_titulo: true,
      qry: {
        titulo: "",
        autor: "",
        isbn: ""
      },
      isBibliotecario: true,
      hoy: this.$moment(new Date()).format("YYYY-MM-DD HH:mm"),
      materialesBibliotecarios: [],
      materialBibliotecario: {
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
        FILAESTANTE: ""
      },
      solicitudPrestamo: {
        FECHA_PRESTAMO: "",
        ID_USUARIO: "",
        ID_TIPO_PRESTAMO: "",
        ID_ESTADO_PRESTAMO: "",
        ID_MATERIAL: ""
      }
    };
  },
  created() {
    axios.get("/material").then(res => {
      this.materialesBibliotecarios = res.data;
    });
  },
  methods: {
    seleccionarMaterial(material) {
      this.materialBibliotecario.ID_MATERIAL = this.solicitudPrestamo.ID_MATERIAL =
        material.id;
      this.materialBibliotecario.EJEMPLAR = material.EJEMPLAR;
      this.materialBibliotecario.AUTOR = material.AUTOR;
      this.materialBibliotecario.EDICION = material.EDICION;
      this.materialBibliotecario.DESCRIPCION = material.DESCRIPCION;
      this.materialBibliotecario.CODIGO_BARRA = material.CODIGO_BARRA;

      this.solicitudPrestamo.FECHA_PRESTAMO = this.hoy;
      this.solicitudPrestamo.ID_TIPO_PRESTAMO = 1;
    },
    guardarSolicitudPrestamo() {
      if ($("#option2").val() === "on") {
        this.solicitudPrestamo.ID_ESTADO_PRESTAMO = 2;
      } else {
        this.solicitudPrestamo.ID_ESTADO_PRESTAMO = 1;
      }
      const solicitudPrestamoToSave = this.solicitudPrestamo;

      axios.post("/biblioteca/prestamos", solicitudPrestamoToSave).then(res => {
        $("#modalPrestamo").modal("hide");
        toastr.clear();
        toastr.options.closeButton = true;
        toastr.success("Solicitud guardada correctamente", "Éxito");
      });
    },
    buscarMaterialBibliotecario() {
      axios
        .get("/material", {
          params: {
            titulo: this.qry.titulo,
            isbn: this.qry.isbn,
            autor: this.qry.autor,
            biblioteca: this.qry.bibliotecas
          }
        })
        .then(res => {
          this.materialesBibliotecarios = res.data;
        });
    }
  }
};
</script>
