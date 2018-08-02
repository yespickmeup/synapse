
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Toasted from 'vue-toasted';
import Vue from 'vue'
import VueQuillEditor from 'vue-quill-editor'
import BootstrapVue from 'bootstrap-vue'
// require styles
import 'quill/dist/quill.core.css'
import 'quill/dist/quill.snow.css'
import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor, /* { default global options } */)
Vue.use(Toasted)
Vue.use(BootstrapVue);

import 'bootstrap-vue/dist/bootstrap-vue.css'


Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('articles', require('./components/ArticlesComponent.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('settings-setting', require('./components/Settings.vue'));
Vue.component('settings-banner', require('./components/Banner.vue'));
Vue.component('settings-banner2', require('./components/Banner2.vue'));
Vue.component('settings-about', require('./components/About.vue'));
Vue.component('settings-services', require('./components/Services.vue'));
Vue.component('settings-clients', require('./components/Clients.vue'));
Vue.component('settings-portfolios', require('./components/Portfolios.vue'));
Vue.component('settings-testimonials', require('./components/Testimonials.vue'));
Vue.component('settings-team', require('./components/Team.vue'));
Vue.component('settings-messages', require('./components/Messages.vue'));

const app = new Vue({
    el: '#app' 
});
