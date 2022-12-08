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
import CKEditor from 'ckeditor4-vue';
import DatePicker from 'vue2-datepicker';
// import vue2Dropzone from 'vue2-dropzone'

// IMPORT DE FOLHA DE ESTILO
import 'sweetalert2/dist/sweetalert2.min.css';
import 'element-ui/lib/theme-chalk/index.css';
import 'vue2-datepicker/index.css';

Vue.use(VueSweetalert2);
// Vue.use(vue2Dropzone);
Vue.use(VModal);
Vue.use(VueMask);
Vue.use(ElementUI);
Vue.use( CKEditor );
Vue.use( DatePicker );
Vue.use(require('vue-moment'));
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
Vue.component('search-survey', require('./components/Survey/Search.vue'));
Vue.component('create-user', require('./components/Survey/CreateUser.vue'));
Vue.component('survey-content', require('./components/Survey/Content.vue'));
Vue.component('survey-surveyor', require('./components/Survey/Surveyor.vue'));


// Vue.component('edit-team', require('./components/EditTeamComponent.vue'));
Vue.prototype.$eventBus = new Vue(); // Global event bus

const app = new Vue({
    el: '#app',
});
