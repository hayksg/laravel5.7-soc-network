import $ from 'jquery'

require('./bootstrap');
require('./app-script');

// For Admin Panel
require('./sb-admin');
window.toastr = require('toastr')
import fontawesome from '@fortawesome/fontawesome-free'



window.Vue = require('vue');

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('hello-component', require('./components/HelloComponent.vue'));

const app = new Vue({
    el: '#app'
});
