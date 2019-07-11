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



// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('home-component', require('./components/homeComponent.vue').default);
Vue.component('home1-component', require('./components/home1Component.vue').default);
Vue.component('home2-component', require('./components/home2Component.vue').default);
Vue.component('home3-component', require('./components/home3Component.vue').default);
Vue.component('home4-component', require('./components/home4Component.vue').default);

const routes = [
  { path: '/', component: require('./components/homeComponent.vue').default },
  { path: '/home', component: require('./components/homeComponent.vue').default },
  { path: '/example', component: require('./components/ExampleComponent.vue').default },
  { path: '/example1', component: require('./components/home1Component.vue').default },
  { path: '/example2', component: require('./components/home2Component.vue').default },
  { path: '/example3', component: require('./components/home3Component.vue').default },
  { path: '/example4', component: require('./components/home4Component.vue').default }
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
