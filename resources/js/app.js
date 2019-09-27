require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

Vue.component('example-component', require('./components/ExampleComponent.vue'));

/* Register our new component: */
Vue.component('contact-form', require('./components/ContactForm.vue').default);

Vue.component('newsletter-form', require('./components/Newsletter.vue').default);

Vue.component('call-to-action', require('./components/CallToAction.vue').default);

// Vue.component('memorial-form', require('./components/MemorialForm.vue').default);

Vue.component('memorial-form', require('./components/MemorialSubmitForm.vue').default);

// Vue.component('memorial-form', require('./components/MemorialForm.vue').default);

Vue.component('carousel', require('./components/Carousel.vue').default);

const app = new Vue({
    el: '#app'
});