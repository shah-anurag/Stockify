/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import DashboardComponent from './components/Dashboard.vue'
import ProfileComponent from './components/Profile.vue'

Vue.component('dashboard-component', () => import('./components/Dashboard.vue'));
Vue.component('profile-component', () => import('./components/Profile.vue'));
Vue.component('company-component', () => import('./components/Company.vue'));

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    {
        path: '/', redirect: '/nifty'
    },
    {
        path: '/:name',
        name: 'company',
        component: require('./components/Company.vue'),
    },
]
const router = new VueRouter({
    routes,
    mode: 'history',
})


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    // router,
}).$mount('#app');
