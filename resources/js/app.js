/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


Vue.component('pagination', require('laravel-vue-pagination'));

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('category-component', require('./components/CategoryComponent.vue').default);
Vue.component('home-component', require('./components/homeComponent.vue').default);

const routes = [
  { path: '/', component: require('./components/homeComponent.vue').default },
  { path: '/home', component: require('./components/homeComponent.vue').default },
  { path: '/category', component: require('./components/CategoryComponent.vue').default },
  ]
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
  });

const app = new Vue({
    el: '#app',
    router
});
