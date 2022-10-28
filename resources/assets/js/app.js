/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';
import VModal from 'vue-js-modal'
import VueSweetalert2 from 'vue-sweetalert2';
import VueMask from 'v-mask';
import ElementUI from 'element-ui';

// import vue2Dropzone from 'vue2-dropzone'

import 'sweetalert2/dist/sweetalert2.min.css';
import "ag-grid-community/styles/ag-grid.css";
import "ag-grid-community/styles/ag-theme-alpine.css";
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(VueSweetalert2);
// Vue.use(vue2Dropzone);
Vue.use(VModal);
Vue.use(VueMask);
Vue.use(ElementUI);
// Vue.use(AgGridVue);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('info-contact', require('./components/Contact/InfoContact.vue'));
Vue.component('form-contact', require('./components/Contact/FormContact.vue'));
Vue.component('cadastre-pf', require('./components/Proposal/Cadastre-pf.vue'));
Vue.component('proposal-pf', require('./components/Proposal/Proposal-pf.vue'));
Vue.component('download', require('./components/Downloads/Files.vue'));
//VISTORIA
Vue.component('list-survey', require('./components/Survey/List.vue'));


// Vue.component('edit-team', require('./components/EditTeamComponent.vue'));

const app = new Vue({
    el: '#app',
});
