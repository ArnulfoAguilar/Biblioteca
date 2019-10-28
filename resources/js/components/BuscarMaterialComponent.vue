<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-12" v-bind:style="{overflow: 'auto', height:(isBibliotecario)?'500px':'' }">
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
      <bootbox-modal v-if="modalShowFlag" @close="modalClosing" :title="modalTitle">
          <prestamo-form :is-bibliotecario="isBibliotecario" :material="materialBibliotecario" @close="modalShowFlag = $event"></prestamo-form>
      </bootbox-modal>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        check_titulo: true,
        modalTitle: 'Realizar préstamo de libro',
        qry: {
            titulo: "",
            autor: "",
            isbn: ""
        },
        materialesBibliotecarios: [],
        modalShowFlag: false,
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
            FILAESTANTE: "",
            ID_TIPO_ADQUISICION: ""
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
        this.modalShowFlag = true;
        this.materialBibliotecario.ID_MATERIAL = material.id;
        this.materialBibliotecario.EJEMPLAR = material.EJEMPLAR;
        this.materialBibliotecario.AUTOR = material.AUTOR;
        this.materialBibliotecario.EDICION = material.EDICION;
        this.materialBibliotecario.DESCRIPCION = material.DESCRIPCION;
        this.materialBibliotecario.CODIGO_BARRA = material.CODIGO_BARRA;
        this.materialBibliotecario.ID_TIPO_ADQUISICION = material.ID_TIPO_ADQUISICION;
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
    },
    modalClosing(){
        this.materialBibliotecario.ID_MATERIAL = "";
        this.materialBibliotecario.ID_CATALOGO_MATERIAL= "";
        this.materialBibliotecario.EJEMPLAR= "";
        this.materialBibliotecario.AUTOR= "";
        this.materialBibliotecario.EDICION= "";
        this.materialBibliotecario.DESCRIPCION= "";
        this.materialBibliotecario.ISBN= "";
        this.materialBibliotecario.COPIA_NUMERO= "";
        this.materialBibliotecario.ID_TERCER_SUMARIO= "";
        this.materialBibliotecario.CODIGO_BARRA= "";
        this.materialBibliotecario.ID_BIBLIOTECA= "";
        this.materialBibliotecario.ID_ESTANTE  ="";
        this.materialBibliotecario.FILAESTANTE= "";
        this.materialBibliotecario.ID_TIPO_ADQUISICION= "";
        this.materialBibliotecario.ID_TIPO_PRESTAMO= "";

        this.modalShowFlag = false;
    },
  },
  props:{
      isBibliotecario: Boolean
  }
}
</script>
