import JDTable from 'vue-jd-table/src/jd-table.vue';
import Vuelidate from 'vuelidate';

//Usado para utilizar swal - copiado directamente de npmjs.com
import Vue from 'vue';
import VueSwal from 'vue-swal';
Vue.use(VueSwal);
//Usado para utilizar moment - copiado directamente de npmjs.com
// import VueMoment from 'vue-moment';
Vue.use(require('vue-moment'));
// Vue.use(VueMoment);


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.toastr = require('toastr');

Vue.use(Vuelidate);



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
Vue.component('busqueda-api', require('./components/BusquedaApi.vue').default);
Vue.component('select2', require('./components/select.vue').default);
Vue.component('lista-ejem', require('./components/ListaEjem.vue').default);
Vue.component('buscar-libro', require('./components/Buscar-libro.vue').default);

Vue.component('lista-ejem-table', require('./components/ListaEjemTable.vue').default);
Vue.component('ejemplar-component', require('./components/EjemplarComponent.vue').default);
// Vue.component('nuevo-aporte', require('./components/nuevoAporte.vue').default);


// ------------------------MODULO DE INVENTARIO---------------------------------------------
Vue.component('biblioteca-list', require('./components/Biblioteca-list.vue').default);
Vue.component('estante-list', require('./components/Estante-list.vue').default);

// ------------------------MODULO DE APORTES---------------------------------------------
Vue.component('revisiones', require('./components/Revisiones.vue').default);
Vue.component('comentarios', require('./components/comentarios.vue').default);
Vue.component('aportes', require('./components/Aportes.vue').default);
Vue.component('aportes-director', require('./components/Aportes-Director.vue').default);
Vue.component('habilitar-aporte', require('./components/Habilitar-aporte.vue').default);
Vue.component('habilitar-comentarios', require('./components/HabilitarComentarios.vue').default);
Vue.component('palabra-prohibida', require('./components/Palabra-Prohibida.vue').default);

// ------------------------MODULO DE ADQUISICIONES---------------------------------------------
Vue.component('adquisiciones', require('./components/Adquisiciones.vue').default);

// ------------------------MODULO DE ADMINISTRACION---------------------------------------------
Vue.component('roles', require('./components/Roles.vue').default);
Vue.component('asignacion-roles', require('./components/AsignacionRoles.vue').default);



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
