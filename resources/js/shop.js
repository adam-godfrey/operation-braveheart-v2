window.Vue = require('vue');

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