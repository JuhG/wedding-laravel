window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

window.Vue = require('vue');
window.Bus = new Vue();

var VueScrollTo = require('vue-scrollto');
Vue.use(VueScrollTo, {
    offset: -100,
});

import Sticky from 'vue-sticky-directive';
Vue.use(Sticky);


const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const app = new Vue({
    el: '#app',
});

window.initMap = () => {
    window.Bus.$emit('init-map');
}
