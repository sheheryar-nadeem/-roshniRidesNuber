require('./bootstrap');

window.Vue = require('vue');


import vueRouter from 'vue-router';
import vueAxios from 'vue-axios';
import axios from 'axios';

Vue.use(vueRouter, vueAxios, axios);

import componentApp from './components/App.vue';
import componentAllBookings from './components/AllBookings.vue';
import componentAddBooking from './components/AddBooking.vue';


const routes = [
  {
    name: 'AllBookings',
    path: '/',
    component: componentAllBookings
  },
  {
    name: 'AddBooking',
    path: '/add-booking',
    component: componentAddBooking
  }
];

const router = new vueRouter({
    mode: 'history',
    routes: routes
});

const app = new Vue(
  Vue.util.extend(
    { router }, componentApp
  )
).$mount('#app');
