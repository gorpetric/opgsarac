require('./bootstrap');

window.Vue = require('vue');

require('./lightbox');
require('./sweetalert');
require('./stuff');

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});
