require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);

import Snotify, { SnotifyPosition } from 'vue-snotify';
import "vue-snotify/styles/material.css";

const options = {
  	toast: {
    	position: SnotifyPosition.rightTop
  	}
}

Vue.use(Snotify, {
  	toast: {
    	position: SnotifyPosition.rightTop
  	}
})

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
 
Vue.use(VueSweetalert2, {
  	confirmButtonColor: '#41b882',
  	cancelButtonColor: '#ff7674'
});

Vue.component('admin-sidebar', require('./components/admin/Sidebar.vue').default);

Vue.component('lottery-results', require('./components/admin/LotteryResults.vue').default);

Vue.component('lottery-players', require('./components/admin/LotteryPlayersTable.vue').default);

Vue.component('lottery-player', require('./components/admin/LotteryPlayerForm.vue').default);

Vue.component('news-admin', require('./components/admin/News.vue').default);

Vue.component('custom-select', require('./components/admin/CustomSelect.vue').default);

Vue.component('lottery-settings', require('./components/admin/LotterySettings.vue').default);

Vue.component('file-upload', require('./components/admin/FileUpload.vue').default);

const app = new Vue({
    el: '#app'
});