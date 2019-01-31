import $ from 'jquery'

require('./bootstrap');
require('./app-script');
require('./j-confirm-action');

// For Admin Panel
require('./sb-admin');
window.toastr = require('toastr')
import fontawesome from '@fortawesome/fontawesome-free'

window.Vue = require('vue');

Vue.component('vue-message', require('./components/MessageComponent.vue'));
Vue.component('vue-search', require('./components/SearchComponent.vue'));

const app = new Vue({
    el: '#app'
});
