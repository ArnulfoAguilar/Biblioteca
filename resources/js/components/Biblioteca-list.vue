<template>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-6 col-sm-12">
        <div class="card">
          <div class="card-header">Información de la Biblioteca</div>
          <div class="card-body">
            <form @submit.prevent="editarBiblioteca(Biblioteca)" v-if="modoEditar">
              <div class="form-group">
                <label for="NOMBRE">Nombre</label>
                <input
                  type="text"
                  v-model="Biblioteca.BIBLIOTECA"
                  class="form-control"
                  id="NOMBRE"
                  aria-describedby="emailHelp"
                />
              </div>

              <button class="btn btn-warning" type="submit">Editar</button>
              <button class="btn btn-danger" type="submit" @click="cancelarEdicion">Cancelar edición</button>
            </form>
            <form @submit.prevent="agregar" v-else>
              <div class="form-group">
                <label for="NOMBRE">Nombre</label>
                <input
                  type="text"
                  v-model="Biblioteca.BIBLIOTECA"
                  class="form-control"
                  id="NOMBRE"
                  aria-describedby="emailHelp"
                  required
                />
              </div>

              <button class="btn btn-primary" type="submit">Agregar Biblioteca</button>
            </form>
          </div>
        </div>
        <estante v-if="mostrarEstante" v-bind:BiblioSeleccionada="BibliotecaSeleccionada"></estante>
      </div>

      <div class="col-md-6 col sm-12" style="overflow: auto; height:600px; ">
        <div class="card">
          <div class="card-header">
            Lista de Bibliotecas
            <input
              class="float-right"
              placeholder="Buscar por nombre..."
              v-model="search"
            />
          </div>
          <div class="card-body">
            <ul class="list-group">
              <li class="list-group-item" v-for="(item, index) in searchEjemplar" :key="index">
                <span class="badge badge-primary">Actualizado el: {{item.updated_at}}</span>
                <p>Nombre: {{item.BIBLIOTECA}}</p>
                <p>
                  <button class="btn btn-warning btn-sm" @click="editarFormulario(item)">Editar</button>
                  <button
                    class="btn btn-danger btn-sm"
                    @click="eliminarBiblioteca(item, index)"
                  >Eliminar</button>
                  <button
                    class="btn btn-info float-right btn-sm"
                    v-on:click="mostrarFormEstante(item)"
                  >Gestionar estantes</button>
                </p>
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
  mounted() {
    console.log("Lista bibliotecas mounted.");
  },
  data() {
    return {
      search: "",
      bibliotecas: [],
      modoEditar: false,
      mostrarEstante: false,
      //nombreBiblioteca: "",
      Biblioteca: { id: "", BIBLIOTECA: "" },
      BibliotecaSeleccionada: { id: "", nombre: "" }
    };
  },
  created() {
    this.cargar();
  },
  methods: {
    cargar() {
      axios.get("/Biblioteca").then(res => {
        this.bibliotecas = res.data;
      });
    },
    agregar() {
      const bibliotecaNueva = this.Biblioteca;
      axios
        .post("/Biblioteca", bibliotecaNueva)
        .then(response => {
          alert("Guardado correctamente");
          console.log("Guardado");
          this.cargar();
          this.Biblioteca.BIBLIOTECA = "";
        })
        .catch(e => {
          alert("Error al Guardar" + e);
        });
    },
    editarFormulario(item) {
      this.Biblioteca.BIBLIOTECA = item.BIBLIOTECA;
      this.Biblioteca.id = item.id;
      this.modoEditar = true;
    },
    editarBiblioteca(BIBLIOTECA) {
      const parametros = {
        BIBLIOTECA: BIBLIOTECA.BIBLIOTECA
      };
      axios.put(`/Biblioteca/${BIBLIOTECA.id}`, parametros).then(response => {
        this.modoEditar = false;
        alert("Editado correctamente");
        console.log("Editado correctamente");
        this.cargar();
      });
    },
    eliminarBiblioteca(Biblioteca, index) {
      const confirmacion = confirm(
        `¿Eliminar Biblioteca ${Biblioteca.BIBLIOTECA}?`
      );
      if (confirmacion) {
        axios.delete(`/Biblioteca/${Biblioteca.id}`).then(() => {
          //this.ejemplars.splice(index, 1);
          alert("Biblioteca ELIMINADO");
          console.log("Biblioteca ELIMINADO");
          this.cargar();
        });
      }
    },
    cancelarEdicion() {
      this.modoEditar = false;
      this.Biblioteca = { id: "", BIBLIOTECA: "" };
    },
    mostrarFormEstante(item) {
      this.mostrarEstante = true;
      this.BibliotecaSeleccionada.nombre = item.BIBLIOTECA;
      this.BibliotecaSeleccionada.id = item.id;
    }
  },
  computed: {
    searchEjemplar: function() {
      return this.bibliotecas.filter(item =>
        item.BIBLIOTECA.includes(this.search)
      );
    }
  }
};
</script>
