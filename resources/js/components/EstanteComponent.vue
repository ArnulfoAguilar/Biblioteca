<template>
  <div>
    <div class="card">
      <div class="card-header" v-if="editarActivo">Editar Estantes</div>
      <div class="card-header" v-else>Agregar Estantes</div>
      <div class="card-body">
        <form @submit.prevent="editarEstante(estante)" v-if="editarActivo">
          <h5 class="mb-3">{{BiblioSeleccionada.nombre}}</h5>
          <div class="form-group">
            <label for="idEstante">Identificador del Estante</label>
            <input
              class="form-control"
              type="text"
              placeholder="Ej. BIB-K01"
              id="nombreEstante"
              v-model="estante.identificador"
            />
          </div>
          <div class="form-group">
            <label for="idEstante">Clasificación General</label>
            <input
              class="form-control"
              type="text"
              placeholder="200 - Religion"
              v-model="estante.clasificacion"
            />
          </div>
          <div class="form-group">
            <button class="btn btn-success" type="submit">Guardar</button>
            <button class="btn btn-danger" type="button">Cancelar Edición</button>
          </div>
        </form>
        <form @submit.prevent="agregar" v-else>
          <h5 class="mb-3">{{BiblioSeleccionada.nombre}}</h5>
          <div class="form-group">
            <label for="idEstante">Identificador del Estante</label>
            <input
              class="form-control"
              type="text"
              placeholder="Ej. BIB-K01"
              id="nombreEstante"
              v-model="estante.identificador"
            />
          </div>
          <div class="form-group">
            <label for="idEstante">Clasificación General</label>
            <input
              class="form-control"
              type="text"
              placeholder="200 - Religion"
              v-model="estante.clasificacion"
            />
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">Agregar</button>
          </div>
        </form>
        <h3>Listado de estantes</h3>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Identificador</th>
              <th scope="col">Clasificación General</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,index) in estantes" :key="index">
              <th scope="row">{{item.id}}</th>
              <td>{{item.ESTANTE}}</td>
              <td>{{item.CLASIFICACION}}</td>
              <td>
                <button class="btn btn-warning btn-xsm fa fa-edit" v-on:click="editarForm(item)"></button>
                <button
                  class="btn btn-danger btn-xsm fa fa-trash-alt text-dark"
                  v-on:click="eliminarEstante(item,index)"
                ></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      estantes: [],
      estante: { identificador: "", clasificacion: "" },
      editarActivo: false
    };
  },
  created() {
    axios
      .get("/Estante", {
        params: {
          id: this.BiblioSeleccionada.id
        }
      })
      .then(res => {
        this.estantes = res.data;
      });
    console.log(this.BiblioSeleccionada.id);
  },
  props: {
    BiblioSeleccionada: {
      type: Object
    }
  },
  methods: {
    agregar() {
      //console.log(this.estante.identificador, this.estante.clasificacion);
      if (
        this.estante.identificador.trim() === "" ||
        this.estante.clasificacion.trim() === ""
      ) {
        alert("Completa los campos");
        return;
      }
      const params = {
        identificador: this.estante.identificador,
        clasificacion: this.estante.clasificacion,
        biblioteca: this.BiblioSeleccionada.id
      };
      axios.post("/Estante", params).then(res => {
        //Para guardarla en el array y poder visualizarla
        this.estantes.push(res.data);
      });
    },
    editarForm(item) {
      this.editarActivo = true;
      this.estante.identificador = item.ESTANTE;
      this.estante.clasificacion = item.CLASIFICACION;
      this.estante.id = item.id;
    },
    editarEstante(estante) {
      const params = {
        identificador: this.estante.identificador,
        clasificacion: this.estante.clasificacion
      };
      console.log(params);
      axios.put(`/Estante/${this.estante.id}`, params).then(res => {
        this.editarActivo = false;
        console.log("editado correctamente");
      });
    },
    eliminarEstante(item, index) {
      axios.delete(`/Estante/${item.id}`).then(() => {
        this.estantes.splice(index, 1);
      });
    }
  }
};
</script>
