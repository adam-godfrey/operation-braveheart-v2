window.Vue = require('vue');
require('./bootstrap');

Vue.component('memorial-form', require('./components/MemorialContactForm.vue').default);
Vue.component('payment-form', require('./components/StripePaymentForm.vue').default);
Vue.component('plaque-form', require('./components/MemorialPlaqueForm.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({
    mode: 'history',
    routes: [
    	{
			path: '/',
			name: 'home',
    	},
    	{
			path: '/about',
			name: 'about',
    	},
    	{
			path: '/lottery',
			name: 'lottery',
    	},
    	{
			path: '/memorial-garden',
			name: 'memorial-garden',
    	},
    	{
			path: '/news',
			name: 'news',
    	},
    	{
			path: '/shop',
			name: 'shop',
    	},
    	{
			path: '/contact',
			name: 'contact',
    	},
  	]
});

const app = new Vue({
    el: '#app',
    router: router
});