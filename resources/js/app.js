import JDTable from 'vue-jd-table/src/jd-table.vue';
import Vuelidate from 'vuelidate';

//Usado para utilizar swal - copiado directamente de npmjs.com
// import Vue from 'vue';
import Vue from 'vue/dist/vue.min.js'

import VueSwal from 'vue-swal';
Vue.use(VueSwal);

//Usado para utilizar moment - copiado directamente de npmjs.com
// import VueMoment from 'vue-moment';
// Vue.use(require('vue-moment'));
// Vue.use(VueMoment);


import Datepicker from 'vuejs-datepicker';
//import Datepicker from 'vuejs-datepicker';
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var moment = require('moment');

window.Vue = require('vue');
window.toastr = require('toastr');
window.bootbox = require('bootbox');
//window.moment = require('moment');

Vue.use(Vuelidate);
Vue.prototype.$moment = moment;


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('JDTable', JDTable);
//Vue.component('date-picker', Datepicker);
Vue.component('busqueda-api', require('./components/BusquedaApi.vue').default);
Vue.component('select2', require('./components/select.vue').default);
Vue.component('bootbox-modal', require('./components/BootboxDialog.vue').default);
Vue.component('lista-ejem', require('./components/ListaEjem.vue').default);
Vue.component('buscar-libro', require('./components/Buscar-libro.vue').default);
Vue.component('buscar-material', require('./components/BuscarMaterialComponent.vue').default);
Vue.component('prestamo-form', require('./components/PrestamoFormComponent.vue').default);

Vue.component('lista-ejem-table', require('./components/ListaEjemTable.vue').default);
Vue.component('ejemplar-component', require('./components/EjemplarComponent.vue').default);
Vue.component('prestamos-list-component', require('./components/PrestamosList.vue').default);
Vue.component('prestamos-mi-lista', require('./components/MisPrestamosList.vue').default)
// Vue.component('nuevo-aporte', require('./components/nuevoAporte.vue').default);


Vue.component('revisiones', require('./components/Revisiones.vue').default);
//Vue.component('comentarios', require('./components/Comentarios.vue').default);
Vue.component('aportes', require('./components/Aportes.vue').default);

// ------------------------MODULO DE INVENTARIO---------------------------------------------
Vue.component('biblioteca-list', require('./components/Biblioteca-list.vue').default);
Vue.component('estante-list', require('./components/Estante-list.vue').default);
Vue.component('inventariar-libros', require('./components/inventariar.vue').default);

// ------------------------MODULO DE APORTES---------------------------------------------
Vue.component('revisiones', require('./components/Revisiones.vue').default);
Vue.component('comentarios', require('./components/comentarios.vue').default);
Vue.component('aportes', require('./components/Aportes.vue').default);
Vue.component('aportes-area', require('./components/AportesArea.vue').default);
Vue.component('mis-aportes-aprobados', require('./components/MisAportesAprobados.vue').default);
Vue.component('mis-aportes-sin-aprobar', require('./components/MisAportesSinAprobar.vue').default);
Vue.component('aportes-director', require('./components/Aportes-Director.vue').default);
Vue.component('habilitar-aporte', require('./components/Habilitar-aporte.vue').default);
Vue.component('habilitar-comentarios', require('./components/HabilitarComentarios.vue').default);
Vue.component('palabra-prohibida', require('./components/Palabra-Prohibida.vue').default);

// ------------------------MODULO DE ADQUISICIONES---------------------------------------------
Vue.component('adquisiciones', require('./components/Adquisiciones.vue').default);

// ------------------------MODULO DE ADMINISTRACION---------------------------------------------
Vue.component('roles', require('./components/Roles.vue').default);
Vue.component('comites', require('./components/Comites.vue').default);
Vue.component('tipo-penalizaciones', require('./components/TipoPenalizaciones.vue').default);
Vue.component('asignacion-roles', require('./components/AsignacionRoles.vue').default);
Vue.component('asignacion-comites', require('./components/AsignacionComites.vue').default);
Vue.component('calendario', require('./components/calendario.vue').default);
Vue.component('comites-list', require('./components/Comites.vue').default);
Vue.component('puntuaciones-list', require('./components/Puntuaciones.vue').default);
Vue.component('niveles-list', require('./components/Niveles.vue').default);

// ------------------------MODULO DE BIOGRAFIA USUARIO---------------------------------------------
Vue.component('biografia-sidebar', require('./components/biografia-sidebar.vue').default);
Vue.component('biografia-aportes', require('./components/Biografia-Aportes.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

$(document).ready(function () {
    $('#Summernote').summernote({
        focus: true
    });
});
