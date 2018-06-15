
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

Vue.use(Toasted)

Vue.component('example', require('./components/ExampleComponent.vue'));
Vue.component('articles', require('./components/ArticlesComponent.vue'));
Vue.component('navbar', require('./components/Navbar.vue'));
Vue.component('settings-setting', require('./components/Settings.vue'));
Vue.component('settings-banner', require('./components/Banner.vue'));
Vue.component('settings-banner2', require('./components/Banner2.vue'));

const app = new Vue({
    el: '#app' 
});
