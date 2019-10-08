require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);

import swal from 'sweetalert2';
window.swal = swal;

window.Fire = new Vue();

Vue.component('admin-sidebar', require('./components/AdminSidebar.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('lottery-players', require('./components/LotteryPlayersTable.vue').default);

Vue.component('lottery-player', require('./components/LotteryPlayerForm.vue').default);

Vue.component('news-admin', require('./components/NewsAdmin.vue').default);

Vue.component('custom-select', require('./components/CustomSelect.vue').default);

const app = new Vue({
    el: '#app'
});